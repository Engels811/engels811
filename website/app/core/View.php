<?php

declare(strict_types=1);

namespace App\Core;

final class View
{
    public static function render(string $view, array $data = []): void
    {
        extract($data, EXTR_OVERWRITE);
        $viewFile = __DIR__.'/../views/'.$view.'.php';

        $header = __DIR__.'/../views/layouts/header.php';
        $footer = __DIR__.'/../views/layouts/footer.php';

        if (!file_exists($viewFile)) {
            http_response_code(404);
            $viewFile = __DIR__.'/../views/errors/404.php';
        }

        require $header;
        require $viewFile;
        require $footer;
    }
}
