<?php
/**
 *   Made by D.Logan (la216833)
 *   Started 06/04/2023
 *   Last Modified 06/04/2023
 */
namespace CashRegister\daos;

use CashRegister\core\database\DBModel;
use CashRegister\core\exception\DBException;
use CashRegister\models\Address;

class DAOAddress implements DAO{

    private DBModel $DBModel;
    const TABLE = "address";

    public function __construct(){
        $this->DBModel = new DBModel();
    }

    /**
     * @param object $object
     * @return bool
     * @throws DBException
     */
    public function insert(object $object): bool
    {

        $this->params =[
            'addressID'=>$object->getID(),
            'addressStreet' => $object->getStreet(),
            'addressNumber' => $object->getNumber(),
            'addressCity' => $object->getCity(),
            'addressCountry' => $object->getCountry()
        ];

        try {

            $this->DBModel->insert(self::TABLE, $this->params);
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
            $returnedAddress = new Address($tab["addressID"],$tab["addressStreet"], $tab["addressNumber"], $tab["addressCity"], $tab["addressCountry"]);
            return $returnedAddress;

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
        $result = [];
        try {

            $addresses = $this->DBModel->selectAll(self::TABLE);
            foreach ($addresses as $key => $address) {

                $result[] = new Address(
                    $address["addressID"],
                    $address["addressStreet"],
                    $address["addressNumber"],
                    $address["addressCity"],
                    $address["addressCountry"]
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

        $result = [];
        try {

            $addresses = $this->DBModel->selectWhere(self::TABLE, $params);
            foreach ($addresses as $key => $address) {

                $result[] = new Address(
                    $address["addressID"],
                    $address["addressStreet"],
                    $address["addressNumber"],
                    $address["addressCity"],
                    $address["addressCountry"]
                );
            }

            return $result;
        }catch (DBException $e){
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

            $params =[
                'addressStreet' => $object->getStreet(),
                'addressNumber' => $object->getNumber(),
                'addressCity' => $object->getCity(),
                'addressCountry' => $object->getCountry()
            ];

            $this->DBModel->update(self::TABLE, $params);
            return true;

        }catch (DBException $e){
            throw new DBException($e);
        }
    }


    public function delete(object $object): bool
    {
        return false;
    }

}