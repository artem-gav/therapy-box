<?php namespace App\Controllers;

use \Core\View;
use App\Services\FootballCsvFactory;

class SportController extends \Core\Controller
{
    public function indexAction() {
        View::renderTemplate('Sport/sport.html');
    }

    public function list() {
        if(!$_POST || empty($_POST['command'])) {
            return null;
        }
        
        $list_of_losers = (new FootballCsvFactory(PUBLIC_FOLDER .  '/assets/csv/I1.csv'))->listOfLosers($_POST['command']);

        header('Content-Type: application/json');
        echo json_encode($list_of_losers);
    }
}
