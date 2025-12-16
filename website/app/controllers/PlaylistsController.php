<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

final class PlaylistsController extends Controller
{
    public function index(): void
    {
        $this->view('playlists/index', [
            'pageTitle' => 'Spotify Playlists',
            'currentPage' => 'playlists',
        ]);
    }
}
