<?php

namespace CashRegister\daos;

use CashRegister\core\database\DBConnection;
use CashRegister\core\database\DBModel;
use CashRegister\core\exception\DBException;
use CashRegister\models\Product;
use CashRegister\models\Stock;

class DAOStock implements DAO
{
    const TABLE = "stock";

    private DBModel $DBModel;

    private DAOProduct $DAOProduct;



    public function __construct()
    {
        $this->DBModel = new DBModel();
        $this->DAOProduct = new DAOProduct();
    }


    /**
     * @throws DBException
     */
    public function insert(object $object): bool
    {
        try {
            $params =[
                'stockQuantity' => $object->getQuantity(),
                'stockDate' => $object->getDate(),
                'stockBuyPrice' => $object->getBuyPrice(),
                'stockActive' => $object->getActive(),
                'productsID' =>$object->getProduct()->getID(),
            ];

            $this->DBModel->insert(self::TABLE, $params);
            return true;

        }catch (DBException $e){
            throw new DBException($e);
        }
    }

    /**
     * @throws DBException
     */
    public function selectOne(int $id): Stock
    {
        $product = $this->DAOProduct->selectOne(3);
        try {
            $tab = $this->DBModel->selectOne(self::TABLE, $id);
            $returnedStock = new Stock($id, $tab["stockQuantity"], $tab["stockDate"],$tab["stockBuyPrice"],$tab["stockActive"],$product);
            $returnedStock->setID($id);
            return $returnedStock;
        }catch (DBException $e){
            throw new DBException($e);
        }
    }

    /**
     * @throws DBException
     */
    public function selectAll(): array
    {
        $result = [];
        try {
            $stocks = $this->DBModel->selectAll(self::TABLE);
            foreach ($stocks as $key => $stock) {
                $product = $this->DAOProduct->selectOne($stock["productsID"]);
                $result[] =new stock(
                    $stock["stockID"],
                    $stock["stockQuantity"],
                    $stock["stockDate"],
                    $stock["stockBuyPrice"],
                    $stock["stockActive"],
                    $product
                );
            }

            return $result;

        } catch (DBException $e) {
            throw new DBException($e);
        }
    }

    /**
     * @throws DBException
     */
    public function selectWhere(array $params): array
    {
        $result = [];
        try {
            $stocks = $this->DBModel->selectWhere(self::TABLE, $params);
            foreach ($stocks as $key => $stock) {
                $product = $this->DAOProduct->selectOne($stock["productsID"]);
                $result[] =new stock(
                    $stock["stockID"],
                    $stock["stockQuantity"],
                    $stock["stockDate"],
                    $stock["stockBuyPrice"],
                    $stock["stockActive"],
                    $product
                );
            }
            return $result;
        } catch (DBException $e) {
            throw new DBException($e);
        }
    }

    /**
     * @throws DBException
     */
    public function update(object $object): bool
    {
        try {
            $params =[
                'stockID' => $object->getID(),
                'stockQuantity' => $object->getQuantity(),
                'stockDate' => $object->getDate(),
                'stockBuyPrice' => $object->getBuyPrice(),
                'stockActive' => $object->getActive(),
                'productsID' =>$object->getProduct()->getID()
            ];

            $this->DBModel->update(self::TABLE, $params);
            return true;

        }catch (DBException $e){
            throw new DBException($e);
        }
    }

    /**
     * @throws DBException
     */
    public function delete(object $object): bool
    {
        try {
            $params =[
                'stockID' => $object->getID(),
                'stockActive' => 0
            ];

            $this->DBModel->update(self::TABLE, $params);
            return true;

        }catch (DBException $e){
            throw new DBException($e);
        }
    }

    public function getSumSelledStocks(): float
    {
        return $this->DBModel->columnSum("salesContent", "quantity");
    }

    public function getAvgSelledStocks(): float
    {
        return $this->DBModel->columnAvg("salesContent", "quantity");
    }
}