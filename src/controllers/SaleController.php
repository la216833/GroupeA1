<?php

namespace CashRegister\controllers;

use CashRegister\core\database\DBConnection;
use CashRegister\core\exception\DBException;
use CashRegister\core\Session;
use CashRegister\core\View;
use CashRegister\daos\DAOCategory;
use CashRegister\daos\DAOClient;
use CashRegister\daos\DAOProduct;
use CashRegister\daos\DAOSale;
use CashRegister\daos\DAOSaleContent;
use CashRegister\daos\DAOStock;
use CashRegister\daos\DAOUser;
use CashRegister\models\Sale;
use CashRegister\models\SaleContent;
use CashRegister\models\Client;
use CashRegister\models\User;

class SaleController implements Controller {

    private View $view;
    private DAOCategory $DAOCategory;
    private DAOProduct $DAOProduct;
    private DAOStock $DAOStock;
    private DAOSale $DAOSale;
    private DAOSaleContent $DAOSaleContent;
    private DAOUser $DAOUser;
    private DAOClient $DAOClient;

    public function __construct() {
        $this->view = new View();
        $this->DAOCategory = new DAOCategory();
        $this->DAOProduct = new DAOProduct();
        $this->DAOStock = new DAOStock();
        $this->DAOSale = new DAOSale();
        $this->DAOSaleContent = new DAOSaleContent();
        $this->DAOUser = new DAOUser();
        $this->DAOClient = new DAOClient();
    }

    public function get(): void {
        global $session;
        if (!$session->get('USER')) {
            header('Location: /login');
            exit();
        }
        $params = [];
        try {
            $params['categories'] = $this->DAOCategory->selectWhere(["categoriesActive" => true]);
            $params['products'] = [];
            foreach ($params['categories'] as $cat) {
                $params['products'] = array_merge($params['products'], $this->DAOProduct->selectWhere(["categoriesID"
                => $cat->getID()]));
            }
            $current = DBConnection::getInstance()->query("SELECT salesID FROM sales ORDER BY salesID DESC LIMIT 1")
            ->fetchAll();
            $params['number'] = isset($current[0][0]) ? $current[0][0] + 1 : 1;
        } catch (DBException) {

            $session->setFlash('error', "Une erreur de connexion à la base de donnée est survenue");
        }
        echo $this->view->render('sale.php', $params);
    }

    public function get_one(int $id): void {
        // TODO: Implement get_id() method.
    }

    public function add(): void {
        // TODO: Implement add() method.
    }

    public function post_one(int $id): void {
        // TODO: Implement post_one() method.
    }

    public function post(): void {
        global $session;
        if (!$session->get('USER')) {
            header('Location: /login');
            exit();
        }
        if (!empty($_POST)) {
            $products = $_POST;
            $available = true;
            foreach ($products as $name => $id) {
                if (!str_contains($name, 'QNT')) {
                    try {
                        $product = $this->DAOProduct->selectOne($id);
                        $stocks = $this->DAOStock->selectWhere(['productsID' => $product->getID()]);
                        $quantity = 0;
                        foreach ($stocks as $stock)
                            $quantity += $stock->getQuantity();


                        if ($quantity < (int) $products[$name.'_QNT']) {
                            $available = false;
                            break;
                        }
                    } catch (DBException) {
                        $session['FLASH_KEY']['error'] = "Une erreur de connexion à la base de donnée est survenue";
                    }
                }
            }

            if ($available) {
                $price = 0;
                try {
                    $user = $this->DAOUser->selectOne(1);
                    $client = $this->DAOClient->selectOne(1);
                    $date = date("Y-m-d H-m-s");
                    $sale = new Sale(0, $date, 0, '', $user, $client);
                    $this->DAOSale->insert($sale);
                    $sale = $this->DAOSale->selectWhere(['salesDate' => $date])[0];
                    foreach ($products as $name => $id) {
                        if (str_contains($name, 'QNT')) continue;
                        $quantity = (int) $products[$name.'_QNT'];
                        $product = $this->DAOProduct->selectOne($id);
                        $stocks = $this->DAOStock->selectWhere(['productsID' => $product->getID()]);
                        $stock = $stocks[0];
                        $stock->setQuantity($stock->getQuantity() - $quantity);
                        $this->DAOStock->update($stock);

                        $saleContent = new SaleContent($product, $sale, $quantity);
                        $this->DAOSaleContent->insert($saleContent);
                        $price += $quantity * $product->getPrice();
                    }
                    $sale->setAmount($price);
                    $this->DAOSale->update($sale);
                } catch (DBException) {
                    $session['FLASH_KEY']['error'] = "Une erreur de connexion à la base de donnée est survenue";
                }
            }
        }
    }

    public function update(int $id): void {
        // TODO: Implement update() method.
    }

    public function delete(int $id): void {
        // TODO: Implement delete() method.
    }
}
