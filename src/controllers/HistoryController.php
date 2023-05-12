<?php

namespace CashRegister\controllers;

use CashRegister\core\View;

class HistoryController implements Controller
{
    private View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function get(): void
    {
        $params = [];
        echo $this->view->render('history.php', $params);
    }

    public function get_one(int $id): void
    {
        // TODO: Implement get_one() method.
    }

    public function add(): void
    {
        // TODO: Implement add() method.
    }

    public function post(array $params): void
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