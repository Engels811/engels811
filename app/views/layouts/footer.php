<?php
/**
 * Kontext-Erkennung
 * Panel läuft auf Subdomain oder /dashboard
 */
$isPanel =
    str_starts_with($_SERVER['HTTP_HOST'] ?? '', 'panel.')
    || str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/dashboard');
?>

<footer>
    <div class="footer-container">

        <!-- BRAND -->
        <div class="footer-section">
            <h3>Engels811 <?= $isPanel ? 'Dashboard' : 'Network' ?></h3>
            <p><?= $isPanel
                ? 'Administration & Control Panel'
                : 'Gaming, Streaming & Community'
            ?></p>

            <div class="social-links">
                <a href="https://twitch.tv/engels811" target="_blank" class="social-link">📺</a>
                <a href="https://youtube.com/@engels811_ttv" target="_blank" class="social-link">🎥</a>
                <a href="https://discord.gg/KfZRZ4WTnG" target="_blank" class="social-link">💬</a>
                <a href="https://twitter.com/ttv_engels811" target="_blank" class="social-link">🐦</a>
            </div>
        </div>

        <!-- NAVIGATION -->
        <div class="footer-section">
            <h3>Navigation</h3>
            <ul>
                <?php if (!$isPanel): ?>
                    <li><a href="/">Home</a></li>
                    <li><a href="/gallery">Galerie</a></li>
                    <li><a href="/videos">Videos</a></li>
                    <li><a href="/playlists">Playlisten</a></li>
                    <li><a href="/hardware">Hardware</a></li>
                <?php else: ?>
                    <li><a href="/dashboard">Dashboard</a></li>
                    <li><a href="/dashboard/users">Benutzer</a></li>
                    <li><a href="/dashboard/settings">Einstellungen</a></li>
                    <li><a href="/dashboard/logs">Logs</a></li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- COMMUNITY -->
        <div class="footer-section">
            <h3>Community</h3>
            <ul>
                <li>
                    <a href="<?= $isPanel ? 'https://engels811-ttv.de/live' : '/live' ?>">
                        Live Stream
                    </a>
                </li>
                <li>
                    <a href="<?= $isPanel ? 'https://engels811-ttv.de/about' : '/about' ?>">
                        Über uns
                    </a>
                </li>
                <li>
                    <a href="https://discord.gg/KfZRZ4WTnG" target="_blank">
                        Discord Server
                    </a>
                </li>

                <?php if (!$isPanel): ?>
                    <li>
                        <a href="https://panel.engels811-ttv.de">
                            Dashboard
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- LEGAL -->
        <div class="footer-section">
            <h3>Rechtliches</h3>
            <ul>
                <li>
                    <a href="<?= $isPanel
                        ? 'https://engels811-ttv.de/impressum'
                        : '/impressum'
                    ?>">Impressum</a>
                </li>
                <li>
                    <a href="<?= $isPanel
                        ? 'https://engels811-ttv.de/datenschutz'
                        : '/datenschutz'
                    ?>">Datenschutz</a>
                </li>
                <li>
                    <a href="<?= $isPanel
                        ? 'https://engels811-ttv.de/agb'
                        : '/agb'
                    ?>">AGB</a>
                </li>
            </ul>
        </div>

    </div>

    <!-- BOTTOM -->
    <div class="footer-bottom">
        <p>
            © <?= date('Y') ?>
            Engels811 <?= $isPanel ? 'Dashboard' : 'Network' ?>.
            Alle Rechte vorbehalten.
        </p>
        <p>Powered by WonderLife Core</p>
    </div>
</footer>
