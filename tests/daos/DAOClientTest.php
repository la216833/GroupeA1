<?php
/**
 *   Made by D.Logan (la216833)
 *   Started 06/04/2023
 *   Last Modified 19/04/2023
 */
namespace daos;

use CashRegister\core\database\DBConnection;
use CashRegister\core\exception\DBException;
use CashRegister\daos\DAOClient;
use CashRegister\models\Address;
use CashRegister\models\Client;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

final class DAOClientTest extends TestCase
{

    private DAOClient $DAOClient;

    public static function setUpBeforeClass(): void{
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();
    }

    public function setUp(): void{
        $this->DAOClient = new DAOClient();
        $this->conn = DBConnection::getInstance();
    }


    public function tearDown(): void{
        $id = $this->conn->lastInsertId();
        $query = $this->conn->prepare("DELETE FROM clients WHERE clientsID =:id LIMIT 1");
        $query->execute(array(':id' => $id));
    }


    /**
     * @return void
     * @throws DBException
     */
    public function testInsertSuccess():void{
        $address = new Address(1,"Rockefeller","7536","90","Belgium");
        $client = new Client(0,"random","random","random","random",true,$address);

        try {
            $result = $this->DAOClient->insert($client);
        }catch(DBException $e){
            throw new DBException($e);
        }
        $this->assertTrue($result);
    }

    /**
     * @return void
     */
    public function testInsertFailure():void{
        $this->expectException(DBException::class);
        $address = new Address(1,"Rockefeller","7536","90","Belgium");
        $client = new Client(0,"random","random","random","random",true,$address);
        try {
            $this->DAOClient->insert($client);
            $this->DAOClient->insert($client);
        }catch (DBException $e){
            throw new DBException($e);
        }
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testSelectOneSuccess():void{

        try {

            $address = new Address(1,"Rockefeller","7536","90","Belgium");
            $client = new Client(0,"random","random","random","random",true,$address);
            $this->DAOClient->insert($client);
            $id = $this->conn->lastInsertId();
            $returnedClient = $this->DAOClient->selectOne($id);
            $this->assertEquals("random", $returnedClient->getName());

        }catch (DBException $e){
            throw new DBException($e);
        }

    }

    /**
     * @return void
     * @throws DBException
     */
    public function testSelectOneFailure():void{
        $this->expectException(DBException::class);
        $this->DAOClient->selectOne(100000);
    }

    public function testSelectAllSuccess(): void{
        try {
            $tab = $this->DAOClient->selectAll();
            if (!empty($tab)){
                $this->assertIsArray($tab);
            }else{
                $this->fail("Tableau vide");
            }

        } catch (DBException $e) {
            throw new DBException($e);
        }
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testSelectWhereSuccess():void{
        $address = new Address(1,"Rockefeller","7536","90","Belgium");
        $client = new Client(0,"random","random","random","random",true,$address);
        try {
            $this->DAOClient->insert($client);
            $id = $this->DAOClient->selectWhere(["clientsName"=>"random"])[0]->getID(); //Selectionne l'id du client qui porte le nom "random"
            $returnedTab = $this->DAOClient->selectWhere(["clientsName"=>"random"])[0];
        }catch (DBException $e){
            throw new DBException($e);
        }

        $expectedTab = [$id, "random","random","random","random",true,1];
        $returnedTab = [$returnedTab->getID(),$returnedTab->getName(), $returnedTab->getFirstname(), $returnedTab->getTVANumber(), $returnedTab->getMail(), $returnedTab->getActive(), $returnedTab->getAddress()->getID()];

        $this->assertEqualsCanonicalizing($expectedTab, $returnedTab);
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testSelectWhereEmpty():void{
        $result = $this->DAOClient->selectWhere(["clientsName" => "Weapon"]);
        $this->assertEqualsCanonicalizing([],$result);
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testSelectWhereFailure():void{
        $this->expectException(DBException::class);
        $this->DAOClient->selectWhere(["clientsNames" => "Weapon"]);
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testUpdateSuccess():void{
        try {
            $address = new Address(1,"Rockefeller","7536","90","Belgium");
            $client = new Client(0,"random","random","random","random",true,$address);
            $this->DAOClient->insert($client);
            $client = $this->DAOClient->selectWhere(['clientsName' => "random"])[0];

            $client->setName("Client test");

            $return = $this->DAOClient->update($client);
            $this->assertTrue($return);
        }catch (DBException $e){
            throw new DBException($e);
        }

    }

    /**
     * @return void
     * @throws DBException
     */
    public function testUpdateError():void{
        $this->expectException(DBException::class);
        $address = new Address(1,"Rockefeller","7536","90","Belgium");
        $client = new Client(0,"random","random","random","random",true,$address);
        $this->DAOClient->update($client);
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testDeleteSuccess(){
        try {
            $address = new Address(1,"Rockefeller","7536","90","Belgium");
            $client = new Client(0,"random","random","random","random",true,$address);
            $this->DAOClient->insert($client);
            $client = $this->DAOClient->selectWhere(['clientsName' => "random"])[0];
            $return = $this->DAOClient->delete($client);

            $this->assertTrue($return);

        } catch (DBException $e) {
            throw new DBException($e);
        }
    }

    /**
     * @return void
     * @throws DBException
     */
    public function testDeleteError():void{
        $this->expectException(DBException::class);
        $address = new Address(1,"Rockefeller","7536","90","Belgium");
        $client = new Client(0,"random","random","random","random",true,$address);
        $this->DAOClient->delete($client);
    }

}