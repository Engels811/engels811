<?php

declare(strict_types=1);

require_once __DIR__.'/../../config/config.php';

header('Content-Type: application/json');

$apiKey = $_SERVER['HTTP_X_API_KEY'] ?? '';

function respond(bool $success, array $data = [], ?string $error = null): void
{
    echo json_encode(['success' => $success, 'data' => $data, 'error' => $error], JSON_UNESCAPED_UNICODE);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$images = [
    ['id' => 1, 'prompt' => 'Neon wolf logo', 'image_url' => '/assets/images/wolf1.png', 'is_featured' => true, 'created_at' => '2024-01-01'],
    ['id' => 2, 'prompt' => 'Cyber wolf crest', 'image_url' => '/assets/images/wolf2.png', 'is_featured' => false, 'created_at' => '2024-02-15'],
    ['id' => 3, 'prompt' => 'Red howl', 'image_url' => '/assets/images/wolf3.png', 'is_featured' => true, 'created_at' => '2024-03-10'],
];

if ($method === 'GET') {
    $filter = $_GET['filter'] ?? 'all';
    $limit = (int) ($_GET['limit'] ?? 9);
    $page = max(1, (int) ($_GET['page'] ?? 1));

    $filtered = array_filter($images, static function ($img) use ($filter) {
        return match ($filter) {
            'featured' => $img['is_featured'],
            'recent' => true,
            default => true,
        };
    });

    if (isset($_GET['count'])) {
        respond(true, ['count' => count($filtered)]);
    }

    $offset = ($page - 1) * $limit;
    $paged = array_slice(array_values($filtered), $offset, $limit);
    respond(true, ['images' => $paged]);
}

if (!hash_equals(BOT_API_KEY, $apiKey)) {
    http_response_code(401);
    respond(false, [], 'Unauthorized');
}

$input = json_decode((string) file_get_contents('php://input'), true) ?? [];

if ($method === 'POST') {
    $input['id'] = rand(100, 999);
    respond(true, ['image' => $input]);
}

if ($method === 'DELETE') {
    respond(true, ['deleted' => $input['id'] ?? null]);
}

http_response_code(405);
respond(false, [], 'Method not allowed');
