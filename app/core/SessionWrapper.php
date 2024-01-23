<?php

namespace app\core;

class SessionWrapper
{
    public const FLASH = 'flash';

    public static function getFlashed($key)
    {
        return $_SESSION[self::FLASH][$key] ?? '';
    }

    public static function put($key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function flash($key, $value): void
    {
        $_SESSION[self::FLASH][$key] = $value;
    }

    public static function unflash(): void
    {
        unset($_SESSION[self::FLASH]);
    }

    public static function getLoggedInUserId(): int
    {
        return $_SESSION['user_id'];
    }

    public static function isLogged(): int
    {
        return isset($_SESSION['user_id']);
    }

}