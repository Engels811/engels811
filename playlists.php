<?php
$pageTitle = 'Playlisten';
$pageDescription = 'Spotify und YouTube Playlisten von Engels811';
$currentPage = 'playlists';
include __DIR__ . '/includes/header.php';
?>

<section class="hero" style="padding: 2rem;">
    <div class="hero-container">
        <h1>🎵 Playlisten</h1>
        <p>Meine Lieblings-Playlists für Gaming & Streaming</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="section-title">🎧 Spotify <span>Playlists</span></h2>
        <div class="grid grid-2">
            <div class="card">
                <h3>🎮 Gaming Vibes</h3>
                <p>Die perfekte Musik fürs Gaming</p>
                <iframe 
                    style="border-radius:12px; margin-top: 1rem;" 
                    src="https://open.spotify.com/embed/playlist/37i9dQZF1DX4JAvHpjipBk?utm_source=generator" 
                    width="100%" 
                    height="352" 
                    frameBorder="0" 
                    allowfullscreen="" 
                    allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" 
                    loading="lazy">
                </iframe>
            </div>
            
            <div class="card">
                <h3>🔥 Hype Tracks</h3>
                <p>Energiegeladen und motivierend</p>
                <iframe 
                    style="border-radius:12px; margin-top: 1rem;" 
                    src="https://open.spotify.com/embed/playlist/37i9dQZF1DWZd79rJ6a7lp?utm_source=generator" 
                    width="100%" 
                    height="352" 
                    frameBorder="0" 
                    allowfullscreen="" 
                    allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" 
                    loading="lazy">
                </iframe>
            </div>
            
            <div class="card">
                <h3>🌙 Chill Sessions</h3>
                <p>Entspannte Beats zum Chillen</p>
                <iframe 
                    style="border-radius:12px; margin-top: 1rem;" 
                    src="https://open.spotify.com/embed/playlist/37i9dQZF1DX4WYpdgoIcn6?utm_source=generator" 
                    width="100%" 
                    height="352" 
                    frameBorder="0" 
                    allowfullscreen="" 
                    allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" 
                    loading="lazy">
                </iframe>
            </div>
            
            <div class="card">
                <h3>⚡ Speedrun Mode</h3>
                <p>Schnell, schneller, Speedrun!</p>
                <iframe 
                    style="border-radius:12px; margin-top: 1rem;" 
                    src="https://open.spotify.com/embed/playlist/37i9dQZF1DX76Wlfdnj7AP?utm_source=generator" 
                    width="100%" 
                    height="352" 
                    frameBorder="0" 
                    allowfullscreen="" 
                    allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
</section>

<section class="section" style="background: rgba(255, 48, 80, 0.02);">
    <div class="container">
        <h2 class="section-title">📺 YouTube <span>Music</span></h2>
        <div class="grid grid-3">
            <div class="card">
                <h3>🎸 Rock Anthems</h3>
                <p>Die besten Rock-Songs</p>
                <a href="https://music.youtube.com" target="_blank" class="btn btn-primary" style="margin-top: 1rem;">
                    ▶️ Anhören
                </a>
            </div>
            
            <div class="card">
                <h3>🎹 Electronic Beats</h3>
                <p>EDM, House, Techno</p>
                <a href="https://music.youtube.com" target="_blank" class="btn btn-primary" style="margin-top: 1rem;">
                    ▶️ Anhören
                </a>
            </div>
            
            <div class="card">
                <h3>🎤 Stream Favorites</h3>
                <p>Die meist gespielten Songs</p>
                <a href="https://music.youtube.com" target="_blank" class="btn btn-primary" style="margin-top: 1rem;">
                    ▶️ Anhören
                </a>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
