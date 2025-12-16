<?php
$pageTitle = 'Live Stream';
$pageDescription = 'Engels811 Live auf Twitch - Jetzt zuschauen!';
$currentPage = 'live';
include __DIR__ . '/includes/header.php';
?>

<section class="hero" style="padding: 2rem;">
    <div class="hero-container">
        <h1>🔴 Live Stream</h1>
        <p>Schau zu und chatte mit!</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <!-- Twitch Stream -->
        <div class="stream-container">
            <div class="stream-embed">
                <iframe 
                    src="https://player.twitch.tv/?channel=engels811&parent=engels811-ttv.de&parent=wiki.engels811-ttv.de&parent=www.engels811-ttv.de" 
                    frameborder="0" 
                    allowfullscreen="true" 
                    scrolling="no">
                </iframe>
            </div>
            <div class="stream-info">
                <div id="streamStatus">
                    <div class="loading">Lade Stream-Status</div>
                </div>
            </div>
        </div>
        
        <!-- Twitch Chat -->
        <div class="stream-container" style="margin-top: 2rem;">
            <h2 style="padding: 1.5rem; margin: 0; border-bottom: 1px solid var(--border);">💬 Live Chat</h2>
            <div class="stream-embed">
                <iframe 
                    src="https://www.twitch.tv/embed/engels811/chat?parent=engels811-ttv.de&parent=wiki.engels811-ttv.de&parent=www.engels811-ttv.de&darkpopout" 
                    frameborder="0">
                </iframe>
            </div>
        </div>
        
        <!-- Stream Schedule -->
        <div style="margin-top: 3rem;">
            <h2 class="section-title">📅 Stream <span>Schedule</span></h2>
            <div class="grid grid-3">
                <div class="card">
                    <h3>Montag</h3>
                    <p style="color: var(--primary); font-weight: 600;">20:00 - 00:00 Uhr</p>
                    <p style="color: var(--text-secondary); margin-top: 0.5rem;">Gaming Session</p>
                </div>
                
                <div class="card">
                    <h3>Mittwoch</h3>
                    <p style="color: var(--primary); font-weight: 600;">20:00 - 00:00 Uhr</p>
                    <p style="color: var(--text-secondary); margin-top: 0.5rem;">Community Abend</p>
                </div>
                
                <div class="card">
                    <h3>Freitag</h3>
                    <p style="color: var(--primary); font-weight: 600;">21:00 - 02:00 Uhr</p>
                    <p style="color: var(--text-secondary); margin-top: 0.5rem;">Weekend Special</p>
                </div>
                
                <div class="card">
                    <h3>Samstag</h3>
                    <p style="color: var(--primary); font-weight: 600;">19:00 - 01:00 Uhr</p>
                    <p style="color: var(--text-secondary); margin-top: 0.5rem;">Long Stream</p>
                </div>
                
                <div class="card">
                    <h3>Sonntag</h3>
                    <p style="color: var(--primary); font-weight: 600;">18:00 - 23:00 Uhr</p>
                    <p style="color: var(--text-secondary); margin-top: 0.5rem;">Chill Sunday</p>
                </div>
                
                <div class="card" style="background: rgba(255, 48, 80, 0.1); border-color: var(--primary);">
                    <h3>Spontan</h3>
                    <p style="color: var(--primary); font-weight: 600;">Überraschungen! 🎉</p>
                    <p style="color: var(--text-secondary); margin-top: 0.5rem;">Follow für Benachrichtigungen</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
async function checkStreamStatus() {
    const statusContainer = document.getElementById('streamStatus');
    
    // Twitch API würde hier gecheckt werden
    // Für jetzt: statischer Content
    statusContainer.innerHTML = `
        <div style="text-align: center; padding: 2rem 0;">
            <h2 style="font-size: 2rem; margin-bottom: 1rem;">
                🔴 Stream Status
            </h2>
            <p style="color: var(--text-secondary); margin-bottom: 2rem;">
                Folge auf Twitch um benachrichtigt zu werden!
            </p>
            <div class="hero-buttons">
                <a href="https://twitch.tv/engels811" target="_blank" class="btn btn-primary">
                    📺 Auf Twitch folgen
                </a>
                <a href="https://discord.gg/engels811" target="_blank" class="btn btn-secondary">
                    💬 Discord beitreten
                </a>
            </div>
        </div>
    `;
}

document.addEventListener('DOMContentLoaded', () => {
    checkStreamStatus();
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
