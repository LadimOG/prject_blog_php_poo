<?php

namespace App\lib;

class SessionManager
{

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function getSession($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function setSession($key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function unsetSession($key): void
    {
        unset($_SESSION[$key]);
    }

    public function destroySession(): void
    {
        session_unset();
        session_destroy();
    }
}
