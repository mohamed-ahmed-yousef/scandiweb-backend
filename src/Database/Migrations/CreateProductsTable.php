<?php
namespace Scandiweb\WebDeveloper\Database\Migrations;

use PDO;

class CreateProductsTable {
    public static function up(PDO $pdo) {
        $sql = "
            CREATE TABLE IF NOT EXISTS products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                sku VARCHAR(255) NOT NULL UNIQUE,
                name VARCHAR(255) NOT NULL,
                price DECIMAL(10, 2) NOT NULL,
                category ENUM('DVD', 'Book', 'Furniture') NOT NULL,
                size DECIMAL(10, 2) NULL,          -- DVD specific attribute
                weight DECIMAL(10, 2) NULL,        -- Book specific attribute
                height DECIMAL(10, 2) NULL,        -- Furniture specific attribute
                width DECIMAL(10, 2) NULL,         -- Furniture specific attribute
                length DECIMAL(10, 2) NULL         -- Furniture specific attribute
            );
        ";
        $pdo->exec($sql);
    }
}
