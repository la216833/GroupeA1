<?php

namespace CashRegister\daos;

use CashRegister\core\database\DBModel;
use CashRegister\core\exception\DBException;
use CashRegister\models\Role;
use CashRegister\models\User;

class DAOUser implements DAO {
    const TABLE = "users";
    private User $user;
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
            "usersID" => $object->getID(),
            "usersName" => $object->getName(),
            "usersFirstname" => $object->getFirstname(),
            "usersAccessCode" => $object->getAccessCode(),
            "usersImagePath" => $object->getImagePath(),
            "usersActive" => $object->getStatus(),
            "rolesID" => $object->getRole()->getID(),
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
            $role = $this->DBModel->selectOne('roles', $result["rolesID"]);
            $role = new Role($role["rolesID"], $role["rolesName"], $role["rolesActive"]);
            return new User(
                $result["usersID"],
                $result["usersName"],
                $result["usersFirstname"],
                $result["usersAccessCode"],
                $result["usersImagePath"],
                $result["usersActive"],
                $role,
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
        try {
            $users = $this->DBModel->selectAll(self::TABLE);
            foreach ($users as $key => $user) {
                $role = $this->DBModel->selectOne('roles', $user["rolesID"]);
                $role = new Role($role["rolesID"], $role["rolesName"], $role["rolesActive"]);
                $result[] =new User(
                    $user["usersID"],
                    $user["usersName"],
                    $user["usersFirstname"],
                    $user["usersAccessCode"],
                    $user["usersImagePath"],
                    $user["usersActive"],
                    $role,
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
            $users = $this->DBModel->selectWhere(self::TABLE, $params);
            foreach ($users as $key => $user) {
                $role = $this->DBModel->selectOne('roles', $user["rolesID"]);
                $role = new Role($role["rolesID"], $role["rolesName"], $role["rolesActive"]);
                $result[] =new User(
                    $user["usersID"],
                    $user["usersName"],
                    $user["usersFirstname"],
                    $user["usersAccessCode"],
                    $user["usersImagePath"],
                    $user["usersActive"],
                    $role,
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
            "usersID" => $object->getID(),
            "usersName" => $object->getName(),
            "usersFirstname" => $object->getFirstname(),
            "usersAccessCode" => $object->getAccessCode(),
            "usersImagePath" => $object->getImagePath(),
            "usersActive" => $object->getStatus(),
            "rolesID" => $object->getRole()->getID(),
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
            "usersID" => $object->getID(),
            "usersName" => $object->getName(),
            "usersFirstname" => $object->getFirstname(),
            "usersAccessCode" => $object->getAccessCode(),
            "usersImagePath" => $object->getImagePath(),
            "usersActive" => false,
            "rolesID" => $object->getRole()->getID(),
        ];
        try {
            return $this->DBModel->update(self::TABLE, $this->params);
        } catch (DBException $e) {
            throw new DBException($e);
        }
    }
}