<?php

namespace App\Controllers;

use \Core\View;
use App\Services\{WeatherFactory, FeedFactory};

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
        $coordinates = null;

        if($_SESSION && !empty($_SESSION['login'])) {
            $params['login'] = $_SESSION['login'];
        }

        if($_SESSION && !empty($_SESSION['coordinates'])) {
            $params['coordinates'] = $coordinates = $_SESSION['coordinates'];
        }

        $params['weather'] = (new WeatherFactory($coordinates))->get();
        $params['rss'] = (new FeedFactory)->get()[0];

        View::renderTemplate('Home/index.html', $params);
    }
}
