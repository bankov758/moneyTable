<?php

namespace app;

use app\core\SessionWrapper;

function old($key)
{
    return SessionWrapper::getFlashed($key) ?? '';
}

function sumValues(array $transactions)
{
    $sum = 0;
    foreach ($transactions as $transaction){
        $sum += $transaction['amount'];
    }
    return $sum;
}