<?php
$pageTitle = 'Home';
$pageDescription = 'Engels811 Network - Gaming, Streaming & Community';
$currentPage = 'home';
include __DIR__ . '/includes/header.php';
?>

<section class="hero">
    <div class="hero-container">
        <h1>🔥 Engels811 Network</h1>
        <p>Gaming • Streaming • Community • AI-Generated Art</p>
        <div class="hero-buttons">
            <a href="/live.php" class="btn btn-primary">🔴 Zum Stream</a>
            <a href="https://discord.gg/KfZRZ4WTnG" class="btn btn-secondary" target="_blank">💬 Discord beitreten</a>
        </div>
    </div>
</section>

<!-- Featured AI Images -->
<section class="section">
    <div class="container">
        <h2 class="section-title">🎨 Neueste <span>AI-Logos</span></h2>
        <div class="gallery-grid" id="featuredImages">
            <div class="loading">Lade Bilder</div>
        </div>
        <div style="text-align: center; margin-top: 2rem;">
            <a href="/gallery.php" class="btn btn-primary">Alle Bilder ansehen</a>
        </div>
    </div>
</section>

<!-- Latest Videos -->
<section class="section" style="background: rgba(255, 48, 80, 0.02);">
    <div class="container">
        <h2 class="section-title">🎥 Neueste <span>Videos</span></h2>
        <div class="video-grid" id="latestVideos">
            <div class="loading">Lade Videos</div>
        </div>
        <div style="text-align: center; margin-top: 2rem;">
            <a href="/videos.php" class="btn btn-primary">Alle Videos ansehen</a>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="section">
    <div class="container">
        <h2 class="section-title">📊 <span>Statistiken</span></h2>
        <div class="grid grid-4">
            <div class="card" style="text-align: center;">
                <div style="font-size: 3rem; color: var(--primary);">🎮</div>
                <h3 id="streamHours">Loading...</h3>
                <p>Stream-Stunden</p>
            </div>
            <div class="card" style="text-align: center;">
                <div style="font-size: 3rem; color: var(--primary);">👥</div>
                <h3 id="communityMembers">Loading...</h3>
                <p>Community Members</p>
            </div>
            <div class="card" style="text-align: center;">
                <div style="font-size: 3rem; color: var(--primary);">🎨</div>
                <h3 id="aiImagesCount">Loading...</h3>
                <p>AI-Logos erstellt</p>
            </div>
            <div class="card" style="text-align: center;">
                <div style="font-size: 3rem; color: var(--primary);">🎥</div>
                <h3 id="videosCount">Loading...</h3>
                <p>Videos</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="section" style="background: linear-gradient(135deg, rgba(255, 48, 80, 0.1), rgba(255, 48, 80, 0.05));">
    <div class="container" style="text-align: center;">
        <h2 class="section-title">🚀 Werde Teil der <span>Community</span></h2>
        <p style="font-size: 1.2rem; color: var(--text-secondary); margin-bottom: 2rem;">
            Tritt unserem Discord bei, verfolge den Stream und sei dabei!
        </p>
        <div class="hero-buttons">
            <a href="https://discord.gg/KfZRZ4WTnG" class="btn btn-primary" target="_blank">💬 Discord Server</a>
            <a href="https://twitch.tv/engels811" class="btn btn-secondary" target="_blank">📺 Twitch</a>
            <a href="https://youtube.com/@engels811_ttv" class="btn btn-secondary" target="_blank">🎥 YouTube</a>
        </div>
    </div>
</section>

<script>
// Load featured images
async function loadFeaturedImages() {
    try {
        const response = await fetch('/api/bot/images.php?action=featured&limit=6');
        const data = await response.json();
        
        const container = document.getElementById('featuredImages');
        
        if (data.success && data.data.images.length > 0) {
            container.innerHTML = data.data.images.map(img => `
                <div class="gallery-item" onclick="openLightbox('${img.image_url}')">
                    <img src="${img.image_url}" alt="${img.prompt}" loading="lazy">
                    <div class="gallery-overlay">
                        <h3>${img.prompt}</h3>
                        <p style="font-size: 0.9rem; color: var(--text-muted);">
                            ${new Date(img.created_at).toLocaleDateString('de-DE')}
                        </p>
                    </div>
                </div>
            `).join('');
        } else {
            container.innerHTML = '<p style="text-align: center; color: var(--text-muted);">Noch keine Bilder verfügbar.</p>';
        }
    } catch (error) {
        console.error('Error loading images:', error);
        document.getElementById('featuredImages').innerHTML = '<p style="text-align: center; color: var(--primary);">Fehler beim Laden.</p>';
    }
}

// Load latest videos
async function loadLatestVideos() {
    try {
        const response = await fetch('/api/bot/videos.php?action=list&limit=3');
        const data = await response.json();
        
        const container = document.getElementById('latestVideos');
        
        if (data.success && data.data.videos.length > 0) {
            container.innerHTML = data.data.videos.map(video => `
                <div class="video-card">
                    <div class="video-thumbnail">
                        <img src="https://img.youtube.com/vi/${video.video_id}/maxresdefault.jpg" 
                             alt="${video.title}" loading="lazy">
                    </div>
                    <div class="video-info">
                        <h3 class="video-title">${video.title}</h3>
                        <p class="video-meta">
                            ${new Date(video.published_at).toLocaleDateString('de-DE')}
                        </p>
                        <a href="https://youtube.com/watch?v=${video.video_id}" 
                           target="_blank" class="btn btn-primary" style="margin-top: 1rem;">
                            Video ansehen
                        </a>
                    </div>
                </div>
            `).join('');
        } else {
            container.innerHTML = '<p style="text-align: center; color: var(--text-muted);">Noch keine Videos verfügbar.</p>';
        }
    } catch (error) {
        console.error('Error loading videos:', error);
        document.getElementById('latestVideos').innerHTML = '<p style="text-align: center; color: var(--primary);">Fehler beim Laden.</p>';
    }
}

// Load stats
async function loadStats() {
    // Dummy stats - kann später durch echte API ersetzt werden
    document.getElementById('streamHours').textContent = '500+';
    document.getElementById('communityMembers').textContent = '1,234';
    
    // Load real image count
    try {
        const response = await fetch('/api/bot/images.php?action=count');
        const data = await response.json();
        if (data.success) {
            document.getElementById('aiImagesCount').textContent = data.data.count.toLocaleString('de-DE');
        }
    } catch (error) {
        document.getElementById('aiImagesCount').textContent = '50+';
    }
    
    // Load real video count
    try {
        const response = await fetch('/api/bot/videos.php?action=count');
        const data = await response.json();
        if (data.success) {
            document.getElementById('videosCount').textContent = data.data.count.toLocaleString('de-DE');
        }
    } catch (error) {
        document.getElementById('videosCount').textContent = '25+';
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    loadFeaturedImages();
    loadLatestVideos();
    loadStats();
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
