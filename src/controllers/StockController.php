<?php

namespace CashRegister\controllers;


use CashRegister\core\exception\DBException;
use CashRegister\core\View;
use CashRegister\daos\DAOProduct;
use CashRegister\daos\DAOStock;
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
    }

    /**
     * @throws DBException
     */
    public function get(): void
    {
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

    public function add(): void
    {
        $params =[];
        echo $this->view->render('stockForm.php', $params);
    }

    public function post(): void
    {

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