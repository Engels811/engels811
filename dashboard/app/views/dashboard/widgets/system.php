<h3>Systemstatus</h3>

<div class="dashboard-grid">
    <div class="card small">
        <strong>Dashboard</strong>
        <span class="status ok"><?= $system['dashboard'] ?></span>
    </div>

    <div class="card small">
        <strong>API</strong>
        <span class="status <?= $system['api'] === 'Online' ? 'ok' : 'err' ?>">
            <?= $system['api'] ?>
        </span>
    </div>

    <div class="card small">
        <strong>Serverzeit</strong>
        <span><?= $system['time'] ?></span>
    </div>
</div>
