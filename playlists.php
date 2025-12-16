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

<!-- ================================
     SPOTIFY PLAYLISTS
================================ -->
<section class="section">
    <div class="container">
        <h2 class="section-title">🎧 Spotify <span>Playlists</span></h2>

        <div class="grid grid-4" style="gap: 2rem;">
            <?php
            $spotifyEmbeds = [
                "https://open.spotify.com/embed/playlist/0aCuyhZKYsGMDFlf1Gl1ZP",
                "https://open.spotify.com/embed/album/5dYvBsBAlb373Bo9bck8vH",
                "https://open.spotify.com/embed/playlist/5lSB6Tkn3v1fbOggz8hLJt",
                "https://open.spotify.com/embed/playlist/5Ljxcqs03shs69gTmBJ7lb",
                "https://open.spotify.com/embed/playlist/3G6IXtgNm9UCDQVTo0KUJk",
                "https://open.spotify.com/embed/playlist/08U9xMmH4CEtoujNrs0mrs",
                "https://open.spotify.com/embed/playlist/1RSw7jsqqCdwCKrvt71mSA",
                "https://open.spotify.com/embed/playlist/2rMKdOPIYHWr2cglu2RV9l",
                "https://open.spotify.com/embed/playlist/79Y3adfVNUOdzrp8Hzh6hh",
                "https://open.spotify.com/embed/playlist/1ZL9gew20Gfw1w2Wgf0xKG",
                "https://open.spotify.com/embed/playlist/21GwZ5ROiianIAwwfqH8uw",
                "https://open.spotify.com/embed/playlist/3O7TvwLeCvuFHU36PsTJRZ",
                "https://open.spotify.com/embed/playlist/2I9wiTZ1taqQ5b6QuXSXJd",
                "https://open.spotify.com/embed/playlist/6VF5EWb7BjL3sqOSckcA9N",
                "https://open.spotify.com/embed/playlist/1Zd3MDR8Et4DHFKah3rFCP",
                "https://open.spotify.com/embed/playlist/2YR2hgzBqWs58h81WsPalk",
                "https://open.spotify.com/embed/playlist/7xMr6V00WmTLRzQUFVCx0B",
                "https://open.spotify.com/embed/playlist/37i9dQZF1DZ06evO26EUkO",
                "https://open.spotify.com/embed/playlist/1kXqI7yl6sWgrN8Mp2cufp",
                "https://open.spotify.com/embed/playlist/4mYT4MtDeamrWZDr56fT1A",
                "https://open.spotify.com/embed/playlist/2BvXXHZ3Hx4pS5OacZMVKc",
                "https://open.spotify.com/embed/playlist/2NdDBIGHUCu977yW5iKWQY",
                "https://open.spotify.com/embed/playlist/0XLImRDCVZb1IPeBK7iHtr",
                "https://open.spotify.com/embed/playlist/6jA0HQg4fX7ydh0D2gRsmY",
            ];

            foreach ($spotifyEmbeds as $embed): ?>
                <div class="card" style="padding: 0;">
                    <iframe
                        src="<?= $embed ?>?utm_source=generator"
                        width="100%"
                        height="352"
                        frameborder="0"
                        allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                        loading="lazy"
                        style="border-radius:12px;"
                    ></iframe>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ================================
     YOUTUBE MUSIC
================================ -->
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
