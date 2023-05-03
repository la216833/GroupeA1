<?php

namespace daos;

use CashRegister\core\database\DBConnection;
use CashRegister\core\exception\DBException;
use CashRegister\daos\DAOAddress;
use CashRegister\models\Address;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

class DAOAddressTest extends TestCase
{

    private DAOAddress $DAOAddress;

    public static function setUpBeforeClass(): void {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__,2));
        $dotenv->load();
    }

    public static function tearDownAfterClass(): void {
        DBConnection::getInstance()->exec();
    }

    public function setUp(): void {
        $this->DAOAddress = new DAOAddress();
    }

    public function testInsertSuccess():void{
        $address = new Address(0,"random","90","565546","random");
        $result = $this->DAOAddress->insert($address);
        $this->assertTrue($result);
        DBConnection::getInstance()->exec("DELETE FROM address WHERE addressStreet = 'random'");
    }


    public function testSelectOneSuccess():void{

        $expected = [
            5,
            "Warbler",
            "90",
            "7536",
            "Belgium"
        ];
        $result = $this->DAOAddress->selectOne(5);
        $result = [
          $result->getID(),
          $result->getStreet(),
          $result->getNumber(),
          $result->getCity(),
          $result->getCountry()
        ];
        $this->assertEqualsCanonicalizing($expected,$result);

    }

    public function testSelectOneFailure():void{
        $this->expectException(DBException::class);
        $this->DAOAddress->selectOne(1000000);
    }

    public function testSelectWhereSuccess(): void{
        $expected = [
            5,
            "Warbler",
            "90",
            "7536",
            "Belgium"
        ];
        $result = $this->DAOAddress->selectWhere(["addressStreet" => "Warbler"]);
        $result = [
            $result[0]->getID(),
            $result[0]->getStreet(),
            $result[0]->getNumber(),
            $result[0]->getCity(),
            $result[0]->getCountry()
        ];
        $this->assertEqualsCanonicalizing($expected,$result);
    }

    public function testSelectWhereEmpty():void{
        $result = $this->DAOAddress->selectWhere(["addressStreet" => "Weapon"]);
        $this->assertEqualsCanonicalizing([],$result);
    }

    public function testSelectWhereFailure():void{
        $this->expectException(DBException::class);
        $this->DAOAddress->selectWhere(["addressStreets" => "Weapon"]);
    }

    public function testUpdateSuccess():void{
        $address = new Address(1,"Rockefeller","91","7536","Belgium");
        $result = $this->DAOAddress->update($address);
        $this->assertTrue($result);
        $address = new Address(1,"Rockefeller","90","7536","Belgium");
        $this->DAOAddress->update($address);
    }

}