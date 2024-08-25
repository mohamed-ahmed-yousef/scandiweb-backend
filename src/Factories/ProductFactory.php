<?php
namespace Scandiweb\WebDeveloper\Factories;

use Exception;
use Scandiweb\WebDeveloper\Models\Book;
use Scandiweb\WebDeveloper\Models\DVD;
use Scandiweb\WebDeveloper\Models\Furniture;

class ProductFactory {

    public static function createProduct($category, $data) {
        switch ($category) {
            case 'DVD':
                return new DVD($data['sku'], $data['name'], $data['price'], $data['size']);
            case 'Book':
                return new Book($data['sku'], $data['name'], $data['price'], $data['weight']);
            case 'Furniture':
                return new Furniture($data['sku'], $data['name'], $data['price'], $data['height'], $data['width'], $data['length']);
            default:
                throw new Exception("Invalid product category");
        }
    }
}
