<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

ob_start();
session_start();

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Global variables
 * */
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
$router->add('logout', ['controller' => 'UserController', 'action' => 'logout']);
$router->add('geolocation', ['controller' => 'GeolocationController', 'action' => 'update']);
$router->add('sport', ['controller' => 'SportController', 'action' => 'index']);
$router->add('list_of_losers', ['controller' => 'SportController', 'action' => 'list']);
$router->add('{controller}/{action}');
    
$router->dispatch($_SERVER['QUERY_STRING']);
