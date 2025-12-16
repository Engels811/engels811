<div class="dashboard-grid">
    <div class="card">
        <div class="icon">🎮</div>
        <h3><?= number_format($kpis['stream_hours']) ?>+</h3>
        <p>Stream-Stunden</p>
    </div>

    <div class="card">
        <div class="icon">👥</div>
        <h3><?= number_format($kpis['community']) ?></h3>
        <p>Community</p>
    </div>

    <div class="card">
        <div class="icon">🎨</div>
        <h3><?= number_format($kpis['ai_images']) ?></h3>
        <p>AI-Logos</p>
    </div>

    <div class="card">
        <div class="icon">🎥</div>
        <h3><?= number_format($kpis['videos']) ?></h3>
        <p>Videos</p>
    </div>
</div>
