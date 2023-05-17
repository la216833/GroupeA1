<?php

use CashRegister\controllers\HistoryController;
use CashRegister\controllers\LoginController;
use CashRegister\controllers\ProductController;
use CashRegister\controllers\SaleController;
use CashRegister\controllers\UserController;
use CashRegister\controllers\CategoryController;

require_once '../vendor/autoload.php';

define('VIEW_PATH', dirname(__DIR__) . '/src/views/');

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->load();

$router = new AltoRouter();

$router->map('GET', '/', 'sale#get');
$router->map('POST', '/', 'sale#post');

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
$router->map('POST', '/category', 'category#post_one');

$router->map('GET', '/login', 'login#get');

$router->map('GET', '/history', 'history#get');

$match = $router->match();

if ($match !== null) {
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
            default:
                break;
        }
        call_user_func_array(array($obj, $action), $match['params']);
    } else {
        // TODO
        echo '404';
    }
} else {
    // TODO
    echo '404';
}
