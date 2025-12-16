<?php
$currentPage ??= '';
$pageTitle ??= 'Engels811 Network';
?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<header>
    <div class="navbar">
        <a class="logo" href="/">🐺 <span>Engels811</span> Network</a>
        <nav class="nav-links">
            <a href="/" class="<?= $currentPage === 'home' ? 'active' : '' ?>">Home</a>
            <a href="/gallery" class="<?= $currentPage === 'gallery' ? 'active' : '' ?>">Galerie</a>
            <a href="/videos" class="<?= $currentPage === 'videos' ? 'active' : '' ?>">Videos</a>
            <a href="/playlists" class="<?= $currentPage === 'playlists' ? 'active' : '' ?>">Playlists</a>
            <a href="/hardware" class="<?= $currentPage === 'hardware' ? 'active' : '' ?>">Hardware</a>
            <a href="/live" class="<?= $currentPage === 'live' ? 'active' : '' ?>">Live</a>
            <a href="/about" class="<?= $currentPage === 'about' ? 'active' : '' ?>">About</a>
            <a href="/partner" class="<?= $currentPage === 'partner' ? 'active' : '' ?>">Partner</a>
        </nav>
        <button class="mobile-toggle">☰</button>
    </div>
</header>
<main>
