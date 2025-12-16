<?php
/*
 * Extended Videos API - Additional endpoints for website
 */

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../config/config_bot_extended.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$action = $_GET['action'] ?? 'list';

try {
    $pdo = get_pdo_connection();
    
    switch ($action) {
        case 'count':
            $stmt = $pdo->query("SELECT COUNT(*) as count FROM youtube_videos WHERE is_active = 1");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            echo json_encode([
                'success' => true,
                'data' => ['count' => (int)$result['count']]
            ]);
            break;
            
        default:
            // Fall back to main videos.php
            include __DIR__ . '/videos.php';
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
