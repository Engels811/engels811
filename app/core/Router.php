<?php

class Router
{
    public static function dispatch(): void
    {
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        // 🔥 ÖFFENTLICHE STARTSEITE
        if ($uri === '' || $uri === '/') {
            (new HomeController())->index();
            return;
        }

        http_response_code(404);
        echo 'Seite nicht gefunden';
    }
}
