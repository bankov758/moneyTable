<?php

namespace app\controllers;

use app\models\Transaction;
use app\models\SignUp;
use app\models\User;
use app\View;
use Exception;

class HomeController
{
    /**
     * @throws Exception
     */
    public function index(): string
    {
        if (!isset($_SESSION['user_id'])) {
            header('location: /login');
            exit();
        }
        $transactionModel = new Transaction();
        $transactions = $transactionModel->findAll($_SESSION['user_id']);
        return View::make('cheatsheet', ['transactions' => $transactions]);
    }
}