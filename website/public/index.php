<?php

declare(strict_types=1);

use App\Core\{App, Router};

require_once __DIR__.'/../config/config.php';

spl_autoload_register(static function (string $class): void {
    $prefix = 'App\\';
    $baseDir = __DIR__.'/../app/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relativeClass = substr($class, $len);
    $file = $baseDir.str_replace('\\', '/', $relativeClass).'.php';
    if (file_exists($file)) {
        require $file;
    }
});

$router = new Router();
$app = new App($router);
$app->run();
