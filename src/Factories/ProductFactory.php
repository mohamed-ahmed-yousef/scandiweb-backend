<?php
namespace Scandiweb\WebDeveloper\Factories;

use Exception;
use Scandiweb\WebDeveloper\Models\Book;
use Scandiweb\WebDeveloper\Models\DVD;
use Scandiweb\WebDeveloper\Models\Furniture;

class ProductFactory
{
    private static $productMap = [
        'DVD' => DVD::class,
        'Book' => Book::class,
        'Furniture' => Furniture::class,
    ];

    public static function createProduct($category, $data)
    {
        if (!array_key_exists($category, self::$productMap)) {
            throw new Exception('Invalid category');
        }

        $className = self::$productMap[$category];
        $reflection = new \ReflectionClass($className);

        $constructor = $reflection->getConstructor();
        $parameters = $constructor ? $constructor->getParameters() : [];

        $args = [];
        foreach ($parameters as $param) {
            $paramName = $param->getName();
            $args[] = isset($data[$paramName]) ? $data[$paramName] : null;
        }

        return $reflection->newInstanceArgs($args);
    }
}
