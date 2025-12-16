<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Engels811 Network'; ?> - Engels811</title>
    <meta name="description" content="<?php echo $pageDescription ?? 'Engels811 - Gaming, Streaming, Community'; ?>">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico">
</head>
<body>
    <header>
        <div class="header-container">
        <a href="/" class="logo">
            <img src="/assets/images/logo.png" alt="Engels811 Logo" class="logo-image">

            <div class="logo-text">
                <h1>Engels811</h1>
                <p>Network</p>
            </div>
        </a>
            
            <nav id="mainNav">
                <ul>
                    <li><a href="/" class="<?php echo ($currentPage ?? '') == 'home' ? 'active' : ''; ?>">Home</a></li>
                    <li><a href="/gallery.php" class="<?php echo ($currentPage ?? '') == 'gallery' ? 'active' : ''; ?>">Galerie</a></li>
                    <li><a href="/videos.php" class="<?php echo ($currentPage ?? '') == 'videos' ? 'active' : ''; ?>">Videos</a></li>
                    <li><a href="/playlists.php" class="<?php echo ($currentPage ?? '') == 'playlists' ? 'active' : ''; ?>">Playlisten</a></li>
                    <li><a href="/hardware.php" class="<?php echo ($currentPage ?? '') == 'hardware' ? 'active' : ''; ?>">Hardware</a></li>
                    <li><a href="/live.php" class="<?php echo ($currentPage ?? '') == 'live' ? 'active' : ''; ?>">🔴 Live</a></li>
                    <li><a href="/about.php" class="<?php echo ($currentPage ?? '') == 'about' ? 'active' : ''; ?>">About</a></li>
                </ul>
            </nav>
            
            <button class="mobile-toggle" onclick="toggleMobileMenu()">☰</button>
        </div>
    </header>
