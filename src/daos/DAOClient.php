<?php
/**
 *   Made by D.Logan (la216833)
 *   Started 05/04/2023
 *   Last Modified 06/04/2023
 */
namespace CashRegister\daos;

use CashRegister\core\database\DBConnection;
use CashRegister\core\database\DBModel;
use CashRegister\core\exception\DBException;
use CashRegister\models\Client;
use CashRegister\models\Address;

class DAOClient implements DAO
{
    const TABLE = "clients";
    private DBModel $DBModel;
    private DAOAddress $DAOAddress;

    public function __construct(){
        $this->DBModel = new DBModel();
        $this->DAOAddress = new DAOAddress();
    }

    /**
     * @param object $object
     * @return bool
     * @throws DBException
     */
    public function insert(object $object): bool
    {
        try {
            $params =[
                'clientsID' => $object->getID(),
                'clientsName' => $object->getName(),
                'clientsFirstname' => $object->getFirstName(),
                'clientsTvaNumber' => $object->getTVANumber(),
                'clientsEmail' => $object->getMail(),
                'clientsActive' => $object->getActive(),
                'addressID' => $object->getAddress()->getID()
            ];

            $this->DBModel->insert(self::TABLE, $params);
            return true;

        }catch (DBException $e){
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
            $address = $this->DAOAddress->selectOne($tab["addressID"]);
            $returnedClient = new Client($tab["clientsID"],$tab["clientsName"], $tab["clientsFirstname"], $tab["clientsTvaNumber"], $tab["clientsEmail"], $tab["clientsActive"], $address);
            return $returnedClient;
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

            $clients = $this->DBModel->selectAll(self::TABLE);

            foreach ($clients as $key => $client){
                $address = $this->DAOAddress->selectOne($client["addressID"]);
                $result[] = new Client(
                  $client["clientsID"],
                  $client["clientsName"],
                  $client["clientsFirstname"],
                  $client["clientsTvaNumber"],
                  $client["clientsEmail"],
                  $client["clientsActive"],
                  $address
                );
            }

            return $result;

        }catch (DBException $e){
            throw new DBException($e);
        }

    }

    /**
     * @param $params
     * @return array
     * @throws DBException
     */
    public function selectWhere($params): array
    {
        try {
            $result = [];
            $clients = $this->DBModel->selectWhere(self::TABLE,$params);

            foreach ($clients as $key => $client){
                $address = $this->DAOAddress->selectOne($client["addressID"]);
                $result[] = new Client(
                    $client["clientsID"],
                    $client["clientsName"],
                    $client["clientsFirstname"],
                    $client["clientsTvaNumber"],
                    $client["clientsEmail"],
                    $client["clientsActive"],
                    $address
                );
            }

            return $result;

        } catch (DBException $e) {
            throw new DBException($e);
        }


    }

    /**
     * @param object $object
     * @return bool
     * @throws DBException
     */
    public function update(object $object): bool{

        try {
            $params =[
                'clientsID' => $object->getID(),
                'clientsName' => $object->getName(),
                'clientsFirstname' => $object->getFirstName(),
                'clientsTvaNumber' => $object->getTVANumber(),
                'clientsEmail' => $object->getMail(),
                'clientsActive' => $object->getActive(),
                'addressID' => $object->getAddress()->getID()
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
                'clientsID'=>$object->getID(),
                'clientsActive' => false
            ];
            $this->DBModel->update(self::TABLE, $params);
            return true;

        }catch (DBException $e){
            throw new DBException($e);
        }
    }

}