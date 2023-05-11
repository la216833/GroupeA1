<?php

use CashRegister\core\database\DBConnection;

class m0009_users {

    public function up(): void {
        $db = DBConnection::getInstance();
        $query = "INSERT INTO users (usersName, usersFirstname, usersAccessCode, usersImagePath, rolesID) VALUES 
            ('Jobin', 'Alfred', '39e0274dd5962cf0586fdde1b1108de1c3b3f19c', 'default-user-icon.png', 3),
            ('Lacasse', 'Charlot', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', 'default-user-icon.png', 2),
            ('Brasseur', 'Denis', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', 'default-user-icon.png', 2),
            ('Thériault', 'Raina', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', 'default-user-icon.png', 1),
            ('Flamand', 'Sébastien', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', 'default-user-icon.png', 1);
        ";

        $db->exec($query);
    }
}