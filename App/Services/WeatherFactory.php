<?php namespace App\Services;

use Cmfcmf\OpenWeatherMap;

class WeatherFactory {
    protected $city;
    protected $lang = 'en';

    function __construct($city) {
        $this->city = $city;
    }

    function setLang($lang) {
        $this->lang = $lang;
    }

    public function get() {
        $owm = new OpenWeatherMap(getenv('OPENWEATHERMAP'));
        $weather = $owm->getWeather($this->city, getenv('OPENWEATHERMAP_UNITS'), $this->lang);

        return [
            'city' => $weather->city->name,
            'temperature' => $weather->temperature->now->getValue(),
        ];
    }
}