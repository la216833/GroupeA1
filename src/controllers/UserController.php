<?php

namespace CashRegister\controllers;

use CashRegister\core\exception\DBException;
use CashRegister\daos\DAORole;
use CashRegister\daos\DAOUser;
use CashRegister\core\View;
use CashRegister\models\User;

class UserController implements Controller
{


    private View $view;
    private DAORole $DAORole;
    private DAOUser $DAOUser;

    public function __construct() {
        $this->view = new View();
        $this->DAOUser = new DAOUser();
        $this->DAORole = new DAORole();
    }
    public function get(): void
    {
        global $session;
        if ($session->get('ROLE') !== 'administrator') {
            header('Location: /');
            exit();
        }
        $params = [];

        try {
            $params['roles'] = $this->DAORole->selectAll();
            $params['users'] = $this->DAOUser->selectAll();
            $params['users_seller'] = count($this->DAOUser->selectWhere(['rolesID' => 1]));
            $params['users_manager'] = count($this->DAOUser->selectWhere(['rolesID' => 2]));
            $params['users_admin'] = count($this->DAOUser->selectWhere(['rolesID' => 3]));
        } catch (DBException) {
            $params['errors'] = "Une erreur est survenue";
        } finally {
            echo $this->view->render('users.php', $params);
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
            $params['user'] = $this->DAOUser->selectOne($id);
        } catch (DBException) {
            $params['errors'] = "Une erreur est survenue";
        } finally {
            echo $this->view->render('userForm.php', $params);
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
        echo $this->view->render('userForm.php', $params);
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
                !empty($data['firstname']) &&
                !empty($data['accesscode']) &&
                !empty($data['role']) &&
                !empty($data['status'])){

                $name = htmlentities($data['name']);
                $accessCode = htmlentities($data['accesscode']);
                $role = htmlentities($data['role']);

                    try {

                        if(strlen($data['accessscode']) != 6 ||  !preg_match('/^\d+$/', $data['accesscode']))
                            $params['errors']['accessscode'] = "Le code d'access doit contenir 6 caractères numériques";

                        $accessCode = hash($accessCode,PASSWORD_DEFAULT);

                        $users = $this->DAOUser->selectAll();
                        foreach ($users as $user){
                            if (password_verify($accessCode,$user->getAccessCode())){
                                $currentUser = $user;
                                break;
                            }
                        }

                        if ($currentUser == null &&
                            !empty($this->DAORole->selectWhere(["rolesName" => $role]))){

                            if(strlen($name) < 3 || strlen($name) > 50)
                                $params['errors']['name'] = "Le nom doit contenir entre 3 et 50 caractères";

                            if(strlen($data['firstname']) < 3 || strlen($data['firstname']) > 50)
                                $params['errors']['firstname'] = "Le prénom doit contenir entre 3 et 50 caractères";

                            $status = (bool) $data['status'] ?? true;

                            if (!is_array($params['errors'])){
                                $user = new User(

                                    0,
                                    $name,
                                    htmlentities($data['firstname']),
                                    $data['accessscode'],
                                    htmlentities($data['image']),
                                    $status,
                                    $this->DAORole->selectWhere(["rolesname" => $role])

                                );

                                if ($this->DAOUser->insert($user)){
                                    header("Location: /users");
                                    exit();
                                }
                            }

                        }else {
                            if (!$currentUser == null){
                                $params['errors'] = "l'utilisateur existe dèja";
                            } else if (empty($this->DAORole->selectWhere(["rolesName" => $role]))){
                                $params['errors'] = "le role séléctionné n'existe pas";
                            }
                        }
                    } catch (DBException){
                        $params['errors'] = "Une erreur est survenue";
                    }


            }else {
                $params['errors'] = "Tous les champs doivent être complete";
            }
        }
        try {
            $params['roles'] = $this->DAORole->selectAll();

        }catch (DBException){
            $params['errors'] = "Une erreur est survenue";
        } finally {
            $params['data'] = $data;
            echo $this->view->render('userFrom.php', $params);
        }

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
        $params= array();
        $data = $_POST;
        try {
            $user = $this->DAOUser->selectOne($id);
            if($user && isset($data)){
                $name = htmlentities($data['name']);
                $firstname = htmlentities($data['firstname']);
                $accesssCode = htmlentities($data['accessscode']);
                $image = htmlentities($data['image']);
                $role = htmlentities($data['role']);
                $status = htmlentities($data['status']);

                if (($name !== $user->getName()) && (strlen($name) > 3 && strlen($name) <= 50))
                    $user->setName($name);
                if (($firstname !== $user->getFirstname()) && (strlen($firstname) > 3 && strlen($firstname) <= 50))
                    $user->setFirstname($firstname);
                if (isset($accessCode)){
                    if (strlen($accesssCode) != 6 ||  !preg_match('/^\d+$/', $accesssCode)){
                        $accessCode = hash($accessCode,PASSWORD_DEFAULT);
                        $users = $this->DAOUser->selectAll();
                        foreach ($users as $user){
                            if (password_verify($accessCode,$user->getAccessCode())){
                                $currentUser = $user;
                                break;
                            }
                        }
                        if (!$currentUser == null){
                            $params['errors'] = "l'utilisateur existe dèja";
                        }else{
                            $user->setAccessCode();
                        }
                    }
                }
                if ($role !== $user->getRole()){
                    $user->setRole($role);
                }

                if ($status !== $user->getStatus()){
                    $user->setStatus($status);
                }
                $this->DAOUser->update($user);

            }
        }catch (DBException){

        } finally {
            header('Location: /users');
        }
    }

    public function delete(int $id): void
    {
        // TODO: Implement delete() method.
    }
}