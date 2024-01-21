<?php

namespace App;

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
        $_SESSION[self::FLASH] = null;
    }
}