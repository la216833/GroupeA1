<?php

class DBConnection {
    private static $instance = null;

    private function __construct() {
        self::$instance = new PDO($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
    }

    public static function getInstance() {
        if (self::$instance == null)
            self::$instance = new DBConnection();
        return self::$instance;
    }
}