<?php
$hardwareFile = __DIR__.'/../../data/hardware.json';
$hardware = json_decode((string) file_get_contents($hardwareFile), true, flags: JSON_THROW_ON_ERROR);
$pc = $hardware['pc'] ?? [];
?>
<section class="hero">
    <div class="container">
        <h1>Hardware Setup</h1>
        <p>Das Herzstück des Engels811-Streams.</p>
    </div>
</section>

<div class="container grid grid-cols-3">
    <?php foreach ($pc as $part): ?>
        <div class="card">
            <h3><?= htmlspecialchars($part['icon'].' '.$part['title']) ?></h3>
            <p><strong><?= htmlspecialchars($part['name']) ?></strong></p>
            <p><?= htmlspecialchars($part['details']) ?></p>
        </div>
    <?php endforeach; ?>
</div>
