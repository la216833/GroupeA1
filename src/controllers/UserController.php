<?php

namespace CashRegister\controllers;

use CashRegister\daos\DAORole;
use CashRegister\daos\DAOUser;

class UserController implements Controller
{

    private View $view;
    public function __construct() {
        $this->view = new View();
    }
    public function get(): void
    {
        $params = [];
        $userDao = new DAOUser();
        $roleDao = new DAORole();
        $params['roles'] = $roleDao->selectAll();
        $params['users'] = $userDao->selectAll();
        $params['users_seller'] = count($userDao->selectWhere(['rolesName' => 'seller']));
        $params['users_manager'] = count($userDao->selectWhere(['rolesID' => 'manager']));
        $params['users_admin'] = count($userDao->selectWhere(['rolesID' => 'administrator']));
        echo $this->view->render('users.php', $params);
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