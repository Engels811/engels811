<?php
$pageTitle = 'Galerie';
$pageDescription = 'AI-generierte Gaming-Logos im Engels811 Style';
$currentPage = 'gallery';
include __DIR__ . '/includes/header.php';
?>

<section class="hero" style="padding: 2rem;">
    <div class="hero-container">
        <h1>🎨 AI-Logo Galerie</h1>
        <p>Alle mit KI generierten Gaming-Logos im Engels811 Wolf-Style</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <!-- Filter -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div class="hero-buttons">
                <button class="btn btn-primary" onclick="filterGallery('all')" id="filterAll">Alle</button>
                <button class="btn btn-secondary" onclick="filterGallery('featured')" id="filterFeatured">Featured</button>
                <button class="btn btn-secondary" onclick="filterGallery('recent')" id="filterRecent">Neueste</button>
            </div>
        </div>
        
        <!-- Gallery Grid -->
        <div class="gallery-grid" id="galleryContainer">
            <div class="loading">Lade Galerie</div>
        </div>
        
        <!-- Load More -->
        <div style="text-align: center; margin-top: 3rem;" id="loadMoreContainer" style="display: none;">
            <button class="btn btn-primary" onclick="loadMoreImages()">Mehr laden</button>
        </div>
    </div>
</section>

<!-- Lightbox -->
<div class="lightbox" id="lightbox" onclick="closeLightbox()">
    <button class="lightbox-close" onclick="closeLightbox()">✕</button>
    <img src="" alt="" id="lightboxImage">
</div>

<script>
let currentFilter = 'all';
let currentPage = 1;
let hasMore = true;

async function loadGallery(filter = 'all', page = 1, append = false) {
    try {
        let url = `/api/bot/images.php?action=list&limit=12&page=${page}`;
        
        if (filter === 'featured') {
            url = `/api/bot/images.php?action=featured&limit=12&page=${page}`;
        } else if (filter === 'recent') {
            url = `/api/bot/images.php?action=recent&limit=12&page=${page}`;
        }
        
        const response = await fetch(url);
        const data = await response.json();
        
        const container = document.getElementById('galleryContainer');
        
        if (data.success && data.data.images.length > 0) {
            const imagesHTML = data.data.images.map(img => `
                <div class="gallery-item" onclick="openLightbox('${img.image_url}')">
                    <img src="${img.image_url}" alt="${img.prompt}" loading="lazy">
                    <div class="gallery-overlay">
                        <h3>${img.prompt}</h3>
                        <p style="font-size: 0.9rem; color: var(--text-muted); margin-top: 0.5rem;">
                            👁️ ${img.views || 0} Views • ${new Date(img.created_at).toLocaleDateString('de-DE')}
                        </p>
                        ${img.is_featured ? '<span style="display: inline-block; background: var(--primary); padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.8rem; margin-top: 0.5rem;">⭐ Featured</span>' : ''}
                    </div>
                </div>
            `).join('');
            
            if (append) {
                container.innerHTML += imagesHTML;
            } else {
                container.innerHTML = imagesHTML;
            }
            
            // Check if more images available
            hasMore = data.data.images.length === 12;
            document.getElementById('loadMoreContainer').style.display = hasMore ? 'block' : 'none';
        } else if (!append) {
            container.innerHTML = '<p style="text-align: center; color: var(--text-muted); grid-column: 1/-1;">Keine Bilder gefunden.</p>';
            document.getElementById('loadMoreContainer').style.display = 'none';
        }
    } catch (error) {
        console.error('Error loading gallery:', error);
        document.getElementById('galleryContainer').innerHTML = '<p style="text-align: center; color: var(--primary); grid-column: 1/-1;">Fehler beim Laden.</p>';
    }
}

function filterGallery(filter) {
    currentFilter = filter;
    currentPage = 1;
    
    // Update button states
    document.querySelectorAll('[onclick^="filterGallery"]').forEach(btn => {
        btn.className = 'btn btn-secondary';
    });
    
    if (filter === 'all') {
        document.getElementById('filterAll').className = 'btn btn-primary';
    } else if (filter === 'featured') {
        document.getElementById('filterFeatured').className = 'btn btn-primary';
    } else if (filter === 'recent') {
        document.getElementById('filterRecent').className = 'btn btn-primary';
    }
    
    loadGallery(filter, 1, false);
}

function loadMoreImages() {
    currentPage++;
    loadGallery(currentFilter, currentPage, true);
}

function openLightbox(imageUrl) {
    document.getElementById('lightboxImage').src = imageUrl;
    document.getElementById('lightbox').classList.add('active');
    
    // Track view
    fetch('/api/bot/images.php?action=track_view', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ image_url: imageUrl })
    });
}

function closeLightbox() {
    document.getElementById('lightbox').classList.remove('active');
}

// Close lightbox on ESC
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeLightbox();
});

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    loadGallery('all', 1);
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
