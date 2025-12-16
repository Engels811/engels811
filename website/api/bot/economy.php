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
    $discordId = $_GET['discord_id'] ?? null;
    if (!$discordId) {
        http_response_code(400);
        respond(false, [], 'discord_id required');
    }
    respond(true, ['balance' => 500, 'bank_balance' => 1500]);
}

if (!hash_equals(BOT_API_KEY, $apiKey)) {
    http_response_code(401);
    respond(false, [], 'Unauthorized');
}

$input = json_decode((string) file_get_contents('php://input'), true) ?? [];
$action = $input['action'] ?? null;
if (!$action) {
    http_response_code(400);
    respond(false, [], 'action required');
}

$rewards = [
    'daily' => 250,
    'work' => 120,
];

switch ($action) {
    case 'daily':
    case 'work':
        respond(true, ['amount' => $rewards[$action]]);
    case 'add':
    case 'charge':
        respond(true, ['amount' => $input['amount'] ?? 0]);
    default:
        http_response_code(400);
        respond(false, [], 'invalid action');
}
