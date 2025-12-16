<?php
$pageTitle = 'Videos';
$pageDescription = 'Alle YouTube Videos von Engels811';
$currentPage = 'videos';
include __DIR__ . '/includes/header.php';
?>

<section class="hero" style="padding: 2rem;">
    <div class="hero-container">
        <h1>🎥 YouTube Videos</h1>
        <p>Alle Videos, Highlights und Streams</p>
        <a href="https://youtube.com/@engels811_ttv" target="_blank" class="btn btn-primary" style="margin-top: 1rem;">
            📺 Zum Kanal
        </a>
    </div>
</section>

<section class="section">
    <div class="container">
        <!-- Latest Video Highlight -->
        <div id="latestVideoHighlight" style="margin-bottom: 3rem;"></div>
        
        <h2 class="section-title">📋 Alle <span>Videos</span></h2>
        
        <!-- Video Grid -->
        <div class="video-grid" id="videosContainer">
            <div class="loading">Lade Videos</div>
        </div>
        
        <!-- Load More -->
        <div style="text-align: center; margin-top: 3rem;" id="loadMoreContainer" style="display: none;">
            <button class="btn btn-primary" onclick="loadMoreVideos()">Mehr laden</button>
        </div>
    </div>
</section>

<script>
let currentPage = 1;
let hasMore = true;

async function loadVideos(page = 1, append = false) {
    try {
        const response = await fetch(`/api/bot/videos.php?action=list&limit=12&page=${page}`);
        const data = await response.json();
        
        const container = document.getElementById('videosContainer');
        
        if (data.success && data.data.videos.length > 0) {
            const videosHTML = data.data.videos.map(video => `
                <div class="video-card">
                    <div class="video-thumbnail">
                        <img src="https://img.youtube.com/vi/${video.video_id}/maxresdefault.jpg" 
                             alt="${video.title}" 
                             loading="lazy"
                             onerror="this.src='https://img.youtube.com/vi/${video.video_id}/hqdefault.jpg'">
                        <div style="position: absolute; bottom: 10px; right: 10px; background: rgba(0,0,0,0.8); padding: 0.3rem 0.6rem; border-radius: 4px; font-size: 0.9rem;">
                            ${video.duration || ''}
                        </div>
                    </div>
                    <div class="video-info">
                        <h3 class="video-title">${video.title}</h3>
                        <p class="video-meta">
                            ${video.views ? '👁️ ' + formatNumber(video.views) + ' • ' : ''}
                            ${new Date(video.published_at).toLocaleDateString('de-DE')}
                        </p>
                        ${video.description ? `<p style="color: var(--text-secondary); font-size: 0.9rem; margin-top: 0.5rem; line-height: 1.4;">${truncate(video.description, 100)}</p>` : ''}
                        <a href="https://youtube.com/watch?v=${video.video_id}" 
                           target="_blank" 
                           class="btn btn-primary" 
                           style="margin-top: 1rem; display: inline-block;">
                            ▶️ Ansehen
                        </a>
                    </div>
                </div>
            `).join('');
            
            if (append) {
                container.innerHTML += videosHTML;
            } else {
                container.innerHTML = videosHTML;
                
                // Show latest video as highlight
                if (page === 1 && data.data.videos.length > 0) {
                    showLatestHighlight(data.data.videos[0]);
                }
            }
            
            hasMore = data.data.videos.length === 12;
            document.getElementById('loadMoreContainer').style.display = hasMore ? 'block' : 'none';
        } else if (!append) {
            container.innerHTML = '<p style="text-align: center; color: var(--text-muted); grid-column: 1/-1;">Keine Videos gefunden.</p>';
        }
    } catch (error) {
        console.error('Error loading videos:', error);
        document.getElementById('videosContainer').innerHTML = '<p style="text-align: center; color: var(--primary); grid-column: 1/-1;">Fehler beim Laden.</p>';
    }
}

function showLatestHighlight(video) {
    const container = document.getElementById('latestVideoHighlight');
    container.innerHTML = `
        <div style="background: var(--dark-secondary); border: 1px solid var(--border); border-radius: 12px; overflow: hidden;">
            <div style="position: relative; padding-bottom: 56.25%; height: 0;">
                <iframe 
                    src="https://www.youtube.com/embed/${video.video_id}" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                </iframe>
            </div>
            <div style="padding: 2rem;">
                <span style="display: inline-block; background: var(--primary); padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.9rem; margin-bottom: 1rem;">
                    ⭐ Neuestes Video
                </span>
                <h2 style="font-size: 1.8rem; margin-bottom: 1rem;">${video.title}</h2>
                <p style="color: var(--text-secondary); margin-bottom: 1rem;">
                    ${video.description ? truncate(video.description, 200) : ''}
                </p>
                <p class="video-meta">
                    ${video.views ? '👁️ ' + formatNumber(video.views) + ' Views • ' : ''}
                    ${new Date(video.published_at).toLocaleDateString('de-DE')}
                </p>
            </div>
        </div>
    `;
}

function loadMoreVideos() {
    currentPage++;
    loadVideos(currentPage, true);
}

function formatNumber(num) {
    if (num >= 1000000) return (num / 1000000).toFixed(1) + 'M';
    if (num >= 1000) return (num / 1000).toFixed(1) + 'K';
    return num.toLocaleString('de-DE');
}

function truncate(str, maxLength) {
    if (!str) return '';
    if (str.length <= maxLength) return str;
    return str.substring(0, maxLength) + '...';
}

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    loadVideos(1);
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
