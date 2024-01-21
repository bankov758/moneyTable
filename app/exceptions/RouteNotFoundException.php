<?php

declare(strict_types = 1);

namespace app\exceptions;

class RouteNotFoundException extends \Exception
{
    protected $message = '404 Not Found';
}