<?php

namespace daos;
use Dotenv\Dotenv;
use CashRegister\core\database\DBConnection;
use CashRegister\core\exception\DBException;
use CashRegister\daos\DAOStock;
use CashRegister\models\Stock;
use PHPUnit\Framework\TestCase;

class DAOStockTest extends TestCase
{
    private DAOStock $DAOStock;
    private $conn;

    public static function setUpBeforeClass(): void {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();
    }

    public function setUp(): void{
        $this->DAOStock = new DAOStock();
        $this->conn = DBConnection::getInstance();
    }

    public function tearDown(): void{
        $id= $this->conn->lastInsertId();
        $query = $this->conn->prepare("DELETE FROM stock WHERE tvaID=:id LIMIT 1");
        $query->execute(array(':id' => $id));
    }

    /**
     * @throws DBException
     */
    public function testInsertSuccess(): void{
        $stock = new Stock(22, "2022-10-24 00:00:00", 22.3, 1, 23);
        try {
            $return = $this->DAOStock->insert($stock);
        }catch(DBException $e){
            throw new DBException($e);
        }

        $this->assertTrue($return);
    }

    public function testInsertFail():void{
        $this->expectException(DBException::class);
        $stock = new Stock(22, "2022-10-24 00:00:00", 22.3, 1, 23);
        try {
            $this->DAOStock->insert($stock);
            $this->DAOStock->insert($stock);
        }catch (DBException $e){
            throw new DBException($e);
        }
    }

    /**
     * @throws DBException
     */
    public function testSelectOneSuccess(): void{
        $stock = new Stock(22, "2022-10-24 00:00:00", 22.3, 1, 23);
        try {
            $this->DAOStock->insert($stock);
            $id = $this->conn->lastInsertId();
            $returnStock = $this->DAOStock->selectOne($id);
            $this->assertEquals(22, $returnStock->getQuantity());
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
        $stock = new Stock(22, "2022-10-24 00:00:00", 22.3, 1, 23);

        try {
            $this->DAOStock->insert($stock);
            $tab = $this->DAOStock->selectWhere(["stockQuantity"=>22]);
            if (!empty($tab)){
                $this->assertIsArray($tab);
            }else{
                $this->fail("Tableau vide");
            }
            $this->assertEquals(22, $tab[0]["stockQuantity"]);

        }catch (DBException $e){
            throw new DBException($e);
        }
    }
    /**
     * @throws DBException
     */
    public function testUpdateSuccess():void{
        $stock = new Stock(22, "2022-10-24 00:00:00", 22.3, 1, 23);

        try {
            $this->DAOStock->insert($stock);
            $stock->setId($this->conn->lastInsertId());


            $stock->setQuantity(23);
            $return = $this->DAOStock->update($stock);
            $this->assertTrue($return);
        }catch (DBException $e){
            throw new DBException($e);
        }
    }

    /**
     * @throws DBException
     */
    public function testDeleteSuccess(){
        $stock = new Stock(22, "2022-10-24 00:00:00", 22.3, 1, 23);

        try {
            $this->DAOStock->insert($stock);
            $stock->setId($this->conn->lastInsertId());
            $stock->setActive(0);
            $return = $this->DAOStock->update($stock);
            $this->assertTrue($return);
        }catch (DBException $e){
            throw new DBException($e);
        }
    }
}