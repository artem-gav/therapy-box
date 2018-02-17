<?php namespace App\Services;

class RouteFactory {
    public static function redirect($to) {
        header( 'Location: ' . $to);
    }
}