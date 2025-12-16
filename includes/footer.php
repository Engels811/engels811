<footer>
    <div class="footer-container">

        <div class="footer-section">
            <h3>Engels811 <?= $isPanel ? 'Dashboard' : 'Network' ?></h3>
            <p><?= $isPanel ? 'Administration & Control Panel' : 'Gaming, Streaming & Community' ?></p>

            <div class="social-links">
                <a href="https://twitch.tv/engels811" target="_blank" class="social-link">📺</a>
                <a href="https://youtube.com/@engels811_ttv" target="_blank" class="social-link">🎥</a>
                <a href="https://discord.gg/KfZRZ4WTnG" target="_blank" class="social-link">💬</a>
                <a href="https://twitter.com/ttv_engels811" target="_blank" class="social-link">🐦</a>
            </div>
        </div>

        <div class="footer-section">
            <h3>Navigation</h3>
            <ul>
                <?php if (!$isPanel): ?>
                    <li><a href="/">Home</a></li>
                    <li><a href="/gallery.php">Galerie</a></li>
                    <li><a href="/videos.php">Videos</a></li>
                    <li><a href="/playlists.php">Playlisten</a></li>
                    <li><a href="/hardware.php">Hardware</a></li>
                <?php else: ?>
                    <li><a href="/">Dashboard</a></li>
                    <li><a href="/users.php">Benutzer</a></li>
                    <li><a href="/settings.php">Einstellungen</a></li>
                    <li><a href="/logs.php">Logs</a></li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="footer-section">
            <h3>Community</h3>
            <ul>
                <li>
                    <a href="<?= $isPanel ? 'https://engels811-ttv.de/live.php' : '/live.php' ?>">
                        Live Stream
                    </a>
                </li>
                <li>
                    <a href="<?= $isPanel ? 'https://engels811-ttv.de/about.php' : '/about.php' ?>">
                        Über uns
                    </a>
                </li>
                <li><a href="https://discord.gg/KfZRZ4WTnG" target="_blank">Discord Server</a></li>
                <?php if (!$isPanel): ?>
                    <li><a href="https://panel.engels811-ttv.de/">Dashboard</a></li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="footer-section">
            <h3>Rechtliches</h3>
            <ul>
                <li><a href="<?= $isPanel ? 'https://engels811-ttv.de/impressum.php' : '/impressum.php' ?>">Impressum</a></li>
                <li><a href="<?= $isPanel ? 'https://engels811-ttv.de/datenschutz.php' : '/datenschutz.php' ?>">Datenschutz</a></li>
                <li><a href="<?= $isPanel ? 'https://engels811-ttv.de/agb.php' : '/agb.php' ?>">AGB</a></li>
            </ul>
        </div>

    </div>

    <div class="footer-bottom">
        <p>&copy; <?= date('Y'); ?> Engels811 <?= $isPanel ? 'Dashboard' : 'Network' ?>. Alle Rechte vorbehalten.</p>
        <p>Powered by WonderLife Core</p>
    </div>
</footer>
