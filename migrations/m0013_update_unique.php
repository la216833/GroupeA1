<?php

use CashRegister\core\database\DBConnection;

class m0013_update_unique {

    public function up(): void {
        $db = DBConnection::getInstance();
        $query = "
            ALTER TABLE clients MODIFY COLUMN clientsTvaNumber VARCHAR(13) NOT NULL UNIQUE;
            ALTER TABLE clients MODIFY COLUMN clientsEmail VARCHAR(255) NOT NULL UNIQUE;
            ALTER TABLE tva MODIFY COLUMN tvaPercent DECIMAL(4,2) UNSIGNED NOT NULL UNIQUE;
            ALTER TABLE tva MODIFY COLUMN tvaName VARCHAR(50) NOT NULL UNIQUE;
            ALTER TABLE categories MODIFY COLUMN categoriesName VARCHAR(100) NOT NULL UNIQUE;
            ALTER TABLE products MODIFY COLUMN productsName VARCHAR(50) NOT NULL UNIQUE;
            ALTER TABLE roles MODIFY COLUMN rolesName VARCHAR(50) NOT NULL UNIQUE;
        ";
        $db->exec($query);
    }
}