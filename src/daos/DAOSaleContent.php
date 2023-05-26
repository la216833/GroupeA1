<?php

namespace CashRegister\daos;

use CashRegister\core\database\DBModel;
use CashRegister\core\exception\DBException;
use CashRegister\models\SaleContent;

class DAOSaleContent implements DAO {
    const TABLE = "salesContent";
    private DBModel $DBModel;
    private DAOProduct $DAOProduct;
    private DAOSale $DAOSale;
    private array $params;

    public function __construct() {
        $this->DBModel = new DBModel();
        $this->DAOProduct = new DAOProduct();
        $this->DAOSale = new DAOSale();
    }

    /**
     * @throws DBException
     */
    public function insert(object $object): bool {
        $this->params = [
            "salesID" => $object->getSale()->getID(),
            "productsID" => $object->getProduct()->getID(),
            "quantity" => $object->getQuantity(),
        ];
        try {
            $this->DBModel->insert(self::TABLE, $this->params);
            return true;
        } catch (DBException $e) {
            throw new DBException($e);
        }
    }

    /**
     * @throws DBException
     */
    public function selectOne(int $id): array {
        $result = [];
        try {
            $contents = $this->DBModel->selectWhere(self::TABLE, ["salesID" => $id]);
            foreach ($contents as $key => $content) {
                $result[] = new SaleContent(
                    $this->DAOProduct->selectOne($content["productsID"]),
                    $this->DAOSale->selectOne($content["salesID"]),
                    $content["quantity"]
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
    public function selectAll(): array {
        $result = [];
        try {
            $contents = $this->DBModel->selectAll(self::TABLE);
            foreach ($contents as $key => $content) {
                $result[] = new SaleContent(
                    $this->DAOProduct->selectOne($content["productsID"]),
                    $this->DAOSale->selectOne($content["salesID"]),
                    $content["quantity"]
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
    public function selectWhere(array $params): array {
        $result = [];
        try {
            $contents = $this->DBModel->selectWhere(self::TABLE, $params);
            foreach ($contents as $key => $content) {
                $sale = null;
                $product = null;
                $result[] = new SaleContent(
                    $this->DAOProduct->selectOne($content["productsID"]),
                    $this->DAOSale->selectOne($content["salesID"]),
                    $content["quantity"]
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
    public function update(object $object): bool {
        $this->params = [
            "salesID" => $object->getSale()->getID(),
            "productsID" => $object->getProduct()->getID(),
            "quantity" => $object->getQuantity(),
        ];
        try {
            return $this->DBModel->update(self::TABLE, $this->params);
        } catch (DBException $e) {
            throw new DBException($e);
        }
    }

    /**
     * @throws DBException
     */
    public function delete(object $object): bool {
        $this->params = [
            "salesID" => $object->getSale()->getID(),
            "productsID" => $object->getProduct()->getID(),
            "quantity" => $object->getQuantity(),
        ];
        try {
            return $this->DBModel->update(self::TABLE, $this->params);
        } catch (DBException $e) {
            throw new DBException($e);
        }
    }

    public function sumQuantity(){

    }
}