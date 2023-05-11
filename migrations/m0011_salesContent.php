<?php
use CashRegister\core\database\DBConnection;

class m0011_salesContent {

    public function up(): void {
        $db = DBConnection::getInstance();
        $query = "INSERT INTO salesContent (salesID, productsID) VALUES 
            (1, 1);
        ";

        $db->exec($query);
    }
}