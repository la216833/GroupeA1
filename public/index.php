<?php

use CashRegister\controllers\HistoryController;
use CashRegister\controllers\LoginController;
use CashRegister\controllers\ProductController;
use CashRegister\controllers\SaleController;
use CashRegister\controllers\StockController;
use CashRegister\controllers\UserController;
use CashRegister\controllers\CategoryController;
use CashRegister\core\Configuration;
use CashRegister\core\Session;
use CashRegister\core\View;

require_once '../vendor/autoload.php';

$path = dirname(__DIR__, 1) . "/.env";
if (!file_exists($path)) {
    $config = new Configuration();
    $config->install();
}

date_default_timezone_set('Europe/Brussels');


$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->load();

$session = new Session();

$router = new AltoRouter();

$router->map('GET', '/', 'sale#get');
$router->map('POST', '/', 'sale#post');
$router->map('POST', '/sale/save/[i:id]', 'sale#get_one');
$router->map('POST', '/sale/resume/[i:id]', 'sale#post_one');
$router->map('POST', '/sale/return/[i:id]', 'sale#update');
$router->map('POST', '/sale/advance', 'sale#add');
$router->map('POST', '/sale/advance/[i:id]', 'sale#delete');

$router->map('GET', '/products', 'product#get');
$router->map('GET', '/product', 'product#add');
$router->map('POST', '/product', 'product#post');
$router->map('GET', '/product/[i:id]', 'product#get_one');
$router->map('POST', '/product/[i:id]', 'product#update');
$router->map('GET', '/product/delete/[i:id]', 'product#delete');

$router->map('GET', '/users', 'user#get');
$router->map('GET', '/user', 'user#add');
$router->map('GET', '/user/[i:id]', 'user#get_one');
$router->map('POST', '/user', 'user#post_one');

$router->map('GET', '/categories', 'category#get');
$router->map('GET', '/category', 'category#add');
$router->map('GET', '/category/[i:id]', 'category#get_one');
$router->map('POST', '/category/[i:id]', 'category#update');
$router->map('GET', '/category/delete/[i:id]', 'category#delete');
$router->map('POST', '/category', 'category#post');

$router->map('GET', '/stocks', 'stock#get');
$router->map('GET', '/stock', 'stock#add');
$router->map('POST', '/stock', 'stock#post');
$router->map('GET', '/stock', 'stock#get_form');

$router->map('GET', '/login', 'login#get');
$router->map('POST', '/login', 'login#post');

$router->map('GET', '/logout/[i:id]', 'login#delete');

$router->map('GET', '/history', 'history#get');

$match = $router->match();

if ($match) {
    list($controller, $action) = explode('#', $match['target']);
    $obj = null;
    if (is_callable($controller, $action)) {
        switch ($controller) {
            case 'product': $obj = new ProductController(); break;
            case 'sale': $obj = new SaleController(); break;
            case 'user' : $obj = new UserController(); break;
            case 'category' : $obj = new CategoryController(); break;
            case 'login' : $obj = new LoginController(); break;
            case 'history': $obj = new HistoryController(); break;
            case 'stock': $obj = new StockController(); break;
            default:
                break;
        }
        call_user_func_array(array($obj, $action), $match['params']);
    } else {
        $view = new View();
        http_response_code(501);
        echo $view->render('error.php', ['title' => '501', 'desc' => "La fonction rechercher n'est pas implémentée"]);
    }
} else {
    $view = new View();
    http_response_code(404);
    echo $view->render('error.php', ['title' => '404', 'desc' => "Cette page n'existe pas"]);
}
