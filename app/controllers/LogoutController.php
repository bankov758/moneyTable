<?php

namespace app\controllers;

use JetBrains\PhpStorm\NoReturn;

class LogoutController
{
    #[NoReturn] public function logout(): void
    {
        session_destroy(); //unsets all session variables
        header('location: /login');
        exit();
    }
}