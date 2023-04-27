<?php

namespace daos;

use CashRegister\core\database\DBConnection;
use CashRegister\core\exception\DBException;
use CashRegister\daos\DAOCategories;
use CashRegister\models\Categories;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

class DAOCategoriesTest extends TestCase
{

    private DAOCategories $DAOCategories;

    /**
     * @return void
     */
    public static function setUpBeforeClass(): void {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();
    }

    /**
     * @return void
     */
    public static function tearDownAfterClass(): void{
        DBConnection::getInstance()->exec();
    }

    /**
     * @return void
     */
    public function setUp(): void{
        $this->DAOCategories = new DAOCategories();
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testInsertSuccess():void{
        $category = new Categories(0,"random","random");
        $result = $this->DAOCategories->insert($category);
        $this->assertTrue($result);
        DBConnection::getInstance()->exec("DELETE FROM categories WHERE categoriesName = 'random' ");
    }

    /**
     * @return void
     */
    public function testInsertFailure():void{
        $this->expectException(DBException::class);
        $category = new Categories(1,"Real Estate Investment Trusts","Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.");
        $this->DAOCategories->insert($category);
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testSelectOneSuccess():void{

        $expected = [
            1,
            "Real Estate Investment Trusts",
            "Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque."
        ];
        $result = $this->DAOCategories->selectOne(1);
        $result = [
            $result->getCategoriesID(),
            $result->getCategoriesName(),
            $result->getCategoriesDescription()
        ];
        $this->assertEqualsCanonicalizing($expected,$result);
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testSelectOneFailure():void{
        $this->expectException(DBException::class);
        $this->DAOCategories->selectOne(100000);
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testSelectWhereSuccess():void{
        $expected = [
            1,
            "Real Estate Investment Trusts",
            "Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.",
            true
        ];
        $result = $this->DAOCategories->selectWhere(["categoriesName" => "Real Estate Investment Trusts"]);
        $result = [
            $result[0]->getCategoriesID(),
            $result[0]->getCategoriesName(),
            $result[0]->getCategoriesDescription(),
            $result[0]->isCategoriesActive()
        ];
        $this->assertEqualsCanonicalizing($expected,$result);
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testSelectWhereEmpty():void{
        $result = $this->DAOCategories->selectWhere(["categoriesName" => "Weapon"]);
        $this->assertEqualsCanonicalizing([],$result);
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testSelectWhereFailure():void{
        $this->expectException(DBException::class);
        $this->DAOCategories->selectWhere(["categoriesNames" => "Weapon"]);
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testUpdateSuccess():void{
        $category = new Categories(1,"Real Estate","");
        $result = $this->DAOCategories->update($category);
        $this->assertTrue($result);
        $category = new Categories(1,"Real Estate Investment Trusts","Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.");
        $this->DAOCategories->update($category);
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testUpdateError():void{
        $this->expectException(DBException::class);
        $category = new Categories(1,"Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.","Real Estate Investment Trusts");
        $this->DAOCategories->update($category);
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testDeleteSuccess():void{
        $category = new Categories(1,"Real Estate Investment Trusts","Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.");
        $result = $this->DAOCategories->delete($category);
        $this->assertTrue($result);
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testDeleteError():void{
        $this->expectException(DBException::class);
        $category = new Categories(1,"Real Estate Investment Trusts","Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.");
        $this->DAOCategories->delete($category);
        $this->DAOCategories->delete($category);
    }

}