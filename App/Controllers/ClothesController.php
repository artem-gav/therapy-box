<?php namespace App\Controllers;

use GuzzleHttp\Client;

class ClothesController extends \Core\Controller
{
    protected $client;

    function __construct() {
        $this->client = (new Client)->request('GET', getenv('CLOTHES_URL'));
    }

    public function postAction() {
        $data = \GuzzleHttp\json_decode($this->client->getBody());
        $data = $data->payload;

        $new_data = [];
        foreach ($data as $item) {
            $new_data[$item->clothe] = isset($new_data[$item->clothe]) ? $new_data[$item->clothe] + 1 : 1;
        }

        header('Content-Type: application/json');
        echo \GuzzleHttp\json_encode($new_data);
    }
}
