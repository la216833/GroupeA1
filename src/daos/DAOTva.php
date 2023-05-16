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
                'tvaID' => $object->getID(),
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
    public function selectOne(int $id): TVA
    {
        try {
            $tab = $this->DBModel->selectOne(self::TABLE, $id);
            return new TVA($id, $tab["tvaPercent"], $tab["tvaName"]);
        }catch (DBException $e){
            throw new DBException($e);
        }
    }

    /**
     * @throws DBException
     */
    public function selectAll(): array {
        $result = [];
        try {
            $tvas = $this->DBModel->selectAll(self::TABLE);
            foreach ($tvas as $key => $tva) {
                $result[] = new TVA($tva["tvaID"], $tva["tvaPercent"], $tva["tvaName"]);
            }
            return $result;
        } catch (DBException $e){
            throw new DBException($e);
        }
    }

    /**
     * @throws DBException
     */
    public function selectWhere(array $params): array {
        $result = [];
        try {
            $tvas = $this->DBModel->selectAll(self::TABLE, $params);
            foreach ($tvas as $key => $tva) {
                $result[] = new TVA($tva["tvaID"], $tva["tvaPercent"], $tva["tvaName"]);
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
