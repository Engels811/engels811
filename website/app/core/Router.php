<?php

declare(strict_types=1);

namespace App\Core;

use App\Controllers\{HomeController, GalleryController, VideosController, PlaylistsController, HardwareController, LiveController, AboutController, PartnerController, LegalController};

final class Router
{
    /** @var array<string, array{class: string, method: string}> */
    private array $routes = [];

    public function __construct()
    {
        $this->register('GET', '/', HomeController::class, 'index');
        $this->register('GET', '/gallery', GalleryController::class, 'index');
        $this->register('GET', '/videos', VideosController::class, 'index');
        $this->register('GET', '/playlists', PlaylistsController::class, 'index');
        $this->register('GET', '/hardware', HardwareController::class, 'index');
        $this->register('GET', '/live', LiveController::class, 'index');
        $this->register('GET', '/about', AboutController::class, 'index');
        $this->register('GET', '/partner', PartnerController::class, 'index');
        $this->register('GET', '/impressum', LegalController::class, 'impressum');
        $this->register('GET', '/datenschutz', LegalController::class, 'datenschutz');
        $this->register('GET', '/agb', LegalController::class, 'agb');
    }

    private function normalize(string $uri): string
    {
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';
        return rtrim($path, '/') ?: '/';
    }

    public function register(string $method, string $path, string $controller, string $action): void
    {
        $key = strtoupper($method).' '.$this->normalize($path);
        $this->routes[$key] = ['class' => $controller, 'method' => $action];
    }

    public function dispatch(string $uri): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $key = strtoupper($method).' '.$this->normalize($uri);
        if (!isset($this->routes[$key])) {
            http_response_code(404);
            View::render('errors/404', ['pageTitle' => 'Seite nicht gefunden', 'currentPage' => '404']);
            return;
        }

        $route = $this->routes[$key];
        $controllerName = $route['class'];
        $action = $route['method'];

        $controller = new $controllerName();
        if (!method_exists($controller, $action)) {
            http_response_code(500);
            View::render('errors/404', ['pageTitle' => 'Fehler', 'currentPage' => '404']);
            return;
        }

        $controller->$action();
    }
}
