<?php
/*
 * Extended Images API - Additional endpoints for website
 */

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../config/config_bot_extended.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$action = $_GET['action'] ?? 'list';

try {
    $pdo = get_pdo_connection();
    
    switch ($action) {
        case 'featured':
            $limit = (int)($_GET['limit'] ?? 6);
            $stmt = $pdo->prepare("
                SELECT * FROM generated_images
                WHERE is_featured = 1
                ORDER BY created_at DESC
                LIMIT :limit
            ");
            $stmt->bindValue('limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            
            echo json_encode([
                'success' => true,
                'data' => ['images' => $stmt->fetchAll(PDO::FETCH_ASSOC)]
            ]);
            break;
            
        case 'recent':
            $limit = (int)($_GET['limit'] ?? 12);
            $stmt = $pdo->prepare("
                SELECT * FROM generated_images
                ORDER BY created_at DESC
                LIMIT :limit
            ");
            $stmt->bindValue('limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            
            echo json_encode([
                'success' => true,
                'data' => ['images' => $stmt->fetchAll(PDO::FETCH_ASSOC)]
            ]);
            break;
            
        case 'count':
            $stmt = $pdo->query("SELECT COUNT(*) as count FROM generated_images");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            echo json_encode([
                'success' => true,
                'data' => ['count' => (int)$result['count']]
            ]);
            break;
            
        case 'track_view':
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('POST required');
            }
            
            $input = json_decode(file_get_contents('php://input'), true);
            $image_url = $input['image_url'] ?? '';
            
            if ($image_url) {
                $stmt = $pdo->prepare("
                    UPDATE generated_images
                    SET views = views + 1
                    WHERE image_url = :url
                ");
                $stmt->execute(['url' => $image_url]);
            }
            
            echo json_encode(['success' => true]);
            break;
            
        default:
            // Fall back to main images.php
            include __DIR__ . '/images.php';
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
