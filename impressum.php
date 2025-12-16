<?php
$pageTitle = 'Impressum';
$pageDescription = 'Impressum gemäß § 5 TMG – Engels811';
$currentPage = 'impressum';
include __DIR__ . '/includes/header.php';
?>

<section class="hero" style="padding: 2rem;">
    <div class="hero-container">
        <h1>📄 Impressum</h1>
        <p>Angaben gemäß § 5 TMG</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="card" style="max-width: 1100px; margin: 0 auto;">

            <!-- ================= Betreiber ================= -->
            <h2>Angaben zum Anbieter</h2>
            <p>
                <strong>Christopher Engels</strong><br>
                Künstlername: <strong>Engels811</strong><br>
                Deutschland
            </p>

            <h3>Kontakt</h3>
            <p>
                E-Mail: <a href="mailto:kontakt@engels811-ttv.de">kontakt@engels811-ttv.de</a>
            </p>

            <hr>

            <!-- ================= Haftung Inhalte ================= -->
            <h2>Haftung für Inhalte</h2>
            <p style="color: var(--text-secondary); line-height: 1.8;">
                Als Diensteanbieter sind wir gemäß § 7 Abs.1 TMG für eigene Inhalte auf diesen Seiten
                nach den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 TMG sind wir als
                Diensteanbieter jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde
                Informationen zu überwachen oder nach Umständen zu forschen, die auf eine
                rechtswidrige Tätigkeit hinweisen.
            </p>

            <p style="color: var(--text-secondary); line-height: 1.8;">
                Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den
                allgemeinen Gesetzen bleiben hiervon unberührt. Eine diesbezügliche Haftung ist jedoch
                erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung möglich.
            </p>

            <hr>

            <!-- ================= Haftung Links ================= -->
            <h2>Haftung für Links</h2>
            <p style="color: var(--text-secondary); line-height: 1.8;">
                Unser Angebot enthält Links zu externen Websites Dritter, auf deren Inhalte wir keinen
                Einfluss haben. Deshalb können wir für diese fremden Inhalte auch keine Gewähr übernehmen.
            </p>

            <p style="color: var(--text-secondary); line-height: 1.8;">
                Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber
                der Seiten verantwortlich. Eine permanente inhaltliche Kontrolle der verlinkten Seiten
                ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar.
            </p>

            <hr>

            <!-- ================= Urheberrecht ================= -->
            <h2>Urheberrecht</h2>
            <p style="color: var(--text-secondary); line-height: 1.8;">
                Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen
                dem deutschen Urheberrecht. Beiträge Dritter sind als solche gekennzeichnet.
            </p>

            <p style="color: var(--text-secondary); line-height: 1.8;">
                Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der
                Grenzen des Urheberrechtes bedürfen der schriftlichen Zustimmung des jeweiligen Autors
                bzw. Erstellers.
            </p>

            <hr>

            <!-- ================= Werbung & Affiliate ================= -->
            <h2>Werbung & Affiliate-Links</h2>
            <p style="color: var(--text-secondary); line-height: 1.8;">
                Diese Website kann Affiliate-Links oder Werbeeinbindungen enthalten. Wenn Nutzer über
                solche Links Produkte oder Dienstleistungen erwerben, kann eine Provision anfallen.
                Für den Nutzer entstehen dadurch keine zusätzlichen Kosten.
            </p>

            <hr>

            <!-- ================= Streaming Hinweis ================= -->
            <h2>Streaming-Inhalte</h2>
            <p style="color: var(--text-secondary); line-height: 1.8;">
                Auf dieser Website werden Inhalte aus Livestreams (z. B. Twitch, YouTube) eingebunden.
                Für die Inhalte externer Plattformen gelten die jeweiligen Nutzungsbedingungen und
                Datenschutzrichtlinien der Anbieter.
            </p>

            <hr>

            <!-- ================= Online-Streitbeilegung ================= -->
            <h2>Hinweis zur Online-Streitbeilegung</h2>
            <p style="color: var(--text-secondary); line-height: 1.8;">
                Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit:
                <br>
                <a href="https://ec.europa.eu/consumers/odr" target="_blank" rel="noopener">
                    https://ec.europa.eu/consumers/odr
                </a>
            </p>

            <p style="color: var(--text-secondary); line-height: 1.8;">
                Wir sind nicht verpflichtet und nicht bereit, an Streitbeilegungsverfahren vor einer
                Verbraucherschlichtungsstelle teilzunehmen.
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
