<?php
/**
 * Discord OAuth API Handler
 * Handles Discord OAuth2 flow
 */

require_once __DIR__ . '/../../config.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

// ============================================
// ACTION: Login - Redirect to Discord
// ============================================
if ($action === 'login') {
    
    // Generate CSRF state
    $state = bin2hex(random_bytes(16));
    
    // Save state in database (expires in 10 minutes)
    try {
        $db = getDB();
        $stmt = $db->prepare("
            INSERT INTO oauth_states (state, user_ip, expires_at) 
            VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 10 MINUTE))
        ");
        $stmt->execute([$state, $_SERVER['REMOTE_ADDR'] ?? null]);
    } catch (Exception $e) {
        die(json_encode(['error' => 'Database error']));
    }
    
    // Build Discord OAuth URL
    $params = [
        'client_id' => DISCORD_CLIENT_ID,
        'redirect_uri' => DISCORD_REDIRECT_URI,
        'response_type' => 'code',
        'scope' => DISCORD_SCOPES,
        'state' => $state
    ];
    
    $url = DISCORD_AUTH_URL . '?' . http_build_query($params);
    
    // Redirect to Discord
    header('Location: ' . $url);
    exit;
}

// ============================================
// ACTION: Get Discord User Info
// ============================================
else if ($action === 'user') {
    
    if (!isset($_SESSION['discord_access_token'])) {
        sendError('Not authenticated', 401);
    }
    
    $userData = getDiscordUser($_SESSION['discord_access_token']);
    
    if ($userData) {
        sendSuccess($userData);
    } else {
        sendError('Failed to fetch user data', 500);
    }
}

// ============================================
// ACTION: Disconnect Discord
// ============================================
else if ($action === 'disconnect') {
    
    requireAuth();
    
    try {
        $db = getDB();
        $userId = $_SESSION['admin_id'];
        
        // Remove Discord data
        $stmt = $db->prepare("
            UPDATE admin_users 
            SET discord_id = NULL,
                discord_username = NULL,
                discord_discriminator = NULL,
                discord_avatar = NULL,
                discord_email = NULL,
                last_discord_sync = NULL
            WHERE id = ?
        ");
        $stmt->execute([$userId]);
        
        // Clear session data
        unset($_SESSION['discord_access_token']);
        unset($_SESSION['discord_id']);
        
        sendSuccess([], 'Discord disconnected');
    } catch (Exception $e) {
        sendError('Database error: ' . $e->getMessage(), 500);
    }
}

else {
    sendError('Invalid action', 400);
}

// ============================================
// HELPER: Get Discord User Data
// ============================================
function getDiscordUser($accessToken) {
    $ch = curl_init(DISCORD_API_URL . '/users/@me');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json'
        ]
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode === 200) {
        return json_decode($response, true);
    }
    
    return null;
}

// ============================================
// HELPER: Exchange Code for Token
// ============================================
function exchangeCodeForToken($code) {
    $data = [
        'client_id' => DISCORD_CLIENT_ID,
        'client_secret' => DISCORD_CLIENT_SECRET,
        'grant_type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => DISCORD_REDIRECT_URI
    ];
    
    $ch = curl_init(DISCORD_TOKEN_URL);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/x-www-form-urlencoded'
        ]
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode === 200) {
        return json_decode($response, true);
    }
    
    return null;
}
