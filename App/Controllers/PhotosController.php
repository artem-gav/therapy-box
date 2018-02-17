<?php namespace App\Controllers;

use \Core\View;
use App\Models\Photo;
use \App\Services\{FileFactory, RouteFactory};

class PhotosController extends \Core\Controller
{
    public function indexAction($params = []) {
        $photos = Photo::getAll();

        $params['photos'] = $photos;

        View::renderTemplate('Photos/photos.html', $params);
    }

    public function createAction() {
        $photo = $_FILES['photo'];

        if(empty($photo)) {
            return RouteFactory::redirect('/photos');
        }

        $file = new FileFactory(PUBLIC_FOLDER . '/upload/photos/');
        $file->save($photo);
        $data['photo'] = '/upload/photos/' . $file->getName();

        Photo::create($data);

        RouteFactory::redirect('/photos');
    }
}
