<?php

use App\SessionWrapper;

function old($key)
{
    return SessionWrapper::getFlashed($key) ?? '';
}

function sumValues(array $transactions)
{
     foreach ($transactions)
}