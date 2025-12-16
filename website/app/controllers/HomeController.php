<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Services\StatsService;

final class HomeController extends Controller
{
    public function index(): void
    {
        $stats = (new StatsService())->getSummary();
        $this->view('home/index', [
            'pageTitle' => 'Engels811 Network',
            'currentPage' => 'home',
            'stats' => $stats,
        ]);
    }
}
