<?php namespace App\Controllers;

class GeolocationController extends \Core\Controller
{
    public function updateAction() {
        $location = $_POST;

        if(empty($location['latitude']) || empty($location['longitude'])) {
            return;
        }

        $_SESSION['coordinates'] = [
            'lat' => $location['latitude'],
            'lon' => $location['longitude'],
        ];
    }
}
