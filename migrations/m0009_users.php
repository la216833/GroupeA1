<?php

use CashRegister\core\database\DBConnection;

class m0009_users {

    public function up(): void {
        $db = DBConnection::getInstance();
        $query = "INSERT INTO users (usersName, usersFirstname, usersAccessCode, usersImagePath, rolesID) VALUES 
            ('Jobin', 'Alfred', '$2y$10\$m9EyT0.BvgJ31xSuUbigXuJMtCT5ev7XoyB4PNgVPiWYXwQAYpWS6', 'default-user-icon.png', 3),
            ('Lacasse', 'Charlot', '$2y$10\$t48cmNWHUCuyR8DU7ab3lus6H/ti7dJs2m0awSNBI/oaAcu1EyZWu', 'default-user-icon.png', 2),
            ('Brasseur', 'Denis', '$2y$10\$pc64Wa.DhrcPs1KQVXKS9.pUhuEkvNLbWnoCb.IBrt7.N70Mazj4m', 'default-user-icon.png', 2),
            ('Thériault', 'Raina', '$2y$10\$JsCaOJYFVm1lqDt9Sgys/eqMHdxWdxdBycT/5AAls3rgrQSLg410y', 'default-user-icon.png', 1),
            ('Flamand', 'Sébastien', '$2y$10\$wGqA/e3IBGu6F8nrsXlGOO7UEebeaqSnpfDTaTPiy/Ligufg1lrpG', 'default-user-icon.png', 1);
        ";

        $db->exec($query);
    }
}