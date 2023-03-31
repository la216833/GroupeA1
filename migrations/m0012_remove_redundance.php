<?php

use CashRegister\core\database\DBConnection;

class m0012_remove_redundance {

    public function up(): void {
        $db = DBConnection::getInstance();
        $query = "
            UPDATE categories SET categoriesName='Real Estate Trusted Investments' WHERE categoriesID = 2;
            UPDATE categories SET categoriesName='Termite Control' WHERE categoriesID = 8;
            UPDATE categories SET categoriesName='Overhead Doors' WHERE categoriesID = 10;
            UPDATE categories SET categoriesName='Major Pharmaceutical' WHERE categoriesID = 11;
            UPDATE categories SET categoriesName='Site Furnishings' WHERE categoriesID = 14;
            UPDATE categories SET categoriesName='EIFS' WHERE categoriesID = 15;
            UPDATE categories SET categoriesName='Electrical' WHERE categoriesID = 16;
            UPDATE categories SET categoriesName='Casework' WHERE categoriesID = 19;
            UPDATE categories SET categoriesName='Framing' WHERE categoriesID = 25;
            UPDATE categories SET categoriesName='Elevator' WHERE categoriesID = 26;
            UPDATE categories SET categoriesName='Pharmaceuticals Major' WHERE categoriesID = 31;
            UPDATE categories SET categoriesName='Banks' WHERE categoriesID = 32;
            UPDATE categories SET categoriesName='Masonry & Precast' WHERE categoriesID = 33;
            UPDATE categories SET categoriesName='Curb & Gutter' WHERE categoriesID = 34;
            UPDATE categories SET categoriesName='Gutter' WHERE categoriesID = 35;
            UPDATE categories SET categoriesName='Ornamental' WHERE categoriesID = 36;
            UPDATE categories SET categoriesName='Irrigation' WHERE categoriesID = 37;
            UPDATE categories SET categoriesName='Railings' WHERE categoriesID = 39;
            UPDATE categories SET categoriesName='Drywall' WHERE categoriesID = 40;
            UPDATE categories SET categoriesName='Acoustical' WHERE categoriesID = 41;
            UPDATE categories SET categoriesName='Construction Clean' WHERE categoriesID = 42;
            UPDATE categories SET categoriesName='Drywals' WHERE categoriesID = 43;
            UPDATE categories SET categoriesName='Acousticals' WHERE categoriesID = 46;
            UPDATE categories SET categoriesName='Drilled' WHERE categoriesID = 47;
            UPDATE categories SET categoriesName='Prepackaged' WHERE categoriesID = 50;
        ";
        $db->exec($query);
    }
}