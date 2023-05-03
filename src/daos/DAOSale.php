<?php

namespace CashRegister\daos;

use CashRegister\core\database\DBModel;
use CashRegister\core\exception\DBException;
use CashRegister\models\Sale;

class DAOSale implements DAO {

    const TABLE = "sales";
    private DBModel $DBModel;
    private array $params;

    public function __construct() {
        $this->DBModel = new DBModel();
    }

    /**
     * @throws DBException
     */
    public function insert(object $object): bool {
        $this->params = [
            "salesID" => $object->getID(),
            "salesDate" => $object->getDate(),
            "salesAmount" => $object->getAmount(),
            "salesDescription" => $object->getDescription(),
            "usersId" => $object->getUser()->getID(),
            "clientsId" => $object->getClient()->getID(),
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
    public function selectOne(int $id): object {
        $daoUser = new DAOUser();
        $daoClient = new DAOClient();
        try {
            $result = $this->DBModel->selectOne(self::TABLE, $id);
            $user = $daoUser->selectOne($result["usersID"]);
            $client = $daoClient->selectOne($result["clientsID"]);
            return new Sale(
                $result["salesID"],
                $result["salesDate"],
                $result["salesAmount"],
                $result["salesDescription"] ?? "",
                $user,
                $client,
            );
        } catch (DBException $e) {
            throw new DBException($e);
        }
    }

    /**
     * @throws DBException
     */
    public function selectAll(): array {
        $result = [];
        $daoUser = new DAOUser();
        $daoClient = new DAOClient();
        try {
            $sales = $this->DBModel->selectAll(self::TABLE);
            foreach ($sales as $key => $sale) {
                $user = $daoUser->selectOne($sale["usersID"]);
                $client = $daoClient->selectOne($sale["clientsId"]);
                $result[] =new Sale(
                    $sale["salesId"],
                    $sale["salesDate"],
                    $sale["salesAmount"],
                    $sale["salesDescription"] ?? "",
                    $user,
                    $client
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
        $daoUser = new DAOUser();
        $daoClient = new DAOClient();
        try {
            $sales = $this->DBModel->selectWhere(self::TABLE, $params);
            foreach ($sales as $key => $sale) {
                $result[] = new Sale(
                    $sale["salesID"],
                    $sale["salesDate"],
                    $sale["salesAmount"],
                    $sale["salesDescription"] ?? "",
                    $daoUser->selectOne($sale["usersID"]),
                    $daoClient->selectOne($sale["clientsID"]),
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
            "salesID" => $object->getID(),
            "salesDate" => $object->getDate(),
            "salesAmount" => $object->getAmount(),
            "salesDescription" => $object->getDescription(),
            "usersID" => $object->getUser()->getID(),
            "clientsID" => $object->getClient()->getID(),
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
            "salesID" => $object->getID(),
            "salesDate" => $object->getDate(),
            "salesAmount" => $object->getAmount(),
            "salesDescription" => $object->getDescription(),
            "usersID" => $object->getUser()->getID(),
            "clientsID" => $object->getClient()->getID(),
        ];
        try {
            return $this->DBModel->update(self::TABLE, $this->params);
        } catch (DBException $e) {
            throw new DBException($e);
        }
    }
}