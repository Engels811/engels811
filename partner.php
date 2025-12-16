<?php
$pageTitle = 'Partner';
$pageDescription = 'Kooperationen von Engels811';
$currentPage = 'partner';

require __DIR__ . '/dashboard/db.php';
include __DIR__ . '/includes/header.php';

$partners = $pdo->query("
    SELECT * FROM partners WHERE active = 1
")->fetchAll();
?>

<section class="section">
    <h1>🤝 Partner</h1>

    <div class="grid grid-3">
        <?php foreach ($partners as $p): ?>
            <div class="card">
                <img src="<?= $p['logo_url'] ?>" style="max-width:220px">
                <h3><?= htmlspecialchars($p['name']) ?></h3>
                <p><?= htmlspecialchars($p['description']) ?></p>
                <a href="<?= $p['website'] ?>" target="_blank" class="btn btn-primary">
                    Mehr erfahren
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
