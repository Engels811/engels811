<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

final class GalleryController extends Controller
{
    public function index(): void
    {
        $this->view('gallery/index', [
            'pageTitle' => 'AI Logo Galerie',
            'currentPage' => 'gallery',
        ]);
    }
}
