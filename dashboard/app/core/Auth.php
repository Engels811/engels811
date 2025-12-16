<?php

class Auth
{
    public static function check(): bool
    {
        return isset($_SESSION['dashboard_user']);
    }

    public static function requireLogin(): void
    {
        if (!self::check()) {
            header('Location: /dashboard/login');
            exit;
        }
    }

    public static function login(string $username): void
    {
        $_SESSION['dashboard_user'] = [
            'username' => $username,
            'login_at' => time()
        ];
    }

    public static function logout(): void
    {
        unset($_SESSION['dashboard_user']);
        session_destroy();
    }
}
