<?php

namespace Scandiweb\WebDeveloper\Models;

use PDO;
use PDOException;
use Scandiweb\WebDeveloper\Config\Config;

$config = new Config();
echo $config->getEnv('DB_HOST');

class Database {
    private $host;
    private $dbName;
    private $username;
    private $password;
    private $pdo;
    private $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    public function __construct() {
        $config = new Config();
        $this->host = $config->getEnv('DB_HOST');
        $this->dbName = $config->getEnv('DB_NAME');
        $this->username = $config->getEnv('DB_USER');
        $this->password = $config->getEnv('DB_PASSWORD');
        $this->connect();
    }

    private function connect() {
        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
            $this->pdo = new PDO($dsn, $this->username, $this->password, $this->options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
