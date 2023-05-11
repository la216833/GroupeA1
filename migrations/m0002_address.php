<?php

use CashRegister\core\database\DBConnection;

class m0002_address {

    public function up(): void {
        $db = DBConnection::getInstance();
        $query = "
        INSERT INTO address (addressStreet, addressNumber, addressCity, addressCountry) VALUES 
            ('Rue Trieu Kaisin', 136, 6061, 'Belgium'),
            ('Chaussée de Solvay', 55, 6061, 'Belgium'),
            ('Chaussée de Binche', 159, 7000, 'Belgium'),
            ('Quai des Salines', 28, 7500, 'Belgium'),
            ('Place Maurice Brasseur', 6, 6280, 'Belgium');
        ";

        $db->exec($query);
    }
}