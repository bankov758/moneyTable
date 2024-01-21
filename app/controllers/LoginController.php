<?php

namespace app\controllers;

use app\core\SessionWrapper;
use app\core\View;
use app\models\User;

class LoginController
{
    public function login(): string
    {
        return View::make('login');
    }

    public function storeLogin()
    {
        $userModel = new User();
        $data = [
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ];
        if (!$userModel->validateLogin($data)) {
            SessionWrapper::flash('email', $data['email']);
            return View::make('login', ['errors' => $userModel->getErrors()]);
        }
        $user = $userModel->getByEmail($data['email']);
        SessionWrapper::put('user_id',  $user['id']);
        header('location: /');
        exit();
    }
}