<?php

namespace CashRegister\controllers;

use CashRegister\core\database\DBConnection;
use CashRegister\core\View;
use CashRegister\daos\DAOCategory;
use CashRegister\daos\DAOProduct;

class SaleController implements Controller {

    private View $view;
    private DAOCategory $DAOCategory;
    private DAOProduct $DAOProduct;

    public function __construct() {
        $this->view = new View();
        $this->DAOCategory = new DAOCategory();
        $this->DAOProduct = new DAOProduct();
    }

    public function get(): void {
        $params = [];
        $params['categories'] = $this->DAOCategory->selectAll();
        $params['products'] = $this->DAOProduct->selectAll();
        $current = DBConnection::getInstance()->query("SELECT salesID FROM sales ORDER BY salesID DESC LIMIT 1")
            ->fetchAll();
        $params['number'] = $current[0][0] + 1;
        echo $this->view->render('sale.php', $params);
    }

    public function get_one(int $id): void {
        // TODO: Implement get_id() method.
    }

    public function add(): void {
        // TODO: Implement add() method.
    }

    public function post_one(int $id): void {
        // TODO: Implement post_one() method.
    }

    public function post(): void {
        var_dump($_POST);
    }

    public function update(int $id): void {
        // TODO: Implement update() method.
    }

    public function delete(int $id): void {
        // TODO: Implement delete() method.
    }
}
