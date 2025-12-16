<?php
/**
 * Images API - AI Generated Images
 * DALL-E 3 Integration
 * 
 * PFAD: /api/bot/images.php
 */

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/config_bot_extended.php';

setBotApiCors();
header('Content-Type: application/json; charset=utf-8');

// Verify API Key for modifying requests
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    verifyBotApiKey();
}

$db = getDB();
$method = $_SERVER['REQUEST_METHOD'];

try {
    // ============================================
    // GET - List/Read Images
    // ============================================
    if ($method === 'GET') {
        
        $action = $_GET['action'] ?? 'list';
        
        // Get user's images
        if ($action === 'user') {
            $discordId = $_GET['discord_id'] ?? null;
            $limit = min((int)($_GET['limit'] ?? 50), 100);
            $offset = (int)($_GET['offset'] ?? 0);
            
            if (!$discordId) {
                sendError('Discord ID erforderlich');
            }
            
            $stmt = $db->prepare("
                SELECT 
                    gi.*,
                    du.username as user_username
                FROM generated_images gi
                LEFT JOIN discord_users du ON gi.discord_id = du.discord_id
                WHERE gi.discord_id = ?
                ORDER BY gi.created_at DESC
                LIMIT ? OFFSET ?
            ");
            $stmt->execute([$discordId, $limit, $offset]);
            $images = $stmt->fetchAll();
            
            // Count total
            $countStmt = $db->prepare("SELECT COUNT(*) as total FROM generated_images WHERE discord_id = ?");
            $countStmt->execute([$discordId]);
            $total = $countStmt->fetch()['total'];
            
            sendSuccess([
                'images' => $images,
                'count' => count($images),
                'total' => $total
            ]);
        }
        
        // Get specific image
        else if ($action === 'get') {
            $id = $_GET['id'] ?? null;
            
            if (!$id) {
                sendError('Image ID erforderlich');
            }
            
            $stmt = $db->prepare("
                SELECT 
                    gi.*,
                    du.username as user_username
                FROM generated_images gi
                LEFT JOIN discord_users du ON gi.discord_id = du.discord_id
                WHERE gi.id = ?
            ");
            $stmt->execute([$id]);
            $image = $stmt->fetch();
            
            if (!$image) {
                sendError('Bild nicht gefunden', 404);
            }
            
            sendSuccess($image);
        }
        
        // List all images (admin)
        else {
            $limit = min((int)($_GET['limit'] ?? 50), 100);
            $offset = (int)($_GET['offset'] ?? 0);
            $featured = isset($_GET['featured']) ? (bool)$_GET['featured'] : null;
            
            $sql = "
                SELECT 
                    gi.*,
                    du.username as user_username
                FROM generated_images gi
                LEFT JOIN discord_users du ON gi.discord_id = du.discord_id
                WHERE 1=1
            ";
            
            $params = [];
            
            if ($featured !== null) {
                $sql .= " AND gi.is_featured = ?";
                $params[] = $featured ? 1 : 0;
            }
            
            $sql .= " ORDER BY gi.created_at DESC LIMIT ? OFFSET ?";
            $params[] = $limit;
            $params[] = $offset;
            
            $stmt = $db->prepare($sql);
            $stmt->execute($params);
            $images = $stmt->fetchAll();
            
            // Count total
            $countSql = "SELECT COUNT(*) as total FROM generated_images WHERE 1=1";
            $countParams = [];
            
            if ($featured !== null) {
                $countSql .= " AND is_featured = ?";
                $countParams[] = $featured ? 1 : 0;
            }
            
            $countStmt = $db->prepare($countSql);
            $countStmt->execute($countParams);
            $total = $countStmt->fetch()['total'];
            
            sendSuccess([
                'images' => $images,
                'count' => count($images),
                'total' => $total
            ]);
        }
    }
    
    // ============================================
    // POST - Create/Update Image
    // ============================================
    else if ($method === 'POST') {
        
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input) {
            sendError('Ungültiger JSON');
        }
        
        $action = $input['action'] ?? 'create';
        
        // Create new image record
        if ($action === 'create') {
            $discordId = $input['discord_id'] ?? null;
            $prompt = $input['prompt'] ?? null;
            $revisedPrompt = $input['revised_prompt'] ?? null;
            $imageUrl = $input['image_url'] ?? null;
            $model = $input['model'] ?? 'dall-e-3';
            $size = $input['size'] ?? '1024x1024';
            
            if (!$discordId || !$prompt || !$imageUrl) {
                sendError('Discord ID, Prompt und Image URL erforderlich');
            }
            
            // Get or create Discord user
            $user = getDiscordUserById($db, $discordId);
            if (!$user) {
                upsertDiscordUser($db, ['discord_id' => $discordId]);
                $user = getDiscordUserById($db, $discordId);
            }
            
            // Insert image
            $stmt = $db->prepare("
                INSERT INTO generated_images 
                (discord_id, user_id, prompt, revised_prompt, image_url, model, size, created_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
            ");
            $stmt->execute([
                $discordId,
                $user['id'],
                $prompt,
                $revisedPrompt,
                $imageUrl,
                $model,
                $size
            ]);
            
            $imageId = $db->lastInsertId();
            
            logBotActivity($db, 'image_generated', "Image generated: $prompt", $user['id']);
            
            // Get created image
            $stmt = $db->prepare("SELECT * FROM generated_images WHERE id = ?");
            $stmt->execute([$imageId]);
            $image = $stmt->fetch();
            
            sendSuccess($image, 'Bild gespeichert');
        }
        
        // Toggle featured
        else if ($action === 'toggle_featured') {
            $id = $input['id'] ?? null;
            
            if (!$id) {
                sendError('Image ID erforderlich');
            }
            
            $stmt = $db->prepare("
                UPDATE generated_images 
                SET is_featured = NOT is_featured
                WHERE id = ?
            ");
            $stmt->execute([$id]);
            
            if ($stmt->rowCount() === 0) {
                sendError('Bild nicht gefunden', 404);
            }
            
            logBotActivity($db, 'image_featured_toggle', "Image ID $id featured toggled");
            
            sendSuccess([], 'Status aktualisiert');
        }
        
        else {
            sendError('Ungültige Action', 400);
        }
    }
    
    // ============================================
    // DELETE - Delete image
    // ============================================
    else if ($method === 'DELETE') {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            sendError('Image ID erforderlich');
        }
        
        $stmt = $db->prepare("DELETE FROM generated_images WHERE id = ?");
        $stmt->execute([$id]);
        
        if ($stmt->rowCount() === 0) {
            sendError('Bild nicht gefunden', 404);
        }
        
        logBotActivity($db, 'image_deleted', "Image ID $id deleted");
        
        sendSuccess([], 'Bild gelöscht');
    }
    
    else {
        sendError('Methode nicht erlaubt', 405);
    }
    
} catch (Exception $e) {
    logBotError('images_api', $e->getMessage());
    sendError('Serverfehler: ' . $e->getMessage(), 500);
}
