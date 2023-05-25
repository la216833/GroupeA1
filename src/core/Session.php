<?php

namespace CashRegister\core;

class Session {

    protected const FLASH_KEY = 'flash';
    protected const USER_KEY = 'user';

    public function __construct() {
        session_start();
        $flashs = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashs as $key => &$flash)
            $flash['remove'] = true;

        $_SESSION[self::FLASH_KEY] = $flashs;
    }

    public function __deconstruct(): void {
        $flashs = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashs as $key => &$flash)
            if ($flash['remove']) unset($flashs[$key]);

        $_SESSION[self::FLASH_KEY] = $flashs;
    }

    public function get(string $key): string | bool {
        return $_SESSION[$key] ?? false;
    }

    public function set(string $key, $value): void {
        $_SESSION[$key] = $value;
    }

    public function remove(string $key): void {
        unset($_SESSION[$key]);
    }

    public function getFlash(string $key): string|bool {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    public function setFlash(string $key, string $message): void {
        $_SESSION[self::FLASH_KEY][$key] = ['remove' => false,  'value' => $message];
    }
}