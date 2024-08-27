<?php
namespace Scandiweb\WebDeveloper\Database;

require_once __DIR__ . '/../../Config.php';
use Scandiweb\WebDeveloper\Config\Config;
use PDO;
use PDOException;

class  DatabaseConnection {
    private static $connection = null;

    public static function getConnection() {
        if (self::$connection === null) {
            $config = new Config();
            $dsn = 'mysql:host='. $config->getEnv('DB_HOST') .  ';dbname=' . $config->getEnv('DB_NAME') . ';charset=utf8';
            $username = $config->getEnv('DB_USERNAME');
            $password = $config->getEnv('DB_PASSWORD');

            try {
                self::$connection = new PDO($dsn, $username, $password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
