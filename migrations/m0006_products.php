<?php

use CashRegister\core\database\DBConnection;

class m0006_products {

    public function up(): void {
        $db = DBConnection::getInstance();
        $query = "INSERT INTO products (productsName, productsDescription, productsPrice, productsImagePath, tvaID, categoriesID) VALUES 
            ('COCA-COLA Regular', 'Original Taste 33cl', 0.93, 'coca-cola.png', 3, 1),
            ('RED BULL', 'Boisson énergisante 25cl', 1.88, 'red-bull.png', 3, 1),
            ('SPA REINE', 'Eau plate 1,5L', 0.91, 'spa-reine.png', 3, 1),
            ('LIPTON Ice Tea', 'Original pétillant 33cl', 1.28, 'lipton-ice-tea.png', 3, 1),
            ('KINDER Bueno', '', 1.08, 'kinder-bueno.png', 3, 2),
            ('Smarties', 'Giant Tube 120 grammes', 1.08, 'smarties.png', 3, 2),
            ('Maltesers', '135 grammes', 2.39, 'maltesers.png', 3, 2),
            ('Milka Cookie', 'Sensations Oreo Creme 156 grammes', 1.78, 'milka-cookie.png', 3, 2),
            ('Stylos à bille ', 'Pilot Supergrip', 2.99, 'stylo-a-bille.png', 3, 3),
            ('Marqueurs à double pointe', '135 grammes', 3.59, 'marqueurs-double-pointe.png', 3, 3),
            ('Trousse en velours', 'Diverses couleurs', 2.69, 'trousse-velours.png', 3, 3),
            ('Crayons de couleur', '12 pièces', 1.39, 'crayons-couleur.png', 3, 3),
            ('Rubik\'s Cube', '3x3', 2.19, 'rubiks-cube.png', 2, 4),
            ('Dés', '3 pièces', 1.09, 'des.png', 2, 4),
            ('Ressort magique', 'Diamètre 6 cm', 0.79, 'ressort-magique.png', 2, 4),
            ('Corde à sauter', '2 mètres', 0.49, 'corde-a-saute.png', 2, 4),
            ('Corde de jute', '50 mètres', 1.39, 'corde-jute.png', 1, 5),
            ('Gants de peinture', 'Taille M - XL', 1.19, 'gants-peinture.png', 1, 5),
            ('Boîte de rangement', '5 compartiments', 4.39, 'boite-rangement.png', 1, 5),
            ('Ruban adhésif d’emballage', '55 x 48 mm', 1.59, 'ruban-adhesif.png', 1, 5);
        ";

        $db->exec($query);
    }
}