<?php

namespace CashRegister\controllers;

use CashRegister\core\exception\DBException;
use CashRegister\core\View;
use CashRegister\daos\DAOCategory;
use CashRegister\daos\DAOProduct;
use CashRegister\daos\DAOStock;
use CashRegister\models\Category;

class CategoryController implements Controller
{

    private View $view;
    private DAOCategory $DAOCategory;
    private DAOProduct $DAOProduct;
    private DAOStock $DAOStock;

    public function __construct() {
        $this->view = new View();
        $this->DAOCategory = new DAOCategory();
        $this->DAOProduct = new DAOProduct();
        $this->DAOStock = new DAOStock();
    }

    public function get(): void
    {
        global $session;
        if ($session->get('ROLE') !== 'administrator') {
            header('Location: /');
            exit();
        }
        $params = [];
        try{
            $params['categories'] = $this->DAOCategory->selectAll();
            $params['category_active'] = count($this->DAOCategory->selectWhere(['categoriesActive' => 1]));
            $params['category_empty'] = 0;
            $params['category_inactive'] = count($this->DAOCategory->selectWhere(['categoriesActive' => 0]));
            foreach ($params['categories'] as $cat) {
                $params['quantity'][$cat->getName()] = count($this->DAOProduct->selectWhere(["categoriesID" => $cat->getID
                ()]));
            }
        } catch (DBException){
            $params['errors'] = "Une erreur est survenue";
        } finally {
            echo $this->view->render('categories.php', $params);
        }
    }

    public function get_one(int $id): void
    {
        global $session;
        if ($session->get('ROLE') !== 'administrator') {
            header('Location: /');
            exit();
        }
        $params = [];
        try {
            $params['category'] = $this->DAOCategory->selectOne($id);
        }catch (DBException){
            $params['errors'] = "Une erreur est survenue";
        } finally {
            echo $this->view->render('categoryForm.php', $params);
        }


    }

    public function add(): void
    {
        global $session;
        if ($session->get('ROLE') !== 'administrator') {
            header('Location: /');
            exit();
        }
        $params = [];
        try {
            $params['categories'] = $this->DAOCategory->selectAll();
        }catch (DBException){
            $params['errors'] = "Une erreur est survenue";
        } finally {
            echo $this->view->render('categoryForm.php', $params);
        }
    }

    public function post(): void
    {
        global $session;
        if ($session->get('ROLE') !== 'administrator') {
            header('Location: /');
            exit();
        }
        $params = [];
        $data = $_POST;
        if (isset($data)){
            if (!empty($data['name']) &&
                !empty($data['description']) &&
                !empty($data['status'])){

                $name = htmlentities($data['name']);

                try {
                    if (empty($this->DAOCategory->selectWhere(["categoriesName" => $name]))){
                        if (strlen($name) < 3 || strlen($name) > 50)
                            $params['errors']['name'] = "Le nom doit contenir entre 3 et 50 caractères";

                        if (isset($params['description']) && strlen($data['description'] > 100))
                            $params['errors']['description'] = "La description doit contenir moins de 100 caractères";

                        $status = (bool) $data['status'] ?? true;

                        if (!isset($params['errors'])){
                            $category = new Category(
                                0,
                                $name,
                                htmlentities($data['description']),
                                $status
                            );
                            if ($this->DAOCategory->insert($category)){
                                header("Locations: /categories");
                                exit();
                            }
                        }
                    } else {
                        if (!empty($this->DAOCategory->selectWhere(["categoriesName" => $name]))){
                            $params['errors'] = "Le nom de catégorie existe déjà";
                        }
                    }
                } catch (DBException){
                    $params['errors'] = "Une erreur est survenue";
                }

            }else {
                $params['errors'] = "Tous les champs doivent être complete";
            }
        }
        $params['data'] = $data;
        echo $this->view->render('categoryForm.php', $params);
    }

    public function post_one(int $id): void
    {
        // TODO: Implement post_one() method.
    }

    public function update(int $id): void
    {
        global $session;
        if ($session->get('ROLE') !== 'administrator') {
            header('Location: /');
            exit();
        }
        $data = $_POST;
        try {
            $category = $this->DAOCategory->selectOne($id);
            if ($category && isset($data)){
                $name = htmlentities($data['name']);
                $description = htmlentities($data['description']);
                $status = htmlentities($data['status']);
                if (($name !== $category->getName()) && (strlen($name) > 3 && strlen($name) <= 50))
                    $category->setName($name);
                if ($description !== $category->getDescription() && strlen($description) <= 100)
                    $category->setDescription($description);

                if ($status == 0){
                    $products = $this->DAOProduct->selectWhere(['categoryID' => $id]);
                    $productEmpty = 0;
                    foreach ($products as $product){
                        $stocks = $this->DAOStock->selectWhere(['productsID' => $product->getID()]);
                        $stockQuantity = 0;
                        foreach ($stocks as $stock){
                            $stockQuantity += $stock->getQuantity();
                        }
                        if ($stockQuantity){
                            $productEmpty++;
                        }
                    }
                    if (!$productEmpty){
                        $category->setActive(false);
                        $this->DAOCategory->update($category);
                    }
                } else{
                    $category->setActive(true);
                    $this->DAOCategory->update($category);
                }
            }
        }catch (DBException){
            $session->setFlash('error', 'Une erreur avec la base de donnée est survenue');
        }finally{
            header('location: /categories');
        }
    }

    public function delete(int $id): void
    {
        global $session;
        if ($session->get('ROLE') !== 'administrator') {
            header('Location: /');
            exit();
        }
        try {
            $category = $this->DAOCategory->selectOne($id);
            if ($category){
                $products = $this->DAOProduct->selectWhere(['categoriesID' => $category->getID()]);
                $nbProducts = 0;
                foreach ($products as $product) $nbProducts += 1;

                if ($nbProducts === 0){
                    $category->setActive(false);
                    $this->DAOCategory->update($category);
                }

            }
        }catch(DBException){

        } finally {
            header('Location: /categories');
        }
    }
}