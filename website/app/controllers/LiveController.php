<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

final class LiveController extends Controller
{
    public function index(): void
    {
        $this->view('live/index', [
            'pageTitle' => 'Live auf Twitch',
            'currentPage' => 'live',
        ]);
    }
}
