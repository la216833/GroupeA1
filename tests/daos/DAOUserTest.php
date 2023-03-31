<?php

namespace daos;

use CashRegister\core\database\DBConnection;
use CashRegister\core\exception\DBException;
use CashRegister\daos\DAORole;
use CashRegister\daos\DAOUser;
use CashRegister\models\Role;
use CashRegister\models\User;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

final class DAOUserTest extends TestCase {
    private DAOUser $DAOUser;

    public static function setUpBeforeClass(): void {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();
    }

    public static function tearDownAfterClass(): void {
        DBConnection::getInstance()->exec("UPDATE users SET usersActive = 1 WHERE usersID = 1");
    }

    public function setUp(): void {
        $this->DAOUser = new DAOUser();
    }

    /**
     * @throws DBException
     */
    public function testInsertSuccess(): void {
        $user = new User(0, "random", "random", "random", "random", true, new Role(1, "administrator", true));
        $result = $this->DAOUser->insert($user);
        $this->assertTrue($result);
        DBConnection::getInstance()->exec("DELETE FROM users WHERE usersFirstname = 'random'");
    }

    public function testInsertError(): void {
        $this->expectException(DBException::class);
        $user = new User(1, "Jodlkowski", "Denver", "39e0274dd5962cf0586fdde1b1108de1c3b3f19c", "default-user-icon.png", true, new Role(1, "administrator", true));
        $this->DAOUser->insert($user);
    }

    /**
     * @throws DBException
     */
    public function testSelectOneSuccess(): void {
        $expected = [
            1,
            "Jodlkowski",
            "Denver",
            "39e0274dd5962cf0586fdde1b1108de1c3b3f19c",
            "default-user-icon.png",
            true,
            1,
        ];
        $result = $this->DAOUser->selectOne(1);
        $result = [
            $result->getId(),
            $result->getName(),
            $result->getFirstname(),
            $result->getAccessCode(),
            $result->getImagePath(),
            $result->getStatus(),
            $result->getRole()->getID(),
        ];
        $this->assertEqualsCanonicalizing($expected, $result);
    }

    public function testSelectOneError(): void {
        $this->expectException(DBException::class);
        $this->DAOUser->selectOne(10000);
    }

    /**
     * @throws DBException
     */
    public function testSelectWhereSuccess(): void {
        $expected = [
            1,
            "Jodlkowski",
            "Denver",
            "39e0274dd5962cf0586fdde1b1108de1c3b3f19c",
            "default-user-icon.png",
            true,
            1,
        ];
        $result = $this->DAOUser->selectWhere(["usersName" => "Jodlkowski"]);
        $result = [
            $result[0]->getId(),
            $result[0]->getName(),
            $result[0]->getFirstname(),
            $result[0]->getAccessCode(),
            $result[0]->getImagePath(),
            $result[0]->getStatus(),
            $result[0]->getRole()->getID(),
        ];
        $this->assertEqualsCanonicalizing($expected, $result);
    }

    /**
     * @throws DBException
     */
    public function testSelectWhereEmpty(): void {
        $result = $this->DAOUser->selectWhere(["usersName" => "admin"]);
        $this->assertEqualsCanonicalizing([], $result);
    }

    public function testSelectWhereError(): void {
        $this->expectException(DBException::class);
        $this->DAOUser->selectWhere(["UsersNames" => "admin"]);
    }

    /**
     * @throws DBException
     */
    public function testUpdateSuccess(): void {
        $user = new User(1, "Denver", "Jodlkowski", "39e0274dd5962cf0586fdde1b1108de1c3b3f19c", "default-user-icon.png", true, new Role(1, "administrator", true));
        $result = $this->DAOUser->update($user);
        $this->assertTrue($result);
        $user = new User(1, "Jodlkowski", "Denver", "39e0274dd5962cf0586fdde1b1108de1c3b3f19c", "default-user-icon.png", true, new Role(1, "administrator", true));
        $this->DAOUser->update($user);
    }

    public function testUpdateError(): void {
        $this->expectException(DBException::class);
        $user = new User(1, "Jodlkowski", "Denver", "39e0274dd5962cf0586fdde1b1108de1c3b3f19c", "default-user-icon.png", true, new Role(1, "administrator", true));
        $this->DAOUser->update($user);
    }

    /**
     * @throws DBException
     */
    public function testDeleteSuccess(): void {
        $user = new User(1, "Jodlkowski", "Denver", "39e0274dd5962cf0586fdde1b1108de1c3b3f19c", "default-user-icon.png", false, new Role(1, "administrator", true));
        $result = $this->DAOUser->delete($user);
        $this->assertTrue($result);
        $user = new User(1, "Jodlkowski", "Denver", "39e0274dd5962cf0586fdde1b1108de1c3b3f19c", "default-user-icon.png", true, new Role(1, "administrator", true));
        $this->DAOUser->update($user);
    }

    public function testDeleteError(): void {
        $this->expectException(DBException::class);
        $user = new User(1, "Jodlkowski", "Denver", "39e0274dd5962cf0586fdde1b1108de1c3b3f19c", "default-user-icon.png", true, new Role(1, "administrator", true));
        $this->DAOUser->delete($user);
        $this->DAOUser->delete($user);
    }
}