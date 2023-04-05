<?php

namespace daos;
use CashRegister\core\database\DBConnection;
use CashRegister\core\exception\DBException;
use CashRegister\daos\DAOProduct;
use CashRegister\models\Product;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

class DAOProductTest extends TestCase
{
    private DAOProduct $DAOProduct;
    private $conn;
    private string $query;



    public static function setUpBeforeClass(): void {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();
    }

    public function setUp(): void{
        $this->DAOProduct = new DAOProduct();
        $this->conn = DBConnection::getInstance();
    }

    public function abortSqlInsert(){
        $id= $this->conn->lastInsertId();
        $query = $this->conn->prepare("DELETE FROM products WHERE productsID=:id LIMIT 1");
        $query->execute(array(':id' => $id));
    }



    /**
     * @throws DBException
     */
    public function testInsertSuccess():void{

        $stockArray = [0,1,2]; //temporaire à remplacer par selectStock

        $product = new Product("produit test", "Cola bien frais", 1.20, 1, "null", $stockArray, 1);//TVA temporaire

        try {
            $return = $this->DAOProduct->insert($product);
        }catch (DBException $e){
            throw new DBException($e);
        }

        $this->assertTrue($return);

        $this->abortSqlInsert();

    }

    /**
     * @throws DBException
     */
    public function testInsertFail():void{
        $this->expectException(DBException::class);

        $stockArray = [0,1,2]; //temporaire à remplacer par selectStock
        $product = new Product("produit test", "Cola bien frais", 1.20, 1, "null", $stockArray, 1);//TVA temporaire

        try {
            $return = $this->DAOProduct->insert($product);
            $return = $this->DAOProduct->insert($product);
        }catch (DBException $e){
            $this->abortSqlInsert();
            throw new DBException($e);
        }

    }

    /**
     * @throws DBException
     */
    public function testSelectOneSuccess(): void{
        try {

            $stockArray = [0,1,2]; //temporaire à remplacer par selectStock

            $product = new Product("produit test", "Cola bien frais", 1.20, 1, "null", $stockArray, 1);//TVA temporaire
            $return = $this->DAOProduct->insert($product);
            $id= $this->conn->lastInsertId();
            $returnedProduct = $this->DAOProduct->selectOne($id);
            $this->assertEquals("produit test", $returnedProduct->getName());
        }catch (DBException $e){
            throw new DBException($e);
        }
        $this->abortSqlInsert();
    }

    /**
     * @throws DBException
     */
    public function  testSelectOneFail(): void{
        $this->expectException(DBException::class);

        try {
            $returnedProduct = $this->DAOProduct->selectOne(99999999999);
        }catch (DBException $e){
            throw new DBException($e);
        }
    }

    /**
     * @throws DBException
     */
    public function testSelectAllSuccess(): void{
        try {
            $tab = $this->DAOProduct->selectAll();
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
     * @throws DBException
     */
    public function testSelectWhereSuccess(): void{
        try {
            $stockArray = [0,1,2]; //temporaire à remplacer par selectStock

            $product = new Product("produit test", "Cola bien frais", 1.20, 1, "null", $stockArray, 1);//TVA temporaire
            $return = $this->DAOProduct->insert($product);

            $id= $this->conn->lastInsertId();
            $tab = $this->DAOProduct->selectWhere(["productsName"=>"produit test"]);
            $this->abortSqlInsert();
            if (!empty($tab)){
                $this->assertIsArray($tab);
            }else{
                $this->fail("Tableau vide");
            }
            $this->assertEquals("produit test",$tab[0]["productsName"]);

        }catch (DBException $e){
            throw new DBException($e);
        }

    }

    /**
     * @throws DBException
     */
    public function testUpdateSuccess():void{
        try {
            $stockArray = [0,1,2]; //temporaire à remplacer par selectStock
            $product = new Product("produit test", "Cola bien frais", 1.20, 1, "null", $stockArray, 1);
            $this->DAOProduct->insert($product);
            $product = new Product("produit test", "Cola plus trop frais", 1.20, 1, "null", $stockArray, 1);
            $product->setId($this->conn->lastInsertId());
            $return = $this->DAOProduct->update($product);
            $this->abortSqlInsert();
            $this->assertTrue($return);
        }catch (DBException $e){
            throw new DBException($e);
        }

    }

    /**
     * @throws DBException
     */
    public function testDeleteProduct(){
        try {
            $stockArray = [0,1,2]; //temporaire à remplacer par selectStock
            $product = new Product("produit test", "Cola bien frais", 1.20, 1, "null", $stockArray, 1);
            $this->DAOProduct->insert($product);
            $id = $this->conn->lastInsertId();
            $product->setId($id);
            $this->DAOProduct->delete($product);


            $productDeleted = $this->DAOProduct->selectOne($id);
            $this->assertEquals(0, $productDeleted->isAvailable());
            $this->abortSqlInsert();

        } catch (DBException $e) {
            throw new DBException($e);
        }


    }










}