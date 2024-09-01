<?php
require_once __DIR__ .'/../vendor/autoload.php';

use Scandiweb\WebDeveloper\Controllers\ProductController;
use Scandiweb\WebDeveloper\Core\Router;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-type: application/json; charset: UTF-8");
header("Access-Control-Allow-Credentials: true");

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];
$productController = new ProductController();
$router = new Router();


$router->addRoute('/', 'GET', function ()
{
    echo json_encode(['status' => 'success', 'message' => 'Server is running...']);
});

$router->addRoute('/create-product', 'POST', function () use ($productController)
{
    $requestData = json_decode(file_get_contents('php://input'), true);
    if ($requestData) {
        $productController->createProduct($requestData);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
    }
});


$router->addRoute('/get-products', 'GET', function () use ($productController)
{
    $products = $productController->getProductsSortedByType();
    echo json_encode($products);
});

$router->addRoute('/delete-products', 'POST', function () use ($productController)
{
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data) {
        $productController->massDelete($data);
        echo json_encode(['status' => 'success', 'message' => 'Products deleted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
    }
});

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);