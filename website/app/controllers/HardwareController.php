<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

final class HardwareController extends Controller
{
    public function index(): void
    {
        $this->view('hardware/index', [
            'pageTitle' => 'Setup & Hardware',
            'currentPage' => 'hardware',
        ]);
    }
}
