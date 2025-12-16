<section class="hero">
    <div class="container">
        <span class="badge">Gaming & Streaming</span>
        <h1>Engels811 Network</h1>
        <p>AI-generierte Logos, Twitch Streams, YouTube Videos und eine starke Discord Community.</p>
        <div style="margin-top:1.5rem; display:flex; gap:1rem; flex-wrap:wrap;">
            <a class="btn" href="/live">Jetzt Live</a>
            <a class="btn" href="/gallery" style="background:rgba(255,48,80,0.1);color:var(--primary);box-shadow:none;border:1px solid rgba(255,48,80,0.3);">Galerie ansehen</a>
        </div>
    </div>
</section>

<div class="container" id="stats" data-images="<?= $stats['images'] ?? 0 ?>" data-videos="<?= $stats['videos'] ?? 0 ?>" data-members="<?= $stats['members'] ?? 0 ?>" data-tickets="<?= $stats['tickets'] ?? 0 ?>">
    <div class="section-title">Community Stats</div>
    <div class="stats">
        <div class="stat-card" data-stat="images"><strong>0</strong><span>AI Logos</span></div>
        <div class="stat-card" data-stat="videos"><strong>0</strong><span>YouTube Videos</span></div>
        <div class="stat-card" data-stat="members"><strong>0</strong><span>Discord Mitglieder</span></div>
        <div class="stat-card" data-stat="tickets"><strong>0</strong><span>Tickets gelöst</span></div>
    </div>
</div>

<div class="container">
    <div class="section-title">Featured Logos <a href="/gallery">Alle ansehen →</a></div>
    <div class="gallery-grid" id="featured-images"></div>
</div>

<div class="container">
    <div class="section-title">Neueste Videos <a href="/videos">Zu YouTube →</a></div>
    <div class="grid grid-cols-3" id="latest-videos"></div>
</div>

<script type="module" src="/assets/js/home.js"></script>
