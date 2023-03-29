<?php

namespace CashRegister\core\database;

use CashRegister\core\exception\DBException;
use PDO;
use Exception;

class DBConnection {
    private static ?PDO $pdo = null;

    public static function getInstance(): PDO {
        if (self::$pdo == null)
            try {
                self::$pdo = new PDO($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            } catch (Exception $error) {
                self::$pdo = null;
            }
        return self::$pdo;
    }

    public static function close(): bool {
        if (self::$pdo != null)
            self::$pdo = null;
        return true;
    }
}