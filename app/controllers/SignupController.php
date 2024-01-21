<?php

namespace app\controllers;

use app\models\User;
use app\View;
use Exception;
use JetBrains\PhpStorm\NoReturn;

class SignupController
{

    /**
     * @throws Exception
     */
    public function register(): string
    {
        return View::make('signup');
    }

    public function storeRegister()
    {
        $userModel = new User();
        $data = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'confirmPassword' => $_POST['confirmPassword']
        ];
        if (!$userModel->validateSignup($data)) {
            return View::make('signup', ['errors' => $userModel->getErrors()]);
        }
        $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $userModel->create($_POST['email'], $_POST['username'], $passwordHash);
        header('location: /login');
        exit();
    }

}