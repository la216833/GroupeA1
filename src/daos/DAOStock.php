<?php

namespace CashRegister\daos;

use CashRegister\core\database\DBConnection;
use CashRegister\core\database\DBModel;
use CashRegister\core\exception\DBException;
use CashRegister\models\Stock;
use CashRegister\models\TVA;

class DAOStock implements DAO
{
    const  TABLE = "stock";

    private DBModel $DBModel;

    /**
     * @param DBModel $DBModel
     */
    public function __construct()
    {
        $this->DBModel = new DBModel();
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
                'stockActive' => $object->isActive(),
                'productsID' =>$object->getProductID()
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
    public function selectOne(int $id): object
    {
        try {
            $tab = $this->DBModel->selectOne(self::TABLE, $id);
            $returnedStock = new Stock($tab["stockQuantity"], $tab["stockDate"],$tab["stockBuyPrice"],$tab["stockActive"],$tab["productID"]);
            $returnedStock->setId($id);
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
        try {
            return $this->DBModel->selectAll(self::TABLE);
        }catch (DBException $e){
            throw new DBException($e);
        }
    }

    /**
     * @throws DBException
     */
    public function selectWhere(array $params): array
    {
        try {
            return $this->DBModel->selectWhere(self::TABLE,$params);
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
                'stockID' => $object->getId(),
                'stockQuantity' => $object->getQuantity(),
                'stockDate' => $object->getDate(),
                'stockBuyPrice' => $object->getBuyPrice(),
                'stockActive' => $object->isActive(),
                'productsID' =>$object->getProductID()
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
                'stockID' => $object->getId(),
                'stockActive' => 0
            ];

            $this->DBModel->update(self::TABLE, $params);
            return true;

        }catch (DBException $e){
            throw new DBException($e);
        }
    }
}