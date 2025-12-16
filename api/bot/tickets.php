<?php
/*
 * Tickets API Endpoint
 * Handles ticket creation and management
 */

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/config_bot_extended.php';

header('Content-Type: application/json');

// Verify API key
$headers = getallheaders();
$provided_key = $headers['X-API-Key'] ?? '';

if ($provided_key !== BOT_API_KEY) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? ($_POST['action'] ?? '');

try {
    $pdo = get_pdo_connection();
    
    switch ($action) {
        case 'create':
            if ($method !== 'POST') {
                throw new Exception('Method not allowed');
            }
            
            $input = json_decode(file_get_contents('php://input'), true);
            $discord_id = $input['discord_id'] ?? null;
            $username = $input['username'] ?? '';
            $subject = $input['subject'] ?? '';
            $description = $input['description'] ?? '';
            $priority = $input['priority'] ?? 'medium';
            
            if (!$discord_id || !$subject || !$description) {
                throw new Exception('Missing required fields');
            }
            
            $stmt = $pdo->prepare("
                INSERT INTO support_tickets (discord_id, username, subject, description, priority, status)
                VALUES (:discord_id, :username, :subject, :description, :priority, 'open')
            ");
            
            $stmt->execute([
                'discord_id' => $discord_id,
                'username' => $username,
                'subject' => $subject,
                'description' => $description,
                'priority' => $priority
            ]);
            
            $ticket_id = $pdo->lastInsertId();
            
            echo json_encode([
                'success' => true,
                'data' => ['ticket_id' => $ticket_id]
            ]);
            break;
            
        case 'user':
            $discord_id = $_GET['discord_id'] ?? null;
            if (!$discord_id) {
                throw new Exception('discord_id required');
            }
            
            $stmt = $pdo->prepare("
                SELECT * FROM support_tickets
                WHERE discord_id = :discord_id AND status != 'closed'
                ORDER BY created_at DESC
            ");
            
            $stmt->execute(['discord_id' => $discord_id]);
            $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode([
                'success' => true,
                'data' => ['tickets' => $tickets]
            ]);
            break;
            
        default:
            throw new Exception('Invalid action');
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
