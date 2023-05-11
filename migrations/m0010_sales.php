<?php

use CashRegister\core\database\DBConnection;

class m0010_sales {

    public function up(): void {
        $db = DBConnection::getInstance();
        $query = "INSERT INTO sales (salesDate, salesAmount, salesDescription, usersID, clientsID) VALUES 
            ('2022-05-23 21:32:14', 35.3, '', 1, 1)
        ";

        $db->exec($query);
    }
}