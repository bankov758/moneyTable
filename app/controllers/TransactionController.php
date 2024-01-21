<?php

namespace app\controllers;

use app\core\SessionWrapper;
use app\models\Transaction;
use JetBrains\PhpStorm\NoReturn;

class TransactionController
{
    #[NoReturn] public function deleteTransaction(): void
    {
        $transactionModel = new Transaction();
        $data = [
            'transactionId' => $_POST['transactionId']
        ];
        $transactionModel->delete($data['transactionId']);
        header('location: /');
        exit();
    }

    #[NoReturn] public function createTransaction(): void
    {
        $transactionModel = new Transaction();
        $data = [
            'amount' => $_POST['amount'],
            'description' => $_POST['description'],
            'userId' => SessionWrapper::getLoggedInUserId()
        ];
        $transactionModel->create($data['amount'], $data['userId'], $data['description']);
        header('location: /');
        exit();
    }
}