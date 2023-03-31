<?php

namespace CashRegister\daos;

use CashRegister\core\database\DBModel;
use CashRegister\core\exception\DBException;
use CashRegister\models\Role;

class DAORole implements DAO {

    const TABLE = "roles";
    private Role $role;
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
            "rolesName" => $object->getName(),
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
        try {
            $result = $this->DBModel->selectOne(self::TABLE, $id);
            return new Role($result["rolesID"], $result["rolesName"], $result["rolesActive"]);
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
            $roles = $this->DBModel->selectAll(self::TABLE);
            foreach ($roles as $key => $role) {
                $result[] = new Role($role["rolesID"], $role["rolesName"], $role["rolesIsActive"]);
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
            $roles = $this->DBModel->selectWhere(self::TABLE, $params);
            foreach ($roles as $key => $role) {
                $result[] = new Role($role["rolesID"], $role["rolesName"], (bool) $role["rolesActive"]);
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
            "rolesID" => $object->getID(),
            "rolesName" => $object->getName(),
            "rolesActive" => $object->getActive(),
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
            "rolesID" => $object->getID(),
            "rolesName" => $object->getName(),
            "rolesActive" => false,
        ];
        try {
            return $this->DBModel->update(self::TABLE, $this->params);
        } catch (DBException $e) {
            throw new DBException($e);
        }
    }
}