<?php
namespace Scandiweb\WebDeveloper\Config;

require_once __DIR__ .'/vendor/autoload.php';
use Dotenv\Dotenv;

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
