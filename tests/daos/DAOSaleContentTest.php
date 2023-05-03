<?php

namespace daos;

use CashRegister\core\database\DBConnection;
use CashRegister\core\database\DBModel;
use CashRegister\core\exception\DBException;
use CashRegister\daos\DAOProduct;
use CashRegister\daos\DAOSale;
use CashRegister\daos\DAOSaleContent;
use CashRegister\daos\DAOUser;
use CashRegister\models\Role;
use CashRegister\models\SaleContent;
use CashRegister\models\User;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

final class DAOSaleContentTest extends TestCase {
    private DAOSaleContent $DAOSaleContent;
    private DAOProduct $DAOProduct;
    private DAOSale $DAOSale;

    public static function setUpBeforeClass(): void {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();
    }

    public function setUp(): void {
        $this->DAOSaleContent = new DAOSaleContent();
        $this->DAOSale = new DAOSale();
        $this->DAOProduct = new DAOProduct();
    }

    /**
     * @throws DBException
     */
    public function testInsertSuccess(): void {
        $content = new SaleContent($this->DAOProduct->selectOne(2), $this->DAOSale->selectOne(1), 10);
        $result = $this->DAOSaleContent->insert($content);
        $this->assertTrue($result);
    }

    public function testInsertError(): void {
        $this->expectException(DBException::class);
        $content = new SaleContent($this->DAOProduct->selectOne(1), $this->DAOSale->selectOne(1), -10);
        $result = $this->DAOSaleContent->insert($content);
    }

    /**
     * @throws DBException
     */
    public function testSelectOneSuccess(): void {
        $result = $this->DAOSaleContent->selectOne(3);
        $this->assertEquals(2, sizeof($result));
    }

    public function testSelectOneError(): void {
        $result = $this->DAOSaleContent->selectOne(122);
        $this->assertEquals(0, sizeof($result));

    }

    /**
     * @throws DBException
     */
    public function testSelectWhereSuccess(): void {
        $expected = [
            3,
            9,
            1
        ];
        $result = $this->DAOSaleContent->selectWhere(["salesID" => 3]);
        $result = [
            $result[0]->getProduct()->getID(),
            $result[0]->getSale()->getID(),
            $result[0]->getQuantity(),
        ];
        $this->assertEqualsCanonicalizing($expected, $result);
    }

    /**
     * @throws DBException
     */
    public function testSelectWhereEmpty(): void {
        $result = $this->DAOSale->selectWhere(["salesID" => 10000]);
        $this->assertEqualsCanonicalizing([], $result);
    }

    public function testSelectWhereError(): void {
        $this->expectException(DBException::class);
        $this->DAOSaleContent->selectWhere(["UsersNames" => "admin"]);
    }

    /**
     * @throws DBException
     */
    public function testUpdateSuccess(): void {
        $content = $this->DAOSaleContent->selectOne(4);
        $content[0]->setQuantity(10);
        $result = $this->DAOSaleContent->update($content[0]);
        $this->assertTrue($result);
        $content[0]->setQuantity(1);
        $this->DAOSaleContent->update($content[0]);
    }

    public function testUpdateError(): void {
        $this->expectException(DBException::class);
        $content = $this->DAOSaleContent->selectOne(4);
        $this->DAOSaleContent->update($content[0]);
    }

    /**
     * @throws DBException
     */
    public function testDeleteSuccess(): void {
        $content = $this->DAOSaleContent->selectOne(4);
        $content[0]->setQuantity(10);
        $result = $this->DAOSaleContent->update($content[0]);
        $this->assertTrue($result);
        $content[0]->setQuantity(1);
        $this->DAOSaleContent->update($content[0]);
    }

    public function testDeleteError(): void {
        $this->expectException(DBException::class);
        $content = $this->DAOSaleContent->selectOne(4);
        $this->DAOSaleContent->update($content[0]);
    }
}