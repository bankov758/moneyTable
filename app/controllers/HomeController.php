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
        if (!isset($_SESSION['user_id'])) {
            header('location: /login');
            exit();
        }
        $transactionModel = new Transaction();
        $transactions = $transactionModel->findAll(SessionWrapper::getLoggedInUserId());
        return View::make('index', ['transactions' => $transactions]);
    }
}