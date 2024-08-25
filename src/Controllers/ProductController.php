<?php

use Scandiweb\WebDeveloper\Database\DatabaseConnection;
use Scandiweb\WebDeveloper\Factories\ProductFactory;

function createProduct($requestData) {
    $product = ProductFactory::createProduct($requestData['category'], $requestData);
    $pdo = DatabaseConnection::getConnection();
    $stmt = $pdo->prepare('INSERT INTO products (sku, name, price, category, size, weight, height, width, length) 
                           VALUES (:sku, :name, :price, :category, :size, :weight, :height, :width, :length)');
    $stmt->execute([
        ':sku' => $product->getSku(),
        ':name' => $product->getName(),
        ':price' => $product->getPrice(),
        ':category' => $requestData['category'],
        ':size' => $requestData['category'] === 'DVD' ? $product->getCategorySpecificAttribute()['size'] : null,
        ':weight' => $requestData['category'] === 'Book' ? $product->getCategorySpecificAttribute()['weight'] : null,
        ':height' => $requestData['category'] === 'Furniture' ? $product->getCategorySpecificAttribute()['height'] : null,
        ':width' => $requestData['category'] === 'Furniture' ? $product->getCategorySpecificAttribute()['width'] : null,
        ':length' => $requestData['category'] === 'Furniture' ? $product->getCategorySpecificAttribute()['length'] : null,
    ]);
}

function getProductsSortedByType() {
    $pdo = DatabaseConnection::getConnection();
    $sql = "SELECT * FROM products ORDER BY FIELD(category, 'DVD', 'Book', 'Furniture')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
