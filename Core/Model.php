<?php

namespace Core;

use PDO;
use App\Config;

/**
 * Base model
 *
 * PHP version 7.0
 */
abstract class Model
{

    /**
     * Get the PDO database connection
     *
     * @return mixed
     */
    protected static function getDB()
    {
        static $db = null;
        $config = Config::get();

        if ($db === null) {
            $dsn = 'mysql:host=' . $config['DB_HOST']. ';dbname=' . $config['DB_DATABASE']. ';charset=utf8';
            $db = new PDO($dsn, $config['DB_USERNAME'], $config['DB_PASSWORD']);

            // Throw an Exception when an error occurs
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $db;
    }
}
