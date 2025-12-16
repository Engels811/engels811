<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

final class VideosController extends Controller
{
    public function index(): void
    {
        $this->view('videos/index', [
            'pageTitle' => 'YouTube Videos',
            'currentPage' => 'videos',
        ]);
    }
}
