<?php

namespace App;

class SessionWrapper
{
    public static function getFlashed($key)
    {
        return $_SESSION['flash'][$key] ?? '';

    }

    public static function put($key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function flash($key, $value): void
    {
        $_SESSION['flash'][$key] = $value;
    }

    public static function unflash(): void
    {
        unset($_SESSION['flash']);
        $_SESSION['flash'] = null;
    }
}