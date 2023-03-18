<?php

namespace CashRegister\core\database;

class DBConnection {
    private ?\PDO $pdo = null;
    private string $rootdir;

    public function __construct(array $config, string $rootdir) {
        if ($this->pdo == null)
            $this->pdo = new \PDO($config['DB_DSN'], $config['DB_USER'], $config['DB_PASSWORD']);
        $this->rootdir = $rootdir;
    }

    public function getPDO(): \PDO {
        return $this->pdo;
    }

    public function applyMigrations():void {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $files = scandir(  $this->rootdir. '/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);

        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..') continue;

            require_once $this->rootdir.'/migrations/'.$migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className;
            $this->log("Applying migration: $migration");
            $instance->up();
            $this->log("Applied migration: $migration");
            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations))
            $this->saveMigrations($newMigrations);
        else
            $this->log('All migrations are applied');
    }

    public function createMigrationsTable(): void {
        $statement = "CREATE TABLE IF NOT EXISTS migrations ( 
                id INT AUTO_INCREMENT PRIMARY KEY, 
                migration VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE = INNODB;";

        $this->pdo->exec($statement);
    }

    public function getAppliedMigrations(): bool|array {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    private function saveMigrations(array $migrations): void {
        $values = implode(",", array_map(fn($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $values");
        $statement->execute();
    }

    private function log(string $message): void {
        echo '['.date('Y-m-d H:i:s').'] - ' . $message . PHP_EOL;
    }

    public function prepare(string $query): bool|\PDOStatement {
        return $this->pdo->prepare($query);
    }
}