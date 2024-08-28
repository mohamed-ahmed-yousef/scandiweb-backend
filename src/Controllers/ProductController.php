<?php

use Scandiweb\WebDeveloper\Database\DatabaseConnection;
use Scandiweb\WebDeveloper\Factories\ProductFactory;

function createProduct($requestData) {
    try {

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
        echo json_encode(['status' => 'success', 'message' => 'Product created successfully']);

    }catch(Exception $e) {
        http_response_code(500);

        echo json_encode(['error' => 'Database error: ' . str_starts_with($e->getMessage(), 'SQLSTATE[23000]') ? 'Duplicate SKU, It must be unique': "Cannot connect to server"]);
    }
}

function getProductsSortedByType() {
    $pdo = DatabaseConnection::getConnection();
    $sql = "SELECT * FROM products ORDER BY FIELD(category, 'DVD', 'Book', 'Furniture')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function massDelete($data) {
    if (!is_array($data) || empty($data)) {
        throw new InvalidArgumentException('Invalid data provided for deletion.');
    }

    $pdo = DatabaseConnection::getConnection();

    $placeholders = rtrim(str_repeat('?, ', count($data)), ', ');
    $sql = "DELETE FROM products WHERE id IN ($placeholders)";

    $stmt = $pdo->prepare($sql);

    $result = $stmt->execute($data);

    if ($result) {
        return $stmt->rowCount(); // Return the number of rows affected
    } else {
        throw new Exception('Failed to execute mass delete.');
    }
}
