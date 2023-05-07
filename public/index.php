<?php

use CashRegister\core\View;

require_once '../vendor/autoload.php';

define('VIEW_PATH', dirname(__DIR__) . '/src/views/');

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->load();

$router = new AltoRouter();
$view = new View();

$router->map('GET', '/', function() {global $view; echo $view->render('main.php');} );
$router->map('GET', '/categories', function() {global $view; echo $view->render('categories.php');});
$router->map('GET', '/products', function() {global $view; echo $view->render('products.php');});
$router->map('GET', '/users', function() {global $view; echo $view->render('users.php');});
$router->map('GET', '/history', function() {global $view; echo $view->render('history.php');});
$router->map('GET', '/login', function() {global $view; echo $view->render('login.php');});
$router->map('GET', '/logout', function() {global $view; echo $view->render('logout.php');});

$match = $router->match();
$match['target']();
