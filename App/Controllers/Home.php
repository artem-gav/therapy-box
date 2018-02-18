<?php

namespace App\Controllers;

use \Core\View;
use App\Services\{WeatherFactory, FeedFactory, FootballCsvFactory};
use App\Models\{Photo, Task};

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
        $params['football'] = (new FootballCsvFactory(PUBLIC_FOLDER .  '/assets/csv/I1.csv'))->biggestShotsOnTarget();
        $params['photos'] = Photo::getAll(4);
        $params['tasks'] = Task::getAll(3);

        View::renderTemplate('Home/index.html', $params);
    }
}
