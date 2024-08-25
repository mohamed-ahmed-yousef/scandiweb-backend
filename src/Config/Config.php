<?php

namespace Scandiweb\WebDeveloper\Config;

use Dotenv\Dotenv;

require_once '../../vendor/autoload.php';

class Config
{
    private static $dotenvLoaded = false;

    public static function loadEnv()
    {
        if (!self::$dotenvLoaded) {
            $dotenv = Dotenv::createImmutable(__DIR__);
            $dotenv->load();
            self::$dotenvLoaded = true;
        }
    }

    public static function getEnv($key)
    {
        self::loadEnv();
        return isset($_ENV[$key]) ? $_ENV[$key] : null;
    }
}
