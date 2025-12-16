<?php
/**
 * Authentication API
 * Login, Logout, Check Session
 */

// Wenn config.php im selben Ordner liegt:
require_once __DIR__ . '/config.php';

// Session kommt aus config.php – nicht doppelt starten

// CORS Headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

$db = getDB();
$method = $_SERVER['REQUEST_METHOD'];

// ============================================
// POST - Login
// ============================================
if ($method === 'POST') {
    
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (empty($input['username']) || empty($input['password'])) {
        sendError('Username und Passwort erforderlich');
    }
    
    try {
        $stmt = $db->prepare("SELECT * FROM admin_users WHERE username = ?");
        $stmt->execute([$input['username']]);
        $user = $stmt->fetch();
        
        if (!$user) {
            sendError('Ungültige Anmeldedaten', 401);
        }
        
        if (!password_verify($input['password'], $user['password_hash'])) {
            sendError('Ungültige Anmeldedaten', 401);
        }
        
        if (isset($user['is_active']) && $user['is_active'] != 1) {
            sendError('Dein Account wurde deaktiviert. Kontaktiere einen Administrator.', 403);
        }
        
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_username'] = $user['username'];
        $_SESSION['admin_role'] = $user['role'] ?? 'moderator';
        $_SESSION['logged_in'] = true;
        
        $stmt = $db->prepare("UPDATE admin_users SET last_login = NOW() WHERE id = ?");
        $stmt->execute([$user['id']]);
        
        sendSuccess([
            'id' => $user['id'],
            'username' => $user['username'],
            'role' => $_SESSION['admin_role']
        ], 'Login erfolgreich');
        
    } catch (PDOException $e) {
        sendError('Fehler beim Login: ' . $e->getMessage(), 500);
    }
}

// ============================================
// GET - Check Session / Logout
// ============================================
else if ($method === 'GET') {
    
    $action = $_GET['action'] ?? 'check';
    
    if ($action === 'logout') {
        session_destroy();
        sendSuccess([], 'Erfolgreich abgemeldet');
    }
    
    if ($action === 'check') {

        if (!empty($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            sendSuccess([
                'logged_in' => true,
                'username' => $_SESSION['admin_username'],
                'id' => $_SESSION['admin_id'],
                'role' => $_SESSION['admin_role']
            ]);
        }

        sendSuccess(['logged_in' => false]);
    }
}

else {
    sendError('Methode nicht erlaubt', 405);
}
