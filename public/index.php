<?php
// public/index.php

require_once '../src/Controllers/ProductController.php';
require_once '../src/Database/DatabaseConnection.php';
require_once '../src/Factories/ProductFactory.php';
require_once '../src/Models/Product.php';
require_once '../src/Models/DVD.php';
require_once '../src/Models/Book.php';
require_once '../src/Models/Furniture.php';

// Basic routing logic
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];
echo $requestUri;
echo $requestMethod;

switch ($requestUri) {
    case '/create-product':
        if ($requestMethod === 'POST') {
            $requestData = json_decode(file_get_contents('php://input'), true);
            print_r($requestData);
            if ($requestData) {
                createProduct($requestData);
                echo json_encode(['status' => 'success', 'message' => 'Product created successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
            }
        } else {
            http_response_code(405); // Method Not Allowed
            echo json_encode(['status' => 'error', 'message' => 'Only POST method is allowed']);
        }
        break;

    case '/get-products':
        if ($requestMethod === 'GET') {
            $products = getProductsSortedByType();
            echo json_encode($products);
        } else {
            http_response_code(405); // Method Not Allowed
            echo json_encode(['status' => 'error', 'message' => 'Only GET method is allowed']);
        }
        break;

    case "/delete-products":
        if ($requestMethod === 'DELETE') {
            $data = json_decode(file_get_contents('php://input'), true);
            print_r($data);
            echo "<br/>" . "Mohamed yousef";
            if ($data) {
                massDelete($data);
                echo json_encode(['status' => 'success', 'message' => 'Products deleted successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
            }
        } else {
            http_response_code(405); // Method Not Allowed
            echo json_encode(['status' => 'error', 'message' => 'Only DELETE method is allowed']);
        }
        break;

    default:
        http_response_code(404); // Not Found
        echo json_encode(['status' => 'error', 'message' => 'Route not found']);
        break;
}
