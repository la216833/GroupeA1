<?php

namespace daos;

use CashRegister\core\database\DBConnection;
use CashRegister\core\exception\DBException;
use CashRegister\daos\DAOTva;
use CashRegister\models\TVA;
use Dotenv\Dotenv;
use PDO;
use PHPUnit\Framework\TestCase;

class DAOTvaTest extends TestCase
{
    private DAOTva $DAOTva;


    public static function setUpBeforeClass(): void {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();
    }

    public function setUp(): void{
        $this->DAOTva = new DAOTva();
        $this->conn = DBConnection::getInstance();
    }

    public function tearDown(): void{
        $id= $this->conn->lastInsertId();
        $query = $this->conn->prepare("DELETE FROM tva WHERE tvaID=:id LIMIT 1");
        $query->execute(array(':id' => $id));
    }

    /**
     * @throws DBException
     */
    public function testInsertSuccess():void{
        $tva = new TVA(0,22, "Taxe 22");

        try {
            $return = $this->DAOTva->insert($tva);
        }catch(DBException $e){
            throw new DBException($e);
        }

        $this->assertTrue($return);
    }

    public function testInsertFail():void{
        $this->expectException(DBException::class);
        $tva = new TVA(0,22, "Taxe 22");

        try {
            $return = $this->DAOTva->insert($tva);
            $return = $this->DAOTva->insert($tva);
        }catch (DBException $e){
            throw new DBException($e);
        }
    }

    /**
     * @throws DBException
     */
    public function testSelectOneSuccess(): void{
        $tva = new TVA(0,22, "Taxe 22");
        try {
            $this->DAOTva->insert($tva);
            $id = $this->conn->lastInsertId();
            $returnTva = $this->DAOTva->selectOne($id);
            $this->assertEquals(22, $returnTva->getPercent());
        }catch(DBException $e){
            throw new DBException($e);
        }
    }

    public function  testSelectOneFail(): void{
        $this->expectException(DBException::class);

        try {
            $retunedTva = $this->DAOTva->selectOne(99999999999);
        }catch(DBException $e){
            throw new DBException($e);
        }
    }

    /**
     * @throws DBException
     */
    public function testSelectWhereSuccess(): void{
        $tva = new TVA(0,22, "Taxe 22");

        try {
            //$this->DAOTva->insert($tva);

            $tab = $this->DAOTva->selectWhere(["tvaName"=>"Taxe 22"]);
            if (!empty($tab)){
                $this->assertIsArray($tab);
            }else{
                $this->fail("Tableau vide");
            }
            $this->assertEquals("Taxe 22", $tab[0]->getName());

        }catch (DBException $e){
            throw new DBException($e);
        }
    }

    /**
     * @throws DBException
     */
    public function testUpdateSuccess():void{
        $tva = new TVA(0,22, "Taxe 22");

        try {
            $this->DAOTva->insert($tva);
            $tva->setId($this->conn->lastInsertId());


            $tva->setName("Taxe speciale 22");
            $return = $this->DAOTva->update($tva);
            $this->assertTrue($return);
        }catch (DBException $e){
            throw new DBException($e);
        }
    }

    /**
     * @throws DBException
     */
    public function testDeleteSuccess(){
        $tva = new TVA(0,22, "Taxe 22");
        try {
            $this->DAOTva->insert($tva);
            $tva->setId($this->conn->lastInsertId());


            $r= $this->DAOTva->delete($tva);
            $this->assertTrue($r);
        }catch (DBException $e) {
            throw new DBException($e);
        }

    }

}