<?php

use CashRegister\core\database\DBConnection;

class m0009_users {

    public function up(): void {
        $db = new DBConnection($_ENV, dirname('../'));
        $query = "INSERT INTO users (usersName, usersFirstname, usersAccessCode, usersImagePath, rolesID) VALUES 
            ('Jodlkowski', 'Denver', '39e0274dd5962cf0586fdde1b1108de1c3b3f19c', 'default-user-icon.png', 3),
            ('Yankov', 'Lana', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', 'default-user-icon.png', 1),
            ('Rumney', 'Tremaine', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', 'default-user-icon.png', 2),
            ('Templar', 'Carl', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', 'default-user-icon.png', 1),
            ('Honeyghan', 'Wolfgang', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', 'default-user-icon.png', 1),
            ('Diggens', 'Rossie', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', 'default-user-icon.png', 2),
            ('Andrei', 'Melody', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', 'default-user-icon.png', 1),
            ('Wressell', 'Thorin', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', 'default-user-icon.png', 2),
            ('Lever', 'Ashely', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', 'default-user-icon.png', 2),
            ('Shernock', 'Arty', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', 'default-user-icon.png', 1),
            ('Candish', 'Bonnee', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', 'default-user-icon.png', 3),
            ('Lamzed', 'Elwood', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', 'default-user-icon.png', 1),
            ('Heamus', 'Lemar', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', null, 1),
            ('Maynard', 'Desirae', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', null, 2),
            ('Redwood', 'Maxie', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', 'default-user-icon.png', 1),
            ('Petrashkov', 'Kalila', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', 'default-user-icon.png', 3),
            ('Loftin', 'Perry', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', 'default-user-icon.png', 1),
            ('Fretter', 'Clement', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', 'default-user-icon.png', 1),
            ('Sleit', 'Isabelita', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', 'default-user-icon.png', 1),
            ('Gosby', 'Anissa', '28fb1e741c3a51f3ade6aa2ef44020987dff0438', 'default-user-icon.png', 2);
        ";

        $db->getPDO()->exec($query);
    }
}