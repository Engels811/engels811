<?php
/*
 * Videos API Endpoint
 * YouTube video management
 */

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/config_bot_extended.php';

header('Content-Type: application/json');

$headers = getallheaders();
$provided_key = $headers['X-API-Key'] ?? '';

if ($provided_key !== BOT_API_KEY) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

$action = $_GET['action'] ?? 'list';

try {
    $pdo = get_pdo_connection();
    
    if ($action === 'list') {
        $limit = $_GET['limit'] ?? 10;
        
        $stmt = $pdo->prepare("
            SELECT * FROM youtube_videos
            WHERE is_active = 1
            ORDER BY published_at DESC
            LIMIT :limit
        ");
        
        $stmt->bindValue('limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        $videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode([
            'success' => true,
            'data' => ['videos' => $videos]
        ]);
    } else {
        throw new Exception('Invalid action');
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
