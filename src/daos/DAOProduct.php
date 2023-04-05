<?php

namespace CashRegister\daos;

use CashRegister\core\database\DBModel;
use CashRegister\core\exception\DBException;
use CashRegister\models\Product;

class DAOProduct implements DAO
{
    private DBModel $DBModel ;
    const TABLE = "products";


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
            $val = $object->getStockIDs();//temp
            $params =[
                'productsName' => $object->getName(),
                'productsDescription' => $object->getDescription(),
                'productsPrice' => $object->getPrice(),
                'productsAvailable' => $object->isAvailable(),
                'productsImagePath' => $object->getImagePath(),
                'stockID' => $val[1],
                'tvaID' => $object->getTvaID()
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
            $stockArrays = [$tab["stockID"]];
            $returnedProduct = new Product($tab["productsName"], $tab["productsDescription"], $tab["productsPrice"], $tab["productsAvailable"], $tab["productsImagePath"], $stockArrays, $tab["tvaID"]);
            $returnedProduct->setId($tab["productsID"]);
            return $returnedProduct;
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
    public function selectWhere($params): array
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
            $val = $object->getStockIDs();
            $params =[
                'productsID'=> $object->getId(),
                'productsName' => $object->getName(),
                'productsDescription' => $object->getDescription(),
                'productsPrice' => $object->getPrice(),
                'productsAvailable' => $object->isAvailable(),
                'productsImagePath' => $object->getImagePath(),
                'stockID' => $val[1],
                'tvaID' => $object->getTvaID()
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
                'productsID'=>$object->getId(),
                'productsAvailable' => 0
            ];
            $this->DBModel->update(self::TABLE, $params);
            return true;

        }catch (DBException $e){
            throw new DBException($e);
        }
    }
}