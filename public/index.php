<?php

use CashRegister\controllers\ProductController;
use CashRegister\controllers\SaleController;

require_once '../vendor/autoload.php';

define('VIEW_PATH', dirname(__DIR__) . '/src/views/');

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->load();

$router = new AltoRouter();

$router->map('GET', '/', 'sale#get');
$router->map('POST', '/', 'sale#post');

$router->map('GET', '/products', 'product#get');

$router->map('GET', '/product', 'product#add');
$router->map('GET', '/product/[i:id]', 'product#get_one');
$router->map('POST', '/product', 'product#post_one');

$match = $router->match();

if ($match !== null) {
    list($controller, $action) = explode('#', $match['target']);
    $obj = null;
    if (is_callable($controller, $action)) {
        switch ($controller) {
            case 'product': $obj = new ProductController(); break;
            case 'sale': $obj = new SaleController(); break;
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
