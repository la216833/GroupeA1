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

        $this->params = [
            'categoriesID' => $object->getCategoriesId(),
            'categoriesName' => $object->getCategoriesName(),
            'categoriesDescription' => $object->getCategoriesDescription(),
            'categoriesActive' => $object->isCategoriesActive()
        ];

        try {

            $this->DBModel->insert(self::TABLE, $this->params);
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
            $returnedCategories = new Categories($tab["categoriesID"],$tab["categoriesName"],$tab["categoriesDescription"]);
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

        $result = [];
        try {

            $categories = $this->DBModel->selectWhere(self::TABLE, $params);
            foreach ($categories as $key => $category) {

                $result[] = new Categories(
                    $category["categoriesID"],
                    $category["categoriesName"],
                    $category["categoriesDescription"],
                );
            }

            return $result;

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

        $this->params = [
            'categoriesID' => $object->getCategoriesID(),
            'categoriesName' => $object->getCategoriesName(),
            'categoriesDescription' => $object->getCategoriesDescription(),
            'categoriesActive' => $object->isCategoriesActive()
        ];

        try {

            return $this->DBModel->update(self::TABLE, $this->params);

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