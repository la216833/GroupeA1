<?php

require_once __DIR__ . '/vendor/autoload.php';

use CashRegister\core\database\DBConnection;

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$db = new DBConnection($_ENV, __DIR__);
$db->applyMigrations();