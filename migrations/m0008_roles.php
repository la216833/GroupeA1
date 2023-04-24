<?php

use CashRegister\core\database\DBConnection;

class m0008_roles {

    public function up(): void {
        $db = DBConnection::getInstance();
        $query = "INSERT INTO roles (rolesName) VALUES 
            ('seller'),
            ('manager'),
            ('administrator');
        ";

        $db->exec($query);
    }
}