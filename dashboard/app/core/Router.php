<?php

class Router
{
    public static function dispatch(): void
    {
        $path = trim(str_replace('/dashboard', '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)), '/');

        if ($path === '' || $path === '/') {
            (new DashboardController())->index();
            return;
        }

        if ($path === 'login') {
            (new AuthController())->login();
            return;
        }

        if ($path === 'logout') {
            (new AuthController())->logout();
            return;
        }

        http_response_code(404);
        echo 'Dashboard – Seite nicht gefunden';
    }
}
