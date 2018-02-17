<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';

define('PROJECT_ROOT', dirname(__DIR__));
define('PUBLIC_FOLDER', PROJECT_ROOT . '/public');

/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
 * Dotenv
 * */
$dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();

/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('login', ['controller' => 'UserController', 'action' => 'login']);
$router->add('login_post', ['controller' => 'UserController', 'action' => 'loginPost']);
$router->add('register', ['controller' => 'UserController', 'action' => 'register']);
$router->add('register_post', ['controller' => 'UserController', 'action' => 'registerPost']);
$router->add('{controller}/{action}');
    
$router->dispatch($_SERVER['QUERY_STRING']);
