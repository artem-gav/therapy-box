<?php namespace App\Controllers;

class GeolocationController extends \Core\Controller
{
    public function updateAction() {
        $location = $_POST;

        $_SESSION['coordinates'] = [
            'lat' => $location['latitude'],
            'lon' => $location['longitude'],
        ];
    }
}
