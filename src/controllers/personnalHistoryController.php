<?php

namespace CashRegister\controllers;

use CashRegister\core\exception\DBException;
use CashRegister\core\View;
use CashRegister\daos\DAOSale;
use CashRegister\daos\DAOSaleContent;

class personnalHistoryController implements Controller
{

    private DAOSale $daoSale;
    private DAOSaleContent $daoSaleContent;
    private View $view;

    public function __construct()
    {
        $this->daoSale = new DAOSale();
        $this->view = new View();
    }


    public function get(): void
    {
        global $session;
        try {
            $params["ticketsContent"] = $this->daoSale->selectWhere(["usersID"=>$session->get('USER')]);
        }catch (DBException $e){
            $params["errors"] = "Erreur de connexion avec la base de données";
        }

        echo $this->view->render("personnalHistory.php", $params);

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