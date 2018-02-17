<?php namespace App\Services;

use Cmfcmf\OpenWeatherMap;

class WeatherFactory {
    protected $query;
    protected $lang = 'en';

    function __construct($query = null) {
        if($query === null) {
            $this->query = [
                'lat' => 51.509865,
                'lon' => -0.118092
            ];
        } else {
            $this->query = $query;
        }
    }

    function setLang($lang) {
        $this->lang = $lang;
    }

    public function get() {
        $owm = new OpenWeatherMap(getenv('OPENWEATHERMAP'));
        $weather = $owm->getWeather($this->query, getenv('OPENWEATHERMAP_UNITS'), $this->lang);

        return [
            'city' => $weather->city->name,
            'temperature' => $weather->temperature->now->getValue(),
        ];
    }
}