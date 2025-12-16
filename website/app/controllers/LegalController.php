<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

final class LegalController extends Controller
{
    public function impressum(): void
    {
        $this->view('legal/impressum', [
            'pageTitle' => 'Impressum',
            'currentPage' => 'impressum',
        ]);
    }

    public function datenschutz(): void
    {
        $this->view('legal/datenschutz', [
            'pageTitle' => 'Datenschutz',
            'currentPage' => 'datenschutz',
        ]);
    }

    public function agb(): void
    {
        $this->view('legal/agb', [
            'pageTitle' => 'Allgemeine Geschäftsbedingungen',
            'currentPage' => 'agb',
        ]);
    }
}
