<?php

namespace CashRegister\core;

use CashRegister\daos\DAORole;
use CashRegister\models\Role;
use CashRegister\models\User;
use PDO;
use Exception;
use function Sodium\compare;

class Configuration {

    private View $view;

    private static String $query = "
        DROP TABLE salesContent;
        DROP TABLE sales;
        DROP TABLE users;
        DROP TABLE roles;
        DROP TABLE stock;
        DROP TABLE products;
        DROP TABLE categories;
        DROP TABLE tva;
        DROP TABLE clients;
        DROP TABLE address;

        CREATE TABLE IF NOT EXISTS address (
            addressID INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            addressStreet TEXT NOT NULL,
            addressNumber SMALLINT UNSIGNED NOT NULL,
            addressCity MEDIUMINT UNSIGNED NOT NULL,
            addressCountry VARCHAR(100) NOT NULL
        );
        
        CREATE TABLE IF NOT EXISTS clients (
            clientsID INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            clientsName VARCHAR(100) NOT NULL,
            clientsFirstname VARCHAR(100) NOT NULL,
            clientsTvaNumber VARCHAR(13) NOT NULL UNIQUE,
            clientsEmail VARCHAR(255) NOT NULL UNIQUE,
            clientsActive BOOLEAN DEFAULT TRUE,
            addressID INT UNSIGNED NOT NULL,
            FOREIGN KEY (addressID) REFERENCES address(addressID));
        
        CREATE TABLE IF NOT EXISTS tva (
            tvaID TINYINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            tvaPercent DECIMAL(4,2) UNSIGNED NOT NULL UNIQUE,
            tvaName VARCHAR(50) NOT NULL UNIQUE);
        
        CREATE TABLE IF NOT EXISTS categories (
            categoriesID INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            categoriesName VARCHAR(100) NOT NULL UNIQUE,
            categoriesDescription TEXT NOT NULL,
            categoriesActive BOOLEAN DEFAULT TRUE);
                
        CREATE TABLE IF NOT EXISTS products (
            productsID INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            productsName VARCHAR(50) NOT NULL UNIQUE,
            productsDescription VARCHAR(100) NOT NULL,
            productsPrice DECIMAL(8,3) UNSIGNED NOT NULL,
            productsImagePath TEXT NOT NULL,
            productsActive BOOLEAN DEFAULT TRUE,
            tvaID TINYINT UNSIGNED NOT NULL,
            categoriesID INT UNSIGNED NOT NULL,
            FOREIGN KEY (tvaID) REFERENCES tva(tvaID),
            FOREIGN KEY (categoriesID) REFERENCES categories(categoriesID));
            
        CREATE TABLE IF NOT EXISTS stock (
            stockID MEDIUMINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            stockQuantity SMALLINT UNSIGNED NOT NULL,
            stockDate DATETIME NOT NULL,
            stockBuyPrice DECIMAL(8,3) UNSIGNED NOT NULL,
            stockActive BOOLEAN DEFAULT TRUE,
            productsID INT UNSIGNED NOT NULL,
            FOREIGN KEY (productsID) REFERENCES products(productsID));
        
        CREATE TABLE IF NOT EXISTS roles (
            rolesID TINYINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            rolesName VARCHAR(50) NOT NULL UNIQUE,
            rolesActive BOOLEAN DEFAULT TRUE);
        
        CREATE TABLE IF NOT EXISTS users (
            usersID INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            usersName VARCHAR(100) NOT NULL,
            usersFirstname VARCHAR(100) NOT NULL,
            usersAccessCode TEXT NOT NULL,
            usersImagePath TEXT,
            usersActive BOOLEAN NOT NULL DEFAULT TRUE,
            rolesID TINYINT UNSIGNED NOT NULL,
            FOREIGN KEY (rolesID) REFERENCES roles(rolesID));

        CREATE TABLE IF NOT EXISTS sales (
            salesID INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            salesDate DATETIME NOT NULL,
            salesAmount DECIMAL(9,3) UNSIGNED NOT NULL,
            salesDescription TEXT,
            usersID INT UNSIGNED NOT NULL,
            clientsID INT UNSIGNED,
            FOREIGN KEY (usersID) REFERENCES users(usersID),
            FOREIGN KEY (clientsID) REFERENCES clients(clientsID));
        
        CREATE TABLE IF NOT EXISTS salesContent (
            salesID INT UNSIGNED NOT NULL AUTO_INCREMENT,
            productsID INT UNSIGNED NOT NULL,
            quantity SMALLINT UNSIGNED NOT NULL DEFAULT 1,
            FOREIGN KEY (salesID) REFERENCES sales(salesID),
            FOREIGN KEY (productsID) REFERENCES products(productsID));
    ";



    public function __construct() {
        $this->view = new View();
    }


    public function install(): void {
        $params = [];

        if (!empty($_POST)) {
            $params['data'] = $_POST;
            if (isset($_POST['hostname']) && $_POST['database'] && $_POST['username'] && $_POST['password']
                && isset($_POST['admin_password']) && isset($_POST['admin_confirm'])) {


                $hostname = htmlentities($_POST['hostname']);
                $database = htmlentities($_POST['database']);
                $username = htmlentities($_POST['username']);
                $password = htmlentities($_POST['password']);
                $admin_password = htmlentities($_POST['admin_password']);
                $admin_confirm = htmlentities($_POST['admin_confirm']);
                $init = isset($_POST['init_db']) ?? false;

                if (strcmp($admin_password, $admin_confirm) === 0) {
                    try {
                        $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
                        if ($pdo !== null && $init) $pdo->exec(self::$query);

                        $role = new Role(1, 'administrator', true);
                        $user = new User(1, 'admin', 'admin', password_hash($password, PASSWORD_BCRYPT), '', true, $role);

                        $pdo->exec("INSERT INTO roles VALUES (1, 'administrator', 1)");
                        $pdo->exec("INSERT INTO users VALUES (1, 'administrator', 'administrator', '".password_hash
                            ($password, PASSWORD_DEFAULT)."', '', 1, 1)");

                        $file = fopen(dirname(__DIR__, 2) . "/.env", "w");
                        $content = "DB_DSN=\"mysql:host=$hostname;dbname=$database\"\n";
                        fwrite($file, $content);
                        $content = "DB_USER=\"$username\"\n";
                        fwrite($file, $content);
                        $content = "DB_PASSWORD=\"$password\"\n";
                        fwrite($file, $content);
                        fclose($file);

                        header('Location: /login');
                        exit();
                    } catch (Exception) {
                        $params['errors'] = "There was an error in your credentials please try again.";
                    } finally {
                        $pdo = null;
                    }
                } else {
                    $params['errors'] = "The administrator password aren't the same.";
                }
            } else {
                $params['errors'] = "Complete all the fields";
            }
        }
        echo $this->view->render('install.php', $params);
        exit();
    }
}