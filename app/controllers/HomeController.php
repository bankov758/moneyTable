<?php

namespace app\controllers;

use app\core\SessionWrapper;
use app\core\View;
use app\models\Transaction;
use Exception;

class HomeController
{
    /**
     * @throws Exception
     */
    public function index(): string
    {
        if (!SessionWrapper::isLogged()) {
            header('location: /login'); //sending location header -> redirect
            exit();
        }
        $transactionModel = new Transaction();
        $transactions = $transactionModel->findAll(SessionWrapper::getLoggedInUserId());
        return View::make('index', ['transactions' => $transactions]);
    }
}