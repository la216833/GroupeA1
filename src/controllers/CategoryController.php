<?php

namespace CashRegister\controllers;

use CashRegister\core\View;
use CashRegister\daos\DAOCategory;
use CashRegister\daos\DAOProduct;

class CategoryController implements Controller
{

    private View $view;
    private DAOCategory $DAOCategory;
    private DAOProduct $DAOProduct;
    public function __construct() {
        $this->view = new View();
        $this->DAOCategory = new DAOCategory();
        $this->DAOProduct = new DAOProduct();
    }

    public function get(): void
    {
        $params = [];
        $params['categories'] = $this->DAOCategory->selectAll();
        $params['category_active'] = count($this->DAOCategory->selectWhere(['categoriesActive' => 1]));
        $params['category_empty'] = 0; // TODO : check the real value
        $params['category_inactive'] = count($this->DAOCategory->selectWhere(['categoriesActive' => 0]));
        foreach ($params['categories'] as $cat) {
            $params['quantity'][$cat->getName()] = count($this->DAOProduct->selectWhere(["categoriesID" => $cat->getID
            ()]));
        }
        echo $this->view->render('categories.php', $params);
    }

    public function get_one(int $id): void
    {
        $params = [];
        $categoryDao = new DAOCategory();
        $params['category'] = $categoryDao->selectOne($id);
        echo $this->view->render('categoryForm.php', $params);
    }

    public function add(): void
    {
        $params = [];
        echo $this->view->render('categoryForm.php', $params);
    }

    public function post(): void
    {
        // TODO: Implement post() method.
    }

    public function post_one(int $id): void
    {
        // TODO: Implement post_one() method.
    }

    public function update(int $id): void
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id): void
    {
        // TODO: Implement delete() method.
    }
}