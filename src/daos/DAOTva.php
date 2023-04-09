<?php

namespace CashRegister\daos;

use CashRegister\core\database\DBConnection;
use CashRegister\core\database\DBModel;
use CashRegister\core\exception\DBException;
use CashRegister\models\TVA;
use PDO;

class DAOTva implements DAO
{
    private DBModel $DBModel;
    const TABLE = "tva";
    private PDO $conn;

    public function __construct()
    {
        $this->DBModel = new DBModel();
        $this->conn = DBConnection::getInstance();
    }


    /**
     * @throws DBException
     */
    public function insert(object $object): bool
    {
        try {
            $params =[
                'tvaName' => $object->getName(),
                'tvaPercent' => $object->getPercent(),
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
            $returnedTva = new TVA($tab["tvaPercent"], $tab["tvaName"]);
            $returnedTva->setId($id);
            return $returnedTva;
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
                'tvaID' => $object->getId(),
                'tvaName' => $object->getName(),
                'tvaPercent' => $object->getPercent(),
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
        try{
            $query = "DELETE FROM tva WHERE tvaID=:tva";
            $stmt = $this->conn->prepare($query);
            $stmt->execute(['tva'=>$object->getId()]);
            return true;

        }catch (DBException $e){
            throw new DBException($e);
        }
    }
}
