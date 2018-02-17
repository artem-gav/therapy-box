<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Services\{FileFactory, RouteFactory};

class UserController extends \Core\Controller
{
    public function loginAction($params = [])
    {
        View::renderTemplate('User/login.html', $params);
    }

    public function loginPostAction() {
        $data = $_POST;
        $error = null;

        if(empty($data['login']) || empty($data['password'])) {
            $error = 'Not all parameters have been transferred';
        } elseif(!User::auth($data['login'], $data['password'])) {
            $error = 'Incorrect login or password';
        }

        if(!empty($error)) {
            return $this->loginAction([
                'error' => $error,
                'form' => $data,
            ]);
        }

        $_SESSION['login'] = $data['login'];
        $_SESSION['password'] = $data['password'];

        RouteFactory::redirect('/');
    }

    public function registerAction($params = []) {
        View::renderTemplate('User/register.html', $params);
    }

    public function registerPostAction() {
        try {
            $data = $_POST;
            $data['picture'] = $_FILES['picture'];

            if(empty($data['login']) ||
                empty($data['password']) ||
                empty($data['confirm_password']) ||
                empty($data['email']) ||
                empty($data['picture'])) {
                throw new \Exception('Not all parameters have been transferred');
            } elseif($data['password'] !== $data['confirm_password']) {
                throw new \Exception('Confirmation password differs from password');
            }

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

    public function logout() {
        unset($_SESSION["login"]);
        unset($_SESSION["password"]);

        RouteFactory::redirect('/');
    }
}
