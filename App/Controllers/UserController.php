<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Services\{FileFactory, RouteFactory};

class UserController extends \Core\Controller
{
    public function loginAction()
    {
        View::renderTemplate('User/login.html');
    }

    public function loginPostAction() {
        echo "<pre>";
        print_r(User::getAll());
        die;
    }

    public function registerAction($params = []) {
        View::renderTemplate('User/register.html', $params);
    }

    public function registerPostAction() {
        try {
            $data = $_POST;
            $data['picture'] = $_FILES['picture'];

            User::createValidation($data);

            $file = new FileFactory(PUBLIC_FOLDER . '/upload/users/');
            $file->save($data['picture']);
            $data['picture'] = '/upload/users' . $file->getName();

            User::create($data);

            RouteFactory::redirect('/');
        } catch (\Exception $e) {
            $this->registerAction([
                'error' => $e->getMessage(),
                'form' => $_POST
            ]);
        }
    }
}
