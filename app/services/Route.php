<?php namespace App\Services;

class Route {
    public function current_page() {
        $current_page = preg_replace('{^/}', '', $_SERVER['REQUEST_URI']);
        return !empty($current_page) ? $current_page : null;
    }

    public function link($to) {
        return $this->url() . '?p=' . $to;
    }

    private function url(){
        return sprintf(
            "%s://%s%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME'],
            $_SERVER['REQUEST_URI']
        );
    }
}