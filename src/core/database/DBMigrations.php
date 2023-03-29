<?php

namespace CashRegister\core\database;

use PDO;

class DBMigrations {

    private string $rootdir;

    public function __construct(string $rootdir) {
        $this->rootdir = $rootdir;
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

        DBConnection::getInstance()->exec($statement);
    }

    public function getAppliedMigrations(): bool|array {
        $statement = $this->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    private function saveMigrations(array $migrations): void {
        $values = implode(",", array_map(fn($m) => "('$m')", $migrations));
        $statement = $this->prepare("INSERT INTO migrations (migration) VALUES $values");
        $statement->execute();
    }

    private static function log(string $message): void {
        echo '['.date('Y-m-d H:i:s').'] - ' . $message . PHP_EOL;
    }

    public function prepare(string $query): bool|\PDOStatement {
        return DBConnection::getInstance()->prepare($query);
    }

}