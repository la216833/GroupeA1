<?php

namespace CashRegister\daos;

use CashRegister\core\database\DBModel;
use CashRegister\core\exception\DBException;
use CashRegister\models\Categories;

class DAOCategories implements DAO
{

    private DBModel $DBModel;
    const TABLE = "categories";


    public function __construct()
    {

        $this->DBModel = new DBModel();

    }

    /**
     * @param object $object
     * @return bool
     * @throws DBException
     */
    public function insert(object $object): bool
    {
        try {

            $params = [
                'categoriesName' => $object->getCategoriesName(),
                'categoriesDescription' => $object->getCategoriesDescription(),
                'categoriesActive' => $object->isCategoriesActive()
            ];

            $this->DBModel->insert(self::TABLE, $params);
            return true;

        }catch (DBException $e) {

            throw new DBException($e);

        }
    }

    /**
     * @param int $id
     * @return object
     * @throws DBException
     */
    public function selectOne(int $id): object
    {
        try {

            $tab = $this->DBModel->selectOne(self::TABLE, $id);
            $returnedCategories = new Categories($tab["categoriesName"],$tab["categoriesDescription"]);
            $returnedCategories->setCategoriesID($tab["categoriesID"]);
            return $returnedCategories;

        }catch (DBException $e){

            throw new DBException($e);

        }
    }

    /**
     * @return array
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
     * @param array $params
     * @return array
     * @throws DBException
     */
    public function selectWhere(array $params): array
    {
        try {

            return $this->DBModel->selectWhere(self::TABLE, $params);

        }catch (DBException $e) {

            throw new DBException($e);

        }
    }

    /**
     * @param object $object
     * @return bool
     * @throws DBException
     */
    public function update(object $object): bool
    {
        try {

            $params = [
                'categoriesName' => $object->getCategoriesName(),
                'categoriesDescription' => $object->getCategoriesDescription(),
                'categoriesActive' => $object->isCategoriesActive()
            ];

            $this->DBModel->update(self::TABLE, $params);
            return true;

        }catch (DBException $e){

            throw new DBException($e);

        }
    }

    /**
     * @param object $object
     * @return bool
     * @throws DBException
     */
    public function delete(object $object): bool
    {
        try {
            $params =[
                'categoriesID'=>$object->getCategoriesID(),
                'categoriesActive' => false
            ];
            $this->DBModel->update(self::TABLE, $params);
            return true;

        }catch (DBException $e){
            throw new DBException($e);
        }
    }
}