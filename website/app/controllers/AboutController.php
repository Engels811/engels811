<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

final class AboutController extends Controller
{
    public function index(): void
    {
        $this->view('about/index', [
            'pageTitle' => 'Über Engels811',
            'currentPage' => 'about',
        ]);
    }
}
