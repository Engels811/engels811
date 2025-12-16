<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= htmlspecialchars($pageTitle ?? 'Engels811 Network') ?> – Engels811
    </title>

    <meta name="description"
          content="<?= htmlspecialchars($pageDescription ?? 'Engels811 - Gaming, Streaming, Community') ?>">

    <link rel="stylesheet" href="/assets/css/style.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico">
</head>

<body>

<header>
    <div class="header-container">

        <!-- Logo -->
        <a href="/" class="logo">
            <img src="/assets/images/logo.png"
                 alt="Engels811 Logo"
                 class="logo-image">

            <div class="logo-text">
                <h1>Engels811</h1>
                <p>Network</p>
            </div>
        </a>

        <!-- Navigation -->
        <nav id="mainNav">
            <ul>
                <li><a href="/" class="<?= ($currentPage ?? '') === 'home' ? 'active' : '' ?>">Home</a></li>
                <li><a href="/gallery" class="<?= ($currentPage ?? '') === 'gallery' ? 'active' : '' ?>">Galerie</a></li>
                <li><a href="/videos" class="<?= ($currentPage ?? '') === 'videos' ? 'active' : '' ?>">Videos</a></li>
                <li><a href="/playlists" class="<?= ($currentPage ?? '') === 'playlists' ? 'active' : '' ?>">Playlisten</a></li>
                <li><a href="/hardware" class="<?= ($currentPage ?? '') === 'hardware' ? 'active' : '' ?>">Hardware</a></li>
                <li><a href="/partner" class="<?= ($currentPage ?? '') === 'partner' ? 'active' : '' ?>">Partner</a></li>
                <li><a href="/live" class="<?= ($currentPage ?? '') === 'live' ? 'active' : '' ?>">🔴 Live</a></li>
                <li><a href="/about" class="<?= ($currentPage ?? '') === 'about' ? 'active' : '' ?>">About</a></li>
            </ul>
        </nav>

        <!-- Mobile -->
        <button class="mobile-toggle"
                aria-label="Menü öffnen"
                onclick="toggleMobileMenu()">☰</button>

    </div>
</header>

<main>
