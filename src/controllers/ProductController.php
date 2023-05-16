<?php

namespace CashRegister\controllers;

use CashRegister\core\exception\DBException;
use CashRegister\core\View;
use CashRegister\daos\DAOCategory;
use CashRegister\daos\DAOProduct;
use CashRegister\daos\DAOStock;
use CashRegister\daos\DAOTva;
use CashRegister\models\Product;
use CashRegister\models\Stock;
use CashRegister\models\TVA;

class ProductController implements Controller {

    private View $view;
    private DAOProduct $DAOProduct;
    private DAOStock $DAOStock;
    private DAOCategory $DAOCategory;
    private DAOTva $DAOTva;

    public function __construct() {
        $this->view = new View();
        $this->DAOProduct = new DAOProduct();
        $this->DAOStock = new DAOStock();
        $this->DAOCategory = new DAOCategory();
        $this->DAOTva = new  DAOTva();
    }

    public function get(): void {
        $params = [];
        try {
            $params['categories'] = $this->DAOCategory->selectAll();
            $params['products'] = $this->DAOProduct->selectAll();
            $params['product_out_of_stock'] = 0;
            $params['product_available'] = count($this->DAOProduct->selectWhere(['productsActive' => 1]));
            $params['product_unavailable'] = count($this->DAOProduct->selectWhere(['productsActive' => 0]));
            $params['quantities'] = [];
            foreach ($params['products'] as $product) {
                $stocks = $this->DAOStock->selectWhere(['productsID' => $product->getID()]);
                $quantity = 0;
                foreach ($stocks as $stock) {
                    $quantity += $stock->getQuantity();
                }
                $params['quantities'][$product->getName()] = $quantity;
            }
        } catch (DBException) {
            $params['errors'] = "Une erreur est survenue";
        } finally {
            echo $this->view->render('products.php', $params);
        }


    }

    public function get_one(int $id): void {
        $params = [];
        try {
            $params['product'] = $this->DAOProduct->selectOne($id);
        } catch (DBException) {
            $params['errors'] = "Une erreur est survenue";
        } finally {
            echo $this->view->render('productFrom.php', $params);
        }
    }

    public function add(): void {
        $params = [];
        try {
            $params['categories'] = $this->DAOCategory->selectAll();
            $params['tva'] = $this->DAOTva->selectAll();
        } catch (DBException ) {
            $params['errors'] = "Une erreur est survenue";
        } finally {
            echo $this->view->render('productFrom.php', $params);
        }
    }

    public function post(): void {
        $params = [];
        $data = $_POST;
        if (isset($data)) {
            if (!empty($data['name']) && !empty($data['date']) && !empty($data['quantity']) &&
                !empty($data['buyPrice']) && !empty($data['salePrice']) && !empty($data['category'] &&
                !empty($data['tva']) && !empty($data['status']))) {

                $name = htmlentities($data['name']);
                $category = htmlentities($data['category']);
                $tva = htmlentities($data['tva']);

                try {
                    if (empty($this->DAOProduct->selectWhere(["productsName" => $name])) &&
                        !empty($this->DAOCategory->selectWhere(["categoriesName" => $category])) &&
                        !empty($this->DAOTva->selectWhere(["tvaName" => $tva]))) {

                        if (strlen($name) < 3 || strlen($name) > 50)
                            $params['errors']['name'] = "Le nom doit contenir entre 3 et 50 caractères";

                        if (isset($params['description']) && strlen($data['description'] >= 100))
                            $params['errors']['description'] = "La description doit contenir moins de 100 caractères";

                        $quantity = (int) $data['quantity'];
                        if ($quantity < 0 || $quantity > 200)
                            $params['errors']['quantity'] = "La quantité doit être entre 1 et 1000";

                        $buyPrice = (float) $data['buyPrice'];
                        if ($buyPrice < 0 || $buyPrice > 100)
                            $params['errors']['buyPrice'] = "Le prix d'achat doit être entre 0 et 100";

                        $salePrice = (float) $data['salePrice'];
                        if ($salePrice < 0 || $salePrice > 200)
                            $params['errors']['salePrice'] = "Le prix de vente doit être entre 0 et 200";

                        $status = (bool) $data['status'] ?? true;

                        if (!is_array($params['errors'])) {
                            $product = new Product(
                                0,
                                $name,
                                htmlentities($data['description']),
                                $salePrice,
                                $status,
                                htmlentities($data['image']),
                                $this->DAOTva->selectWhere(["tvaName" => $tva])[0],
                                $this->DAOCategory->selectWhere(["categoriesName" => $category])[0]);
                            if ($this->DAOProduct->insert($product)) {
                                $stock = new Stock(0, $quantity, $data['date'],$buyPrice, true,
                                    $this->DAOProduct->selectWhere(["productsName" => $name])[0]);
                                if ($this->DAOStock->insert($stock)) {
                                    header("Location: /products");
                                    exit();
                                }
                            }
                        }
                    } else {
                        if (!empty($this->DAOProduct->selectWhere(["productsName" => $name]))) {
                            $params['errors'] = "Le nom de produit existe déjà";
                        } else if (empty($this->DAOCategory->selectWhere(["categoriesName" => $category]))) {
                            $params['errors'] = "La catégorie sélectionnée n'existe pas";
                        } else if (empty($this->DAOCategory->selectWhere(["tvaName" => $tva]))) {
                            $params['errors'] = "La TVA sélectionnée n'existe pas";
                        }
                    }
                } catch (DBException) {
                    $params['errors'] = "Une erreur est survenue";
                }
            } else {
                $params['errors'] = "Tous les champs doivent être complete";
            }
        }
        // Si il ya une erreur
        try {
            $params['categories'] = $this->DAOCategory->selectAll();
            $params['tva'] = $this->DAOTva->selectAll();
        } catch (DBException) {
            $params['errors'] = "Une erreur est survenue";
        } finally {
            $params['data'] = $data;
            echo $this->view->render('productFrom.php', $params);
        }
    }


    public function post_one(int $id): void {

    }

    public function update(int $id): void {

    }

    public function delete(int $id): void {

    }

}
