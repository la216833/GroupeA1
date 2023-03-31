<?php

namespace daos;

use CashRegister\core\database\DBConnection;
use CashRegister\core\exception\DBException;
use CashRegister\daos\DAORole;
use CashRegister\models\Role;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

final class DAORoleTest extends TestCase {

    private DAORole $DAORole;

    public static function setUpBeforeClass(): void {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();
    }

    /**
     * @throws DBException
     */
    public static function tearDownAfterClass(): void {
        $DAORole = new DAORole();
        $role = new Role(1, "administrator", true);
        $DAORole->update($role);
    }

    public function setUp(): void {
        $this->DAORole = new DAORole();
    }

    /**
     * @throws DBException
     */
    public function testInsertSuccess(): void {
        $role = new Role(0, "admin", true);
        $result = $this->DAORole->insert($role);
        $this->assertTrue($result);
        DBConnection::getInstance()->exec("DELETE FROM roles WHERE rolesName = 'admin'");
    }

    public function testInsertError(): void {
        $this->expectException(DBException::class);
        $role = new Role(0, "administrator", true);
        $this->DAORole->insert($role);
    }

    /**
     * @throws DBException
     */
    public function testSelectOneSuccess(): void {
        $expected = [
            1,
            "administrator",
            true
        ];
        $result = $this->DAORole->selectOne(1);
        $result = [
            $result->getID(),
            $result->getName(),
            $result->getActive()
        ];
        $this->assertEqualsCanonicalizing($expected, $result);
    }

    public function testSelectOneError(): void {
        $this->expectException(DBException::class);
        $this->DAORole->selectOne(10000);
    }

    /**
     * @throws DBException
     */
    public function testSelectWhereSuccess(): void {
        $expected = [
            1,
            "administrator",
            true
        ];
        $result = $this->DAORole->selectWhere(["rolesName" => "administrator"]);
        $result = [
            $result[0]->getID(),
            $result[0]->getName(),
            $result[0]->getActive()
        ];
        $this->assertEqualsCanonicalizing($expected, $result);
    }

    /**
     * @throws DBException
     */
    public function testSelectWhereEmpty(): void {
        $result = $this->DAORole->selectWhere(["rolesName" => "admin"]);
        $this->assertEqualsCanonicalizing([], $result);
    }

    public function testSelectWhereError(): void {
        $this->expectException(DBException::class);
        $this->DAORole->selectWhere(["rolesNames" => "admin"]);
    }

    /**
     * @throws DBException
     */
    public function testUpdateSuccess(): void {
        $role = new Role(1, "admin", true);
        $result = $this->DAORole->update($role);
        $this->assertTrue($result);
        $role = new Role(1, "administrator", true);
        $this->DAORole->update($role);
    }

    public function testUpdateError(): void {
        $this->expectException(DBException::class);
        $role = new Role(1, "administrator", true);
        $this->DAORole->update($role);
    }

    /**
     * @throws DBException
     */
    public function testDeleteSuccess(): void {
        $role = new Role(1, "administrator", true);
        $result = $this->DAORole->delete($role);
        $this->assertTrue($result);
        $role = new Role(1, "administrator", true);
        $this->DAORole->update($role);
    }

    public function testDeleteError(): void {
        $this->expectException(DBException::class);
        $role = new Role(1, "administrator", true);
        $this->DAORole->delete($role);
        $this->DAORole->delete($role);
    }
}