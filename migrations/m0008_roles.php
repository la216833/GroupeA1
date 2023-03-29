<?php

use CashRegister\core\database\DBConnection;

class m0008_roles {

    public function up(): void {
        $db = DBConnection::getInstance();
        $query = "INSERT INTO roles (rolesName) VALUES 
            ('administrator'),
            ('seller'),
            ('manager');
        ";

        $db->exec($query);
    }
}