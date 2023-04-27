<?php

namespace daos;

use CashRegister\core\database\DBConnection;
use CashRegister\core\exception\DBException;
use CashRegister\daos\DAOCategory;
use CashRegister\models\Category;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

class DAOCategoryTest extends TestCase
{

    private DAOCategory $DAOCategory;

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
        $this->DAOCategory = new DAOCategory();
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testInsertSuccess():void{
        $category = new Category(0,"random","random");
        $result = $this->DAOCategory->insert($category);
        $this->assertTrue($result);
        DBConnection::getInstance()->exec("DELETE FROM categories WHERE categoriesName = 'random' ");
    }

    /**
     * @return void
     */
    public function testInsertFailure():void{
        $this->expectException(DBException::class);
        $category = new Category(1,"Real Estate Investment Trusts","Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.");
        $this->DAOCategory->insert($category);
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
        $result = $this->DAOCategory->selectOne(1);
        $result = [
            $result->getCategoryID(),
            $result->getCategoryName(),
            $result->getCategoryDescription()
        ];
        $this->assertEqualsCanonicalizing($expected,$result);
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testSelectOneFailure():void{
        $this->expectException(DBException::class);
        $this->DAOCategory->selectOne(100000);
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
        $result = $this->DAOCategory->selectWhere(["categoriesName" => "Real Estate Investment Trusts"]);
        $result = [
            $result[0]->getCategoryID(),
            $result[0]->getCategoryName(),
            $result[0]->getCategoryDescription(),
            $result[0]->isCategoryActive()
        ];
        $this->assertEqualsCanonicalizing($expected,$result);
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testSelectWhereEmpty():void{
        $result = $this->DAOCategory->selectWhere(["categoriesName" => "Weapon"]);
        $this->assertEqualsCanonicalizing([],$result);
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testSelectWhereFailure():void{
        $this->expectException(DBException::class);
        $this->DAOCategory->selectWhere(["categoriesNames" => "Weapon"]);
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testUpdateSuccess():void{
        $category = new Category(1,"Real Estate","");
        $result = $this->DAOCategory->update($category);
        $this->assertTrue($result);
        $category = new Category(1,"Real Estate Investment Trusts","Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.");
        $this->DAOCategory->update($category);
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testUpdateError():void{
        $this->expectException(DBException::class);
        $category = new Category(1,"Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.","Real Estate Investment Trusts");
        $this->DAOCategory->update($category);
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testDeleteSuccess():void{
        $category = new Category(1,"Real Estate Investment Trusts","Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.");
        $result = $this->DAOCategory->delete($category);
        $this->assertTrue($result);
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testDeleteError():void{
        $this->expectException(DBException::class);
        $category = new Category(1,"Real Estate Investment Trusts","Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.");
        $this->DAOCategory->delete($category);
        $this->DAOCategory->delete($category);
    }

}