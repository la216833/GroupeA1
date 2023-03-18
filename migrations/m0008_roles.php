<?php

use CashRegister\core\database\DBConnection;

class m0008_roles {

    public function up(): void {
        $db = new DBConnection($_ENV, dirname('../'));
        $query = "INSERT INTO roles (rolesName) VALUES 
            ('administartor'),
            ('seller'),
            ('manager');
        ";

        $db->getPDO()->exec($query);
    }
}