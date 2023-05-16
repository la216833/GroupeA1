<?php

namespace CashRegister\controllers;

use CashRegister\daos\DAORole;
use CashRegister\daos\DAOUser;
use CashRegister\core\View;

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
        $params['users_seller'] = count($userDao->selectWhere(['rolesID' => 1]));
        $params['users_manager'] = count($userDao->selectWhere(['rolesID' => 2]));
        $params['users_admin'] = count($userDao->selectWhere(['rolesID' => 3]));
        echo $this->view->render('users.php', $params);
    }

    public function get_one(int $id): void
    {
        $params = [];
        $userDao = new DAOUser();
        $params['user'] = $userDao->selectOne($id);
        echo $this->view->render('userForm.php', $params);
    }

    public function add(): void
    {
        $params = [];
        echo $this->view->render('userForm.php', $params);
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