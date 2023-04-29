<?php

namespace daos;
use CashRegister\daos\DAOProduct;
use Dotenv\Dotenv;
use CashRegister\core\database\DBConnection;
use CashRegister\core\exception\DBException;
use CashRegister\daos\DAOStock;
use CashRegister\models\Stock;
use PHPUnit\Framework\TestCase;

class DAOStockTest extends TestCase
{
    private DAOStock $DAOStock;
    private DAOProduct $DAOProduct;
    private $conn;

    public static function setUpBeforeClass(): void {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();
    }

    public function setUp(): void{
        $this->DAOStock = new DAOStock();
        $this->DAOProduct = new DAOProduct();
        $this->conn = DBConnection::getInstance();
    }

    public function tearDown(): void{

    }

    /**
     * @throws DBException
     */
    public function testInsertSuccess(): void{
        $product = $this->DAOProduct->selectOne(2);
        $stock = new Stock(9999999, 22, "2022-10-24 00:00:00", 22.2, true, $product);
        try {
            $return = $this->DAOStock->insert($stock);
        }catch(DBException $e){
            throw new DBException($e);
        }
        $this->assertTrue($return);
    }

    /**
     * @throws DBException
     */
    public function testSelectOneSuccess(): void{

        try {
            $returnStock = $this->DAOStock->selectOne(3);
            $this->assertEquals(96, $returnStock->getQuantity());
        }catch(DBException $e){
            throw new DBException($e);
        }
    }

    public function  testSelectOneFail(): void{
        $this->expectException(DBException::class);

        try {
            $retunedStock = $this->DAOStock->selectOne(99999999999);
        }catch(DBException $e){
            throw new DBException($e);
        }
    }

    /**
     * @throws DBException
     */
    public function testSelectWhereSuccess(): void{


        try {
            $returnedStocks = $this->DAOStock->selectWhere(["stockQuantity"=>22]);
            $this->assertEquals(22,$returnedStocks[0]->getQuantity()) ;

        }catch (DBException $e){
            throw new DBException($e);
        }
    }
    /**
     * @throws DBException
     */
    public function testUpdateSuccess():void{

        try {
            $stock = $this->DAOStock->selectOne(2);
            $initialQuantity = $stock->getQuantity();
            $stock->setQuantity(99);
            $return = $this->DAOStock->update($stock);
            $newStock = $this->DAOStock->selectOne(2);
            $this->assertTrue($return);
            $this->assertEquals(99, $newStock->getQuantity());
        }catch (DBException $e){
            throw new DBException($e);
        }
        //Specific TearDown
        $stock->setQuantity($initialQuantity);
        $this->DAOStock->update($stock);
    }

    /**
     * @throws DBException
     */
    public function testDeleteSuccess(){

        try {
            $stock = $this->DAOStock->selectOne(2);
            $return = $this->DAOStock->delete($stock);
            $this->assertTrue($return);
        }catch (DBException $e){
            throw new DBException($e);
        }
        //Specific TearDown
        $this->DAOStock->update($stock);
    }
}