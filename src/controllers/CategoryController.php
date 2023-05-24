<?php

namespace CashRegister\controllers;

use CashRegister\core\exception\DBException;
use CashRegister\core\View;
use CashRegister\daos\DAOCategory;
use CashRegister\daos\DAOProduct;
use CashRegister\models\Category;

class CategoryController implements Controller
{

    private View $view;
    private DAOCategory $DAOCategory;
    private DAOProduct $DAOProduct;
    public function __construct() {
        $this->view = new View();
        $this->DAOCategory = new DAOCategory();
        $this->DAOProduct = new DAOProduct();
    }

    public function get(): void
    {
        $params = [];
        try{
            $params['categories'] = $this->DAOCategory->selectAll();
            $params['category_active'] = count($this->DAOCategory->selectWhere(['categoriesActive' => 1]));
            $params['category_empty'] = 0; // TODO : check the real value
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
        $params = [];
        try {
            $categoryDao = new DAOCategory();
            $params['category'] = $categoryDao->selectOne($id);
        }catch (DBException){
            $params['errors'] = "Une erreur est survenue";
        } finally {
            echo $this->view->render('categoryForm.php', $params);
        }


    }

    public function add(): void
    {
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

                        if (!is_array($params['errors'])){
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
    }

    public function post_one(int $id): void
    {
        // TODO: Implement post_one() method.
    }

    public function update(int $id): void
    {
        $data = $_POST;
        try {
            $category = $this->DAOCategory->selectOne($id);
            if ($category && isset($data)){
                $name = htmlentities($data['name']);
                $description = htmlentities($data['description']);
                if (($name !== $category->getName()) && (strlen($name) > 3 && strlen($name) <= 50))
                    $category->setName($name);
                if ($description !== $category->getDescription() && strlen($description) <= 100)
                    $category->setDescription($description);

                $this->DAOCategory->update($category);
            }
        }catch (DBException){

        }finally{
            header('location: /categories');
        }
    }

    public function delete(int $id): void
    {
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