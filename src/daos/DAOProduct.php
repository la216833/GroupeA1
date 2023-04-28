<?php

namespace CashRegister\daos;

use CashRegister\core\database\DBModel;
use CashRegister\core\exception\DBException;
use CashRegister\models\Category;
use CashRegister\models\Product;
use CashRegister\models\Role;
use CashRegister\models\TVA;
use CashRegister\models\User;

class DAOProduct implements DAO
{
    private DBModel $DBModel ;
    const TABLE = "products";

    private DAOCategory $DAOCategory;

    private DAOTva $DAOTva;


    public function __construct()
    {
        $this->DBModel = new DBModel();
        $this->DAOTva = new DAOTva();
        $this->DAOCategory = new DAOCategory();
    }

    /**
     * @throws DBException
     */
    public function insert(object $object): bool
    {
        try {
            $params =[
                'productsID' => $object->getID(),
                'productsName' => $object->getName(),
                'productsDescription' => $object->getDescription(),
                'productsPrice' => $object->getPrice(),
                'productsImagePath' => $object->getImagePath(),
                'productsActive' => $object->getActive(),
                'tvaID' => $object->getTva()->getID(),
                'categoriesID' => $object->getCategory()->getID()
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

            $category = $this->DAOCategory->selectOne($tab["categoriesID"]);
            $tva = $this->DAOTva->selectOne($tab["tvaID"]);

            return new Product($id, $tab["productsName"], $tab["productsDescription"], $tab["productsPrice"], $tab["productsImagePath"], $tab["productsActive"], $tva, $category);
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
            $products = $this->DBModel->selectAll(self::TABLE);
            foreach ($products as $key => $product) {
                $tva = $this->DAOTva->selectOne($product["tvaID"]);
                $category = $this->DAOCategory->selectOne($product["categoriesID"]);
                $result[] =new Product(
                    $product["productsID"],
                    $product["productsName"],
                    $product["productsDescription"],
                    $product["productsPrice"],
                    $product["productsActive"],
                    $product["productsImagePath"],
                    $tva,
                    $category
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
    public function selectWhere($params): array
    {
        $result = [];
        try {
            $products = $this->DBModel->selectWhere(self::TABLE, $params);
            foreach ($products as $key => $product) {
                $tva = $this->DAOTva->selectOne($product["tvaID"]);
                $category = $this->DAOCategory->selectOne($product["categoriesID"]);
                $result[] =new Product(
                    $product["productsID"],
                    $product["productsName"],
                    $product["productsDescription"],
                    $product["productsPrice"],
                    $product["productsActive"],
                    $product["productsImagePath"],
                    $tva,
                    $category
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
                'productsID' => $object->getID(),
                'productsName' => $object->getName(),
                'productsDescription' => $object->getDescription(),
                'productsPrice' => $object->getPrice(),
                'productsImagePath' => $object->getImagePath(),
                'productsActive' => $object->getActive(),
                'tvaID' => $object->getTva()->getID(),
                'categoriesID' => $object->getCategory()->getID()
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
                'productsID'=> $object->getId(),
                'productsActive' => 0
            ];
            $this->DBModel->update(self::TABLE, $params);
            return true;

        }catch (DBException $e){
            throw new DBException($e);
        }
    }
}