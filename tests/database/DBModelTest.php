<?php

namespace database;

use CashRegister\core\database\DBModel;
use CashRegister\core\exception\DBException;
use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

class DBModelTest extends TestCase {

    private DBModel $DBModel;

    public static function setUpBeforeClass(): void {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    }

    public function setUp(): void {
        $this->DBModel = new DBModel();
    }

    /**
     * @throws DBException
     */
    public function testInsertSuccess(): void {
        $params = [
            'addressStreet' => 'Rockefeller',
            'addressNumber' => 90,
            'addressCity' => 7536,
            'addressCountry' => 'Belgium',
        ];
        $result = $this->DBModel->insert('address', $params);
        $this->assertTrue($result);
    }

    public function testInsertError(): void {
        $this->expectException(DBException::class);
        $params = [
            'addressStreet' => 'Rockefeller',
            'addressNumber' => 90,
            'addressCity' => 7536
        ];
        $result = $this->DBModel->insert('address', $params);
    }

    /**
     * @throws DBException
     */
    public function testSelectOneSuccess(): void {
        $expected = ["rolesID" => 1, "rolesName" => "administrator", "rolesActive" => 1];
        $result = $this->DBModel->selectOne('roles', 1);
        $this->assertEqualsCanonicalizing($expected, $result);
    }

    public function testSelectOneError(): void {
        $this->expectException(DBException::class);
        $this->DBModel->selectOne('roles', 100000);
    }

    /**
     * @throws DBException
     */
    public function testSelectAllSuccess(): void {
        $result = $this->DBModel->selectAll('roles', 1);
        $this->assertCount(3, $result);
    }

    public function testFindAllError(): void {
        $this->expectException(DBException::class);
        $this->DBModel->selectAll('role');
    }

    /**
     * @throws DBException
     */
    public function testSelectWhereSuccess(): void {
        $expected = [
            "clientsID" => 1,
            "clientsName" => "Diane-marie",
            "clientsFirstname" => "Dobrovsky",
            "clientsTvaNumber" => "LO52765989554",
            "clientsEmail" => "ddobrovsky0@bravesites.com",
            "clientsActive" => 1,
            "addressID" => 53];
        $result = $this->DBModel->selectWhere('clients', ["clientsTvaNumber" => "LO52765989554"]);
        $this->assertEqualsCanonicalizing($expected, $result[0]);
    }

    public function testSelectWhereEmpty(): void {
        $this->expectException(DBException::class);
        $this->DBModel->selectWhere('clients', []);
    }

    /**
     * @throws DBException
     */
    public function testUpdateSuccess(): void {
        $result = $this->DBModel->update('clients', ["clientsID" => 2, "clientsName" => "Batsheva"]);
        $this->assertTrue($result);
    }

    public function testUpdateError(): void {
        $this->expectException(DBException::class);
        $this->DBModel->update('clients', ["clientsID" => 1112, "clientsName" => 1]);
    }
}