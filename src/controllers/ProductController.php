<?php

namespace CashRegister\controllers;

use CashRegister\core\View;
use CashRegister\daos\DAOCategory;
use CashRegister\daos\DAOProduct;

class ProductController implements Controller {

    private View $view;

    public function __construct() {
        $this->view = new View();
    }

    public function get(): void {
        $params = [];
        $categoryDao = new DAOCategory();
        $productDao = new DAOProduct();
        $params['categories'] = $categoryDao->selectAll();
        $params['products'] = $productDao->selectAll();
        $params['product_out_of_stock'] = 0;
        $params['product_available'] = count($productDao->selectWhere(['productsActive' => 1]));
        $params['product_unavailable'] = count($productDao->selectWhere(['productsActive' => 0]));
        echo $this->view->render('products.php', $params);
    }

    public function get_one(int $id): void {
        $params = [];
        $productDao = new DAOProduct();
        $params['product'] = $productDao->selectOne($id);
        echo $this->view->render('product.php', $params);
    }

    public function add(): void {
        $params = [];
        echo $this->view->render('product.php', $params);
    }

    public function post(array $params): void {
        // TODO: Implement post() method.
    }

    public function post_one(int $id): void {
        // TODO: Implement post_one() method.
    }

    public function update(int $id): void {
        // TODO: Implement update() method.
    }

    public function delete(int $id): void {
        // TODO: Implement delete() method.
    }

}
