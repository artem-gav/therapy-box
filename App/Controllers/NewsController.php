<?php namespace App\Controllers;

use \Core\View;
use App\Services\FeedFactory;

class NewsController extends \Core\Controller
{
    public function indexAction() {
        $id = $this->route_params['id'];
        
        $params['rss'] = (new FeedFactory)->get()[$id];

        View::renderTemplate('News/news.html', $params);
    }
}
