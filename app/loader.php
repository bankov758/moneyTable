<?php

const BASE_PATH = __DIR__ . '/../';//root project folder

function base_path($path): string
{
    return BASE_PATH . $path;
}

spl_autoload_register(function ($class) {//automatically triggered by PHP when trying to access a class
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);//replace \ with / since $class returns the namespace

    require base_path("{$class}.php");});