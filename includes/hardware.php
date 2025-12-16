<?php
$hardware = json_decode(
    file_get_contents(__DIR__ . '/../data/hardware.json'),
    true
);
?>

<!-- PC SPECS -->
<section class="section">
    <div class="container">
        <h2 class="section-title">🖥️ PC <span>Specs</span></h2>

        <div class="hardware-grid">
            <?php foreach ($hardware['pc'] as $spec): ?>
                <div class="spec-card">
                    <div class="spec-icon"><?= $spec['icon'] ?></div>
                    <div class="spec-title"><?= htmlspecialchars($spec['title']) ?></div>
                    <div class="spec-detail">
                        <?= htmlspecialchars($spec['name']) ?><br>
                        <span style="color: var(--text-muted); font-size: 0.9rem;">
                            <?= htmlspecialchars($spec['details']) ?>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- MONITORS / AUDIO / EXTRAS -->
<section class="section" style="background: rgba(255,48,80,0.02);">
    <div class="container">
        <div class="grid grid-3">

            <?php
            $lists = [
                '🖥️ Monitore' => $hardware['monitors'],
                '🎙️ Audio'   => $hardware['audio'],
                '📷 Kamera & Licht' => $hardware['camera_lighting'],
            ];
            ?>

            <?php foreach ($lists as $title => $items): ?>
                <div class="card">
                    <h3><?= $title ?></h3>
                    <ul>
                        <?php foreach ($items as $item): ?>
                            <li><?= htmlspecialchars($item) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="section-title">🎮 Extras</h2>
        <div class="grid grid-2">
            <div class="card">
                <ul>
                    <?php foreach ($hardware['extras'] as $extra): ?>
                        <li><?= htmlspecialchars($extra) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>
