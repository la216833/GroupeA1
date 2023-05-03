<?php

namespace daos;

use CashRegister\core\database\DBConnection;
use CashRegister\core\exception\DBException;
use CashRegister\daos\DAOClient;
use CashRegister\daos\DAOSale;
use CashRegister\daos\DAOUser;
use CashRegister\models\Client;
use CashRegister\models\Sale;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

final class DAOSaleTest extends TestCase {
    private DAOSale $DAOSale;
    private DAOUser $DAOUser;
    private DAOClient $DAOClient;

    public static function setUpBeforeClass(): void {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();
    }

    public function setUp(): void {
        $this->DAOSale = new DAOSale();
        $this->DAOUser = new DAOUser();
        $this->DAOClient = new DAOClient();
    }

    /**
     * @throws DBException
     */
    public function testInsertSuccess(): void {
        $sale = new Sale(0, "2022-10-24 00:00:00", 1.11, "test", $this->DAOUser->selectOne(1), $this->DAOClient->selectOne(1));
        $result = $this->DAOSale->insert($sale);
        $this->assertTrue($result);
        DBConnection::getInstance()->exec("DELETE FROM users WHERE usersFirstname = 'random'");
    }

    public function testInsertError(): void {
        $this->expectException(DBException::class);
        $sale = new Sale(0, "2022-10-24 00:00:00", -1.11, "test", $this->DAOUser->selectOne(1),
            $this->DAOClient->selectOne(1));
        $result = $this->DAOSale->insert($sale);
    }

    /**
     * @throws DBException
     */
    public function testSelectOneSuccess(): void {
        $expected = [
            1,
            "2022-05-23 21:32:14",
            35.300,
            "",
            7,
            1,
        ];
        $result = $this->DAOSale->selectOne(1);
        $result = [
            $result->getId(),
            $result->getDate(),
            $result->getAmount(),
            $result->getDescription(),
            $result->getUser()->getId(),
            $result->getClient()->getID()
        ];
        $this->assertEqualsCanonicalizing($expected, $result);
    }

    public function testSelectOneError(): void {
        $this->expectException(DBException::class);
        $this->DAOSale->selectOne(10000);
    }

    /**
     * @throws DBException
     */
    public function testSelectWhereSuccess(): void {
        $expected = [
            1,
            "2022-05-23 21:32:14",
            35.300,
            "",
            7,
            1,
        ];
        $result = $this->DAOSale->selectWhere(["salesDate" => "2022-05-23 21:32:14"])[0];
        $result = [
            $result->getId(),
            $result->getDate(),
            $result->getAmount(),
            $result->getDescription(),
            $result->getUser()->getId(),
            $result->getClient()->getID()
        ];
        $this->assertEqualsCanonicalizing($expected, $result);
    }

    /**
     * @throws DBException
     */
    public function testSelectWhereEmpty(): void {
        $result = $this->DAOSale->selectWhere(["salesID" => 1000000]);
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
        $sale = $this->DAOSale->selectOne(1);
        $sale->setDescription("new description");
        $result = $this->DAOSale->update($sale);
        $this->assertTrue($result);
        $sale->setDescription("");
        $this->DAOSale->update($sale);
    }

    public function testUpdateError(): void {
        $this->expectException(DBException::class);
        $sale = $this->DAOSale->selectOne(1);
        $this->DAOSale->update($sale);
    }

    /**
     * @throws DBException
     */
    public function testDeleteSuccess(): void {
        $sale = $this->DAOSale->selectOne(1);
        $sale->setDescription("delete this");
        $result = $this->DAOSale->delete($sale);
        $this->assertTrue($result);
        $sale->setDescription("");
        $this->DAOSale->update($sale);
    }

    public function testDeleteError(): void {
        $this->expectException(DBException::class);
        $sale = $this->DAOSale->selectOne(1);
        $result = $this->DAOSale->delete($sale);
    }
}