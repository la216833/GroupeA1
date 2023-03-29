<?php

require_once __DIR__ . '/vendor/autoload.php';

use CashRegister\core\database\DBMigrations;

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$migrations = new DBMigrations(__DIR__);
$migrations->applyMigrations();