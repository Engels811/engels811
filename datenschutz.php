<?php
$pageTitle = 'Datenschutz';
$pageDescription = 'Datenschutzerklärung gemäß DSGVO – Engels811';
$currentPage = 'datenschutz';
include __DIR__ . '/includes/header.php';
?>

<section class="hero" style="padding: 2rem;">
    <div class="hero-container">
        <h1>🔐 Datenschutz</h1>
        <p>Datenschutzerklärung gemäß DSGVO</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="card" style="max-width: 1100px; margin: 0 auto;">

            <!-- ================= Verantwortlicher ================= -->
            <h2>1. Verantwortlicher</h2>
            <p>
                <strong>Christopher Engels</strong><br>
                Künstlername: <strong>Engels811</strong><br>
                Deutschland
            </p>

            <p>
                E-Mail: <a href="mailto:kontakt@engels811-ttv.de">kontakt@engels811-ttv.de</a>
            </p>

            <hr>

            <!-- ================= Allgemeines ================= -->
            <h2>2. Allgemeine Hinweise</h2>
            <p style="color: var(--text-secondary); line-height: 1.8;">
                Der Schutz Ihrer persönlichen Daten ist uns ein besonderes Anliegen. Wir verarbeiten
                Ihre Daten ausschließlich auf Grundlage der gesetzlichen Bestimmungen (DSGVO, TMG).
            </p>

            <hr>

            <!-- ================= Zugriffsdaten ================= -->
            <h2>3. Zugriffsdaten / Server-Logfiles</h2>
            <p style="color: var(--text-secondary); line-height: 1.8;">
                Beim Besuch dieser Website erhebt und speichert der Webserver automatisch Informationen
                in sogenannten Server-Logfiles, die Ihr Browser automatisch übermittelt.
            </p>

            <ul style="color: var(--text-secondary); line-height: 1.8;">
                <li>IP-Adresse</li>
                <li>Datum und Uhrzeit der Anfrage</li>
                <li>Browsertyp und Browserversion</li>
                <li>Betriebssystem</li>
                <li>Referrer-URL</li>
            </ul>

            <p style="color: var(--text-secondary); line-height: 1.8;">
                Diese Daten sind nicht bestimmten Personen zuordenbar und dienen ausschließlich der
                technischen Überwachung und Sicherheit.
            </p>

            <hr>

            <!-- ================= Cookies ================= -->
            <h2>4. Cookies</h2>
            <p style="color: var(--text-secondary); line-height: 1.8;">
                Diese Website verwendet Cookies. Cookies richten auf Ihrem Endgerät keinen Schaden an
                und enthalten keine Viren. Sie dienen dazu, unser Angebot nutzerfreundlicher zu gestalten.
            </p>

            <hr>

            <!-- ================= Spotify ================= -->
            <h2>5. Spotify</h2>
            <p style="color: var(--text-secondary); line-height: 1.8;">
                Auf dieser Website sind Inhalte des Musikdienstes Spotify eingebunden. Anbieter ist
                Spotify AB, Birger Jarlsgatan 61, 113 56 Stockholm, Schweden.
            </p>

            <p style="color: var(--text-secondary); line-height: 1.8;">
                Beim Abspielen einer Playlist kann Spotify Cookies setzen und personenbezogene Daten
                verarbeiten.
            </p>

            <p>
                Datenschutzerklärung von Spotify:
                <a href="https://www.spotify.com/de/legal/privacy-policy/" target="_blank" rel="noopener">
                    https://www.spotify.com/de/legal/privacy-policy/
                </a>
            </p>

            <hr>

            <!-- ================= YouTube ================= -->
            <h2>6. YouTube</h2>
            <p style="color: var(--text-secondary); line-height: 1.8;">
                Diese Website bindet Inhalte der Plattform YouTube ein. Anbieter ist Google Ireland
                Limited, Gordon House, Barrow Street, Dublin 4, Irland.
            </p>

            <p>
                Datenschutzerklärung von Google:
                <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">
                    https://policies.google.com/privacy
                </a>
            </p>

            <hr>

            <!-- ================= Twitch ================= -->
            <h2>7. Twitch</h2>
            <p style="color: var(--text-secondary); line-height: 1.8;">
                Auf dieser Website können Inhalte der Streaming-Plattform Twitch eingebunden sein.
                Anbieter ist Twitch Interactive, Inc., 350 Bush Street, San Francisco, CA 94104, USA.
            </p>

            <p>
                Datenschutzerklärung von Twitch:
                <a href="https://www.twitch.tv/p/legal/privacy-notice/" target="_blank" rel="noopener">
                    https://www.twitch.tv/p/legal/privacy-notice/
                </a>
            </p>

            <hr>

            <!-- ================= Rechte ================= -->
            <h2>8. Rechte der betroffenen Person</h2>
            <p style="color: var(--text-secondary); line-height: 1.8;">
                Ihnen stehen grundsätzlich die Rechte auf Auskunft, Berichtigung, Löschung,
                Einschränkung, Datenübertragbarkeit, Widerruf und Widerspruch zu.
            </p>

            <hr>

            <!-- ================= Beschwerderecht ================= -->
            <h2>9. Beschwerderecht</h2>
            <p style="color: var(--text-secondary); line-height: 1.8;">
                Ihnen steht das Recht zu, sich bei der zuständigen Aufsichtsbehörde zu beschweren.
            </p>

            <hr>

            <!-- ================= Stand ================= -->
            <p style="font-size: 0.9rem; color: var(--text-secondary); margin-top: 2rem;">
                Stand: <?= date('F Y') ?>
            </p>

        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
