<?php

use Scandiweb\WebDeveloper\Database\DatabaseConnection;
use Scandiweb\WebDeveloper\Database\Migrations\CreateProductsTable;

require_once 'DatabaseConnection.php';
require_once 'Migrations/CreateProductsTable.php';

$pdo = DatabaseConnection::getConnection();

CreateProductsTable::up($pdo);

echo "Products table created successfully.\n";
