<?php

declare(strict_types=1);

require_once __DIR__.'/../../config/config.php';

header('Content-Type: application/json');

function respond(bool $success, array $data = [], ?string $error = null): void
{
    echo json_encode(['success' => $success, 'data' => $data, 'error' => $error], JSON_UNESCAPED_UNICODE);
    exit;
}

$apiKey = $_SERVER['HTTP_X_API_KEY'] ?? '';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'GET') {
    $discordId = $_GET['discord_id'] ?? '';
    respond(true, ['tickets' => [
        ['id' => 1, 'subject' => 'Support', 'status' => 'open', 'discord_id' => $discordId],
    ]]);
}

if (!hash_equals(BOT_API_KEY, $apiKey)) {
    http_response_code(401);
    respond(false, [], 'Unauthorized');
}

if ($method === 'POST') {
    $input = json_decode((string) file_get_contents('php://input'), true) ?? [];
    $input['id'] = rand(100, 999);
    $input['status'] = 'open';
    respond(true, ['ticket' => $input]);
}

http_response_code(405);
respond(false, [], 'Method not allowed');
