<?php

namespace App\Controllers;

use \Core\View;
use App\Services\WeatherFactory;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controller
{
    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $params = [];

        if($_SESSION) {
            $params['login'] = $_SESSION['login'];
        }

        $params['weather'] = (new WeatherFactory('Berlin'))->get();

        View::renderTemplate('Home/index.html', $params);
    }
}
