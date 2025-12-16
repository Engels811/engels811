<?php

declare(strict_types=1);

require_once __DIR__.'/../../config/config.php';

header('Content-Type: application/json');

function respond(bool $success, array $data = [], ?string $error = null): void
{
    echo json_encode(['success' => $success, 'data' => $data, 'error' => $error], JSON_UNESCAPED_UNICODE);
    exit;
}

$videos = [
    ['video_id' => 'dQw4w9WgXcQ', 'title' => 'Channel Trailer', 'description' => 'Einblick in den Stream', 'published_at' => '2024-01-01', 'is_active' => true],
    ['video_id' => 'FTQbiNvZqaY', 'title' => 'Highlight 1', 'description' => 'Best Moments', 'published_at' => '2024-01-10', 'is_active' => true],
    ['video_id' => 'V-_O7nl0Ii0', 'title' => 'Highlight 2', 'description' => 'Community Clip', 'published_at' => '2024-01-20', 'is_active' => true],
];

$limit = (int) ($_GET['limit'] ?? 9);
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;
$paged = array_slice($videos, $offset, $limit);

if (isset($_GET['count'])) {
    respond(true, ['count' => count($videos)]);
}

respond(true, ['videos' => $paged]);
