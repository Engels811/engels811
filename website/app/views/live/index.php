<section class="hero">
    <div class="container">
        <h1>Twitch Live</h1>
        <p id="live-status">Status wird geladen...</p>
    </div>
</section>

<div class="container grid grid-cols-3">
    <div class="card" style="grid-column: span 2;">
        <iframe src="https://player.twitch.tv/?channel=engels811&parent=localhost" allowfullscreen height="400" width="100%"></iframe>
    </div>
    <div class="card">
        <h3>Chat</h3>
        <iframe src="https://www.twitch.tv/embed/engels811/chat?parent=localhost" height="400" width="100%"></iframe>
    </div>
</div>

<script type="module" src="/assets/js/live.js"></script>
