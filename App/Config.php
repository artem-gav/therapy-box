<?php

namespace App;

/**
 * Application configuration
 *
 * PHP version 7.0
 */
class Config
{
    public static function get() {
        return [
            'DB_HOST' => getenv('DB_HOST'),
            'DB_DATABASE' => getenv('DB_DATABASE'),
            'DB_USERNAME' => getenv('DB_USERNAME'),
            'DB_PASSWORD' => getenv('DB_PASSWORD'),
            'SHOW_ERRORS' => getenv('SHOW_ERRORS'),
        ];
    }
}
