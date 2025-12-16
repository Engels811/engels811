<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

final class PartnerController extends Controller
{
    public function index(): void
    {
        $this->view('partner/index', [
            'pageTitle' => 'Partner & Sponsoren',
            'currentPage' => 'partner',
        ]);
    }
}
