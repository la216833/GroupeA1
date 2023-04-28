<?php

namespace daos;
use CashRegister\core\database\DBConnection;
use CashRegister\core\exception\DBException;
use CashRegister\daos\DAOProduct;
use CashRegister\models\Category;
use CashRegister\models\Product;
use CashRegister\models\TVA;
use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

class DAOProductTest extends TestCase
{
    private DAOProduct $DAOProduct;



    public static function setUpBeforeClass(): void {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();
    }

    public function setUp(): void{
        $this->DAOProduct = new DAOProduct();
        $this->conn = DBConnection::getInstance();
    }

    public function tearDown(): void{
        $id= $this->conn->lastInsertId();
        $query = $this->conn->prepare("DELETE FROM products WHERE productsID=:id LIMIT 1");
        $query->execute(array(':id' => $id));
    }



    /**
     * @throws DBException
     */
    public function testInsertSuccess():void{
        $product = new Product(0,"produit test", "Cola bien frais", 1.20, 1, "null", new TVA(3, 21, "Taxe 21"), new Category(2,"Real Estate Investment Trusts", "Des", 1));

        try {
            $return = $this->DAOProduct->insert($product);
        }catch (DBException $e){
            throw new DBException($e);
        }
        $this->assertTrue($return);

    }

    /**
     * @throws DBException
     */
    public function testInsertFail():void{
        $this->expectException(DBException::class);

        $product = new Product(0,"produit test", "Cola bien frais", 1.20, 1, "null", new TVA(3, 21, "Taxe 21"), new Category(2,"Real Estate Investment Trusts", "Des", 1));

        try {
            $this->DAOProduct->insert($product);
            $this->DAOProduct->insert($product);
        }catch (DBException $e){
            throw new DBException($e);
        }

    }

    /**
     * @throws DBException
     */
    public function testSelectOneSuccess(): void{
        try {

            $product = new Product(0,"produit test", "Cola bien frais", 1.20, 1, "null", new TVA(3, 21, "Taxe 21"), new Category(2,"Real Estate Investment Trusts", "Des", 1));
            $this->DAOProduct->insert($product);
            $id= $this->conn->lastInsertId();
            $returnedProduct = $this->DAOProduct->selectOne($id);
            $this->assertEquals("produit test", $returnedProduct->getName());
        }catch (DBException $e){
            throw new DBException($e);
        }
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
        $product = new Product(0,"produit test", "Cola bien frais", 1.20, true, "random", new TVA(3, 21, "Taxe 21"), new Category(2,"Real Estate Investment Trusts", "Des", 1));

        try {
            $this->DAOProduct->insert($product);
            $id = $this->DAOProduct->selectWhere(["productsName"=>"produit test"])[0]->getID(); //Selectionne l'id du produit qui porte le nom "produit test"
            $returnedTab = $this->DAOProduct->selectWhere(["productsName"=>"produit test"])[0];
        }catch (DBException $e){
            throw new DBException($e);
        }

        $expectedTab = [$id, "produit test", "Cola bien frais", 1.20, true, "random", 3, 2];
        $returnedTab = [$returnedTab->getID(),$returnedTab->getName(), $returnedTab->getDescription(), $returnedTab->getPrice(), $returnedTab->getActive(), $returnedTab->getImagePath(), $returnedTab->getTva()->getID(), $returnedTab->getCategory()->getID()];

        $this->assertEqualsCanonicalizing($expectedTab, $returnedTab);


    }

    /**
     * @throws DBException
     */
    public function testUpdateSuccess():void{
        try {
            $product = new Product(0,"produit test", "Cola bien frais", 1.20, 1, "null", new TVA(3, 21, "Taxe 21"), new Category(2,"Real Estate Investment Trusts", "Des", 1));
            $this->DAOProduct->insert($product);
            $product = $this->DAOProduct->selectWhere(['productsName' => "produit test"])[0];

            $product->setDescription("Coca moins frais");

            $return = $this->DAOProduct->update($product);
            $this->assertTrue($return);
        }catch (DBException $e){
            throw new DBException($e);
        }

    }

    /**
     * @throws DBException
     */
    public function testDeleteSuccess(){
        try {
            $product = new Product(0,"produit test", "Cola bien frais", 1.20, 1, "null", new TVA(3, 21, "Taxe 21"), new Category(2,"Real Estate Investment Trusts", "Des", 1));
            $this->DAOProduct->insert($product);
            $product = $this->DAOProduct->selectWhere(['productsName' => "produit test"])[0];
            $return = $this->DAOProduct->delete($product);

            $this->assertTrue($return);

        } catch (DBException $e) {
            throw new DBException($e);
        }


    }
}