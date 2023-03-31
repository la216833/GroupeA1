<?php

namespace CashRegister\core\database;

use CashRegister\core\exception\DBException;
use Exception;
use PDO;

/**
 * Gives basic CRUD operations
 */
class DBModel {

    /** @var PDO $pdo PDO instance*/
    private PDO $pdo;
    /** @var string $query SQL query */
    private string $query;


    public function __construct() {
        $this->pdo = DBConnection::getInstance();
        $this->query = "";
    }

    /**
     * Insert element in table
     *
     * @param string $table table to use
     * @param string[] $params associative array with columns and values
     *
     * @return bool true if the insert went success else throw error
     * @throws DBException
     */
    public function insert(string $table, array $params): bool {
        $column = array_keys($params);
        try {
            $this->pdo = DBConnection::getInstance();
            $this->query = "INSERT INTO $table (".
                implode(',', $column) .") VALUES (".
                implode(", ", array_map(fn($attr) => ":$attr", $column)) .")";
            $statement = $this->pdo->prepare($this->query);
            foreach ($params as $column => $value) {
                $PDOType = match (gettype($value)) {
                    "boolean" => PDO::PARAM_BOOL,
                    "integer" => PDO::PARAM_INT,
                    default => PDO::PARAM_STR,
                };
                $statement->bindValue(":$column", $value, $PDOType);

            }
            $statement->execute();
        } catch (Exception) {
            throw new DBException("IMPOSSIBLE D'EFFECTUER L'INSERTION");
        } finally {
            DBConnection::close();
        }
        return true;
    }

    /**
     * Search an element with ID
     *
     * @param string $table table to use
     * @param int $id select an element with id
     *
     * @return array associative array with result if success else throw error
     * @throws DBException
     */
    public function selectOne(string $table, int $id): array {
        try {
            $this->pdo = DBConnection::getInstance();
            $this->query = "SELECT * FROM $table WHERE ".$table."ID=:ID LIMIT 1";
            $statement = $this->pdo->prepare($this->query);
            $statement->bindValue(':ID', $id);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $result = $statement->fetch();
        } catch (Exception) {
            throw new DBException("IMPOSSIBLE D'EFFECTUER LA SELECTION");
        } finally {
            DBConnection::close();
        }
        return !$result ? throw new DBException("L'ÉLÉMENT N'EXISTE PAS") : $result;
    }

    /**
     * Select all elements from table
     *
     * @param string $table table to use
     *
     * @return array array of associatives arrays with all elements
     * @throws DBException
     */
    public function selectAll(string $table): array {
        try {
            $this->pdo = DBConnection::getInstance();
            $this->query = "SELECT * FROM $table";
            $statement = $this->pdo->prepare($this->query);
            $statement->execute();
        } catch (Exception) {
            throw new DBException("IMPOSSIBLE D'EFFECTUER LA REQUÊTE");
        } finally {
            DBConnection::close();
        }
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        return $statement->fetchAll();
    }

    /**
     * Select element with where clause
     *
     * @param string $table table to use
     * @param string[] $params associative array with column and value
     *
     * @return array array of associatives arrays with all elements
     * @throws DBException
     */
    public function selectWhere(string $table, array $params): array {
        $column = array_keys($params);
        try {
            $this->pdo = DBConnection::getInstance();
            $this->query = "SELECT * FROM $table WHERE ".
                implode(' AND ', array_map(fn($attr) => "$attr=:$attr", $column));
            $statement = $this->pdo->prepare($this->query);
            foreach ($params as $column => $value) {
                $PDOType = match (gettype($value)) {
                    "boolean" => PDO::PARAM_BOOL,
                    "integer" => PDO::PARAM_INT,
                    default => PDO::PARAM_STR,
                };
                $statement->bindValue(":$column", $value, $PDOType);
            }

            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $result = $statement->fetchAll();
        } catch (Exception) {
            throw new DBException("IMPOSSIBLE D'EFFECTUER LA REQUÊTE");
        } finally {
            DBConnection::close();
        }
        return !$result ? [] : $result;
    }

    /**
     * Update element with ID
     *
     * @param string $table table to use
     * @param string[] $params associative array with column and value
     *
     * @return bool true if the update was success else error
     * @throws DBException
     */
    public function update(string $table, array $params): bool {
        $column = array_keys($params);
        $idName = array_shift($column);
        $idValue = array_shift($params);
        try {
            $this->pdo = DBConnection::getInstance();
            $this->query = "UPDATE $table SET ".
                implode(', ', array_map(fn($attr) => "$attr=:$attr", $column)).
                " WHERE ". $idName . "=:". $idName;
            $statement = $this->pdo->prepare($this->query);
            foreach ($params as $column => $value) {
                $PDOType = match (gettype($value)) {
                    "boolean" => PDO::PARAM_BOOL,
                    "integer" => PDO::PARAM_INT,
                    default => PDO::PARAM_STR,
                };
                $statement->bindValue(":$column", $value, $PDOType);
            }
            $statement->bindValue(":$idName", $idValue, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->rowCount();
        } catch (Exception) {
            throw new DBException("IMPOSSIBLE D'EFFECTUER LA REQUÊTE");
        } finally {
            DBConnection::close();
        }
        return $result == 0 ? throw new DBException("IMPOSSIBLE D'EFFECTUER LA REQUÊTE") : true;
    }
}