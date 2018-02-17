<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

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
}
