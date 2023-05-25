<?php

namespace CashRegister\controllers;

use CashRegister\core\exception\DBException;
use CashRegister\core\View;
use CashRegister\daos\DAOUser;

class LoginController implements Controller
{

    private View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function get(): void
    {
        $params = [];
        echo $this->view->render('login.php', $params);

    }

    public function get_one(int $id): void
    {
        // TODO: Implement get_one() method.
    }

    public function add(): void
    {
        // TODO: Implement add() method.
    }

    public function post(): void
    {
        global $session;
        $daoUser = new DAOUser();
        $param = array();
        $currentUser = null;
        try {
            $password = htmlentities($_POST["password"]);

            $users = $daoUser->selectAll();
            foreach ($users as $user){
                if (password_verify($password,$user->getAccessCode())){
                    $currentUser = $user;
                    break;
                }
            }
            if ($currentUser){
                if ($currentUser->getStatus() == 1){
                    $session->set('USER', $currentUser->getID());
                    $session->set('USERNAME', $currentUser->getName());
                    $session->set('ROLE', $currentUser->getRole()->getName());
                    header("Location: /");
                }
                else{
                    $param["errors"] = "Vous n'avez pas acces à ces foncionnalités, veuillez vous referez à votre responsable";

                    echo $this->view->render('login.php', $param);
                }
            }
            else{
                $param["errors"] = "Identifiant inconnu";
                echo $this->view->render('login.php', $param);

            }
        }catch (DBException $exception){
            echo $this->view->render('error.php', $exception);
        }
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
        global $session;
        $session->remove('USER');
        $session->remove('USERNAME');
        $session->remove('ROLE');
        header('Location: /login');
    }

}