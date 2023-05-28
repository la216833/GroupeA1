<?php


namespace CashRegister\controllers;


use CashRegister\core\exception\DBException;
use CashRegister\core\View;
use CashRegister\daos\DAOProduct;
use CashRegister\daos\DAOStock;
use CashRegister\models\Product;
use CashRegister\models\Stock;

class StockController implements Controller
{
    private View $view;
    private DAOStock $daoStock;
    private Stock $stock;
    private DAOProduct $daoProduct;

    public function __construct()
    {
        $this->view = new View();
        $this->daoProduct = new DAOProduct();
        $this->daoStock = new DAOStock();
    }

    /**
     * @throws DBException
     */
    public function get(): void
    {
        global $session;
        if ($session->get('ROLE') !== 'administrator') {
            header('Location: /');
            exit();
        }

        $this->daoStock = new DAOStock();
            $params['stocks'] = $this->daoStock->selectAll();
            $params['stock_available'] = count($this->daoStock->selectWhere(array("stockActive"=>1)));
            $params['stock_sold'] = $this->daoStock->getSumSelledStocks();
            $params['stock_unavailable'] = count($this->daoStock->selectWhere(array("stockActive"=>0)));
            $params['articles'] = $this->daoProduct->selectAll();
            echo $this->view->render('stock.php', $params);
    }

    public function get_one(int $id): void
    {
        // TODO: Implement get_one() method.
    }


    public function get_form(): void
    {
        global $session;
        if ($session->get('ROLE') !== 'administrator') {
            header('Location: /');
            exit();
        }
        try {
            $params['products'] = $this->daoProduct->selectAll();


        }catch (DBException $exception){
            $params['errors'] = "Erreur: Verifiez la connexion à la base de données";
    }
        echo $this->view->render('stockForm.php', $params);
    }

    public function add(): void
    {

    }

    public function post(): void
    {
        global $session;
        if ($session->get('ROLE') !== 'administrator') {
            header('Location: /');

            exit();
        }
        try {
            if(!empty($_POST['productId']) && !empty($_POST['quantity']) && $_POST['buyPrice']){
                $product = $this->daoProduct->selectOne($_POST['productId']);
                $quantity = $_POST['quantity'];
                $buyPrice = $_POST['buyPrice'];
                if ($quantity>0 && $buyPrice>0){
                    $this->daoStock->insert(new Stock(0, $quantity, date('Y-m-d H:i:s'), $buyPrice, 1, $this->daoProduct->selectOne($product->getID())));
                    $params['errors'] = "Ajout reussi";
                    $params['products'] = $this->daoProduct->selectAll();
                    echo $this->view->render('stockForm.php', $params);
                }
            }else{
                $params['errors'] = "Merci de remplir les champs";
                $params['products'] = $this->daoProduct->selectAll();
                echo $this->view->render('stockForm.php', $params);
            }
        }catch (DBException $e){
            $params['errors'] = "Erreur: Verifiez la connexion à la base de données";
            $params['products'] = $this->daoProduct->selectAll();
            echo $this->view->render('stockForm.php', $params);
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
        // TODO: Implement delete() method.
    }





}