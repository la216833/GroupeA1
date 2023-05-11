<?php

use CashRegister\core\database\DBConnection;

class m0003_clients {

    public function up(): void {
        $db = DBConnection::getInstance();
        $query = "INSERT INTO clients (clientsName, clientsFirstname, clientsTvaNumber, clientsEmail, addressID) VALUES 
            ('LaGrande', 'Nicholas', 'LO52765989554', 'nicholasLaGrande@teleworm.us', 1),
            ('Parnella', 'Beausoleil', 'XY70763362912', 'parnellaBeausoleil@rhyta.com', 2),
            ('Jolie', 'Coupart', 'EX21093065559', 'jolieCoupart@jourrapide.com', 3),
            ('Zdenek', 'Quenneville', 'MV98009587458', 'zdenekQuenneville@dayrep.com', 4),
            ('Pierpont', 'Bossé', 'PK75108882601', 'pierpontBosse@rhyta.com', 5);
        ";

        $db->exec($query);
    }
}