<?php

use CashRegister\core\database\DBConnection;

class m0005_categories {

    public function up(): void {
        $db = DBConnection::getInstance();
        $query = "INSERT INTO categories (categoriesName, categoriesDescription) VALUES 
            ('Boissons', 'Une boisson, ou un breuvage, est un liquide destiné à la consommation.'),
            ('Confiserie', 'Une confiserie est un produit à base de sucre qui est vendu dans un magasin du même nom et fabriqué par un confiseur.'),
            ('Papeterie', 'Une papeterie est un magasin vendant des fournitures de bureau ou des fournitures scolaires. Ce type de commerce est souvent couplé avec celui d\'une librairie ou une maison de la presse.'),
            ('Jouets', 'Un jouet est un objet dont la fonction principale est ludique et récréative et donc de permettre le jeu. Enfants du Burundi inventant leurs propres jouets.'),
            ('Bricolage', 'Le bricolage est une activité manuelle visant à réparer, entretenir, améliorer ou fabriquer de petits objets.');
        ";

        $db->exec($query);
    }
}