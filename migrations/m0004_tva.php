<?php

use CashRegister\core\database\DBConnection;

class m0004_tva {

    public function up(): void {
        $db = new DBConnection($_ENV, dirname('../'));
        $query = "INSERT INTO tva (tvaPercent, tvaName) VALUES 
            (0, 'Taxe 0'),
            (6, 'Taxe 6'),
            (21, 'Taxe 21');
        ";

        $db->getPDO()->exec($query);
    }
}