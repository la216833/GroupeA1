<?php

use CashRegister\core\database\DBConnection;

class m0001_initial {

    public function up(): void {
        $db = DBConnection::getInstance();
        $query = "
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

        $db->exec($query);
    }
}