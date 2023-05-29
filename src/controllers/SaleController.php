<?php

namespace CashRegister\controllers;

use CashRegister\core\database\DBConnection;
use CashRegister\core\exception\DBException;
use CashRegister\core\View;
use CashRegister\daos\DAOAddress;
use CashRegister\daos\DAOCategory;
use CashRegister\daos\DAOClient;
use CashRegister\daos\DAOProduct;
use CashRegister\daos\DAOSale;
use CashRegister\daos\DAOSaleContent;
use CashRegister\daos\DAOStock;
use CashRegister\daos\DAOUser;
use CashRegister\models\Address;
use CashRegister\models\Client;
use CashRegister\models\Sale;
use CashRegister\models\SaleContent;

class SaleController implements Controller {

    private View $view;
    private DAOCategory $DAOCategory;
    private DAOProduct $DAOProduct;
    private DAOStock $DAOStock;
    private DAOSale $DAOSale;
    private DAOSaleContent $DAOSaleContent;
    private DAOUser $DAOUser;
    private DAOClient $DAOClient;
    private DAOAddress $DAOAddress;

    public function __construct() {
        $this->view = new View();
        $this->DAOCategory = new DAOCategory();
        $this->DAOProduct = new DAOProduct();
        $this->DAOStock = new DAOStock();
        $this->DAOSale = new DAOSale();
        $this->DAOSaleContent = new DAOSaleContent();
        $this->DAOUser = new DAOUser();
        $this->DAOClient = new DAOClient();
        $this->DAOAddress = new DAOAddress();
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
                => $cat->getID(), "productsActive" => 1]));
            }
            $current = DBConnection::getInstance()->query("SELECT salesID FROM sales ORDER BY salesID DESC LIMIT 1")
            ->fetchAll();
            $params['number'] = isset($current[0][0]) ? $current[0][0] + 1 : 1;
            $params['saved'] = [];
            foreach ($_COOKIE as $name => $value) {
                if (str_contains($name, 'SALE')) {
                    $value = json_decode($value);
                    $params['saved'] = array_merge($params['saved'], [$name => $value->total]);
                }
            }
            $params['clients'] = $this->DAOClient->selectAll();
        } catch (DBException) {
            $session->setFlash('error', "Une erreur de connexion à la base de donnée est survenue");
        }
        echo $this->view->render('sale.php', $params);
    }

    public function get_one(int $id): void {
        global $session;
        $data = $_POST['value'];
        setcookie('SALE_'.$id, $data, time() + (60 * 60 * 24), "/");
        header('Location: /');
    }

    public function add(): void {
        global $session;
        if (!$session->get('USER')) {
            header('Location: /login');
            exit();
        }

        $products = json_decode($_POST['save'])->products;
        try {
            $user = $this->DAOUser->selectOne((int) $session->get('USER'));
            $date = date("Y-m-d H-m-s");
            $client = $this->DAOClient->selectOne(1);
            $sale = new Sale(0, $date, 0, '', $user, $client);
            $this->DAOSale->insert($sale);
            $sale = $this->DAOSale->selectWhere(['salesDate' => $date])[0];
            $price = 0;
            foreach ($products as $p) {
                $quantity = $p->quantity;
                $product = $this->DAOProduct->selectOne($p->id);
                $stocks = $this->DAOStock->selectWhere(['productsID' => $product->getID()]);
                $stock = $stocks[0];
                $stock->setQuantity($stock->getQuantity() - $quantity);
                $this->DAOStock->update($stock);

                $saleContent = new SaleContent($product, $sale, $quantity);
                $this->DAOSaleContent->insert($saleContent);
                $price += $quantity * $product->getPrice();
            }
            $sale->setDescription("La somme est de [$price]");
            $this->DAOSale->update($sale);
        } catch (DBException) {
            $session->setFlash('error', 'Une erreur est survenue');
        } finally {
            header('Location: /');
        }

    }

    public function post_one(int $id): void {
        global $session;
        $name = $_POST['save'];
        $session->set('save', json_decode($_COOKIE[$name]));
        unset($_COOKIE[$name]);
        setcookie($name, null, -1, "/");
        header('Location: /');
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
                        $session->setFlash('error', "Une erreur de connexion à la base de donnée est survenue");
                    }
                }
            }

            if ($available) {
                $price = 0;
                try {
                    $user = $this->DAOUser->selectOne((int) $session->get('USER'));
                    $date = date("Y-m-d H-m-s");
                    $client = $this->DAOClient->selectOne(1);
                    $sale = new Sale(0, $date, 0, '', $user, $client);
                    $this->DAOSale->insert($sale);
                    $sale = $this->DAOSale->selectWhere(['salesDate' => $date])[0];
                    $ticket = [];
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

                        $ticket[] = [
                            "name" => $product->getName(),
                            "quantity" => $quantity,
                            "price" => $product->getPrice()
                        ];
                    }
                    $ticket[] = [
                        "total" => $price,
                        "number" => $sale->getID(),
                        "date" => date("H:m:s d-m-Y", strtotime($sale->getDate())),
                        "served" => $user->getName()
                    ];
                    $sale->setAmount($price);
                    $this->DAOSale->update($sale);
                    $session->set('amount', $price);
                    $session->set('products', $ticket);
                    $session->set('sale_id', $sale->getID());
                } catch (DBException) {
                    $session->setFlash('error', "Une erreur de connexion à la base de donnée est survenue");
                } finally {
                    header('Location: /');
                }
            }
        } else {
            header('Location: /');
        }
    }

    public function update(int $id): void {
        global $session;
        $session->setFlash('error', '');
        $session->setFlash('success', '');
        if ($session->get('ROLE') !== 'administrator' && $session->get('ROLE') !== 'manager') {
            header('Location: /');
            exit();
        }
        $saleID = (int) $_POST['value'];
        $products = $_POST['save'];
        if (!empty($products)) {
            try {
                $user = $this->DAOUser->selectOne((int) $session->get('USER'));
                $date = date("Y-m-d H-m-s");
                $client = $this->DAOClient->selectOne(1);
                $sale = new Sale(0, $date, 0, 'Retour de la vente '.$saleID, $user, $client);
                $this->DAOSale->insert($sale);
                $sale = $this->DAOSale->selectWhere(['salesDate' => $date])[0];
                $products = json_decode($products)->products;
                $total = 0;
                foreach ($products as $product) {
                    $p = $this->DAOProduct->selectOne($product->id);
                    $stocks = $this->DAOStock->selectWhere(['productsID' => $p->getID()]);
                    foreach ($stocks as $stock) {
                        if ($stock->getQuantity() >=0) {
                            $stock->setQuantity($stock->getQuantity() + $product->quantity);
                            $this->DAOStock->update($stock);
                            break;
                        }
                    }
                    $saleContent = new SaleContent($p, $sale, $product->quantity);
                    $this->DAOSaleContent->insert($saleContent);
                    $total += $product->price;
                }
                $sale->setAmount(0 - $total);
                $this->DAOSale->update($sale);
            } catch (DBException) {
                $session->setFlash('error', "Une erreur de connexion à la base de donnée est survenue");
            }
        } else {
            $session->setFlash('error', "Sélectionner les produits à retourner");
        }

        header('Location: /');
    }

    public function update_one(): void {
        global $session;
        $data = $_POST;
        $lastname = $data['clientName'];
        $firstname = $data['clientFirstName'];
        $tva = $data['clientTVA'];
        $email = $data['clientEmail'];
        $address = $data['clientAddress'];
        $city= $data['clientCity'];

        $city = explode(' ', $city);
        $address = explode(' ', $address);
        $number = (int) $address[count($address) -1];
        array_pop($address);
        $road = implode(" ", $address);
        $address = new Address(0, $road, $number, $city[0], $city[1]);
        try {
            $this->DAOAddress->insert($address);
            $address = $this->DAOAddress->selectWhere(["addressStreet" => $road])[0];
            $client = new Client(0, $lastname, $firstname, $tva, $email, true, $address);
            $this->DAOClient->insert($client);
            $client = $this->DAOClient->selectWhere(["clientsTvaNumber" => $tva])[0];
            $sale = $this->DAOSale->selectOne($session->get('sale_id'));
            $sale->setClient($client);
            $this->DAOSale->update($sale);
        } catch (DBException $e) {
            $session->set('error', 'Une erreur de connexion à la base de donnée est survenue');
            echo $e;
        } finally {
            header('Location: /');
        }

    }

    public function delete(int $id): void {
        global $session;
        if (!$session->get('USER')) {
            header('Location: /login');
            exit();
        }
        $saleID = $_POST['value'];
        try {
            $sale = $this->DAOSale->selectOne((int) $saleID);
            $amount = $sale->getDescription();
            $amount = explode("[", $amount)[1];
            $amount = (float) explode("]", $amount)[0];
            $session->set('amount', $amount);
            $sale->setAmount($amount);
            $sale->setDescription('Le paiement a été effectué le '. date("d-m-Y à H:m:s"));
            $this->DAOSale->update($sale);
        } catch (DBException) {
            $session->setFlash('error', 'Une erreur est survenue');
        } finally {
            header('Location: /');
        }
    }
}
