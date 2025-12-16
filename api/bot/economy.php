<?php
/**
 * Economy API - User Coins & Transactions
 * PFAD: /api/bot/economy.php
 */

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/config_bot_extended.php';

setBotApiCors();
header('Content-Type: application/json; charset=utf-8');

verifyBotApiKey();

$db = getDB();
$method = $_SERVER['REQUEST_METHOD'];

try {
    // ============================================
    // GET - Balance & Transactions
    // ============================================
    if ($method === 'GET') {
        
        $action = $_GET['action'] ?? 'balance';
        
        // Get user balance
        if ($action === 'balance') {
            $discordId = $_GET['discord_id'] ?? null;
            
            if (!$discordId) {
                sendError('Discord ID erforderlich');
            }
            
            $stmt = $db->prepare("
                SELECT balance, bank_balance, daily_streak, last_daily, last_work
                FROM discord_users 
                WHERE discord_id = ?
            ");
            $stmt->execute([$discordId]);
            $user = $stmt->fetch();
            
            if (!$user) {
                // Create user with 0 balance
                upsertDiscordUser($db, ['discord_id' => $discordId]);
                $user = [
                    'balance' => 0,
                    'bank_balance' => 0,
                    'daily_streak' => 0,
                    'last_daily' => null,
                    'last_work' => null
                ];
            }
            
            sendSuccess([
                'balance' => (int)$user['balance'],
                'bank_balance' => (int)$user['bank_balance'],
                'total' => (int)$user['balance'] + (int)$user['bank_balance'],
                'daily_streak' => (int)$user['daily_streak'],
                'last_daily' => $user['last_daily'],
                'last_work' => $user['last_work']
            ]);
        }
        
        // Get transactions
        else if ($action === 'transactions') {
            $discordId = $_GET['discord_id'] ?? null;
            $limit = min((int)($_GET['limit'] ?? 50), 100);
            $offset = (int)($_GET['offset'] ?? 0);
            
            if (!$discordId) {
                sendError('Discord ID erforderlich');
            }
            
            $stmt = $db->prepare("
                SELECT * FROM economy_transactions 
                WHERE discord_id = ?
                ORDER BY created_at DESC
                LIMIT ? OFFSET ?
            ");
            $stmt->execute([$discordId, $limit, $offset]);
            $transactions = $stmt->fetchAll();
            
            sendSuccess([
                'transactions' => $transactions,
                'count' => count($transactions)
            ]);
        }
        
        else {
            sendError('Ungültige Action', 400);
        }
    }
    
    // ============================================
    // POST - Charge/Add Coins
    // ============================================
    else if ($method === 'POST') {
        
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input) {
            sendError('Ungültiger JSON');
        }
        
        $action = $input['action'] ?? 'charge';
        $discordId = $input['discord_id'] ?? null;
        $amount = (int)($input['amount'] ?? 0);
        $reason = $input['reason'] ?? 'Transaction';
        
        if (!$discordId) {
            sendError('Discord ID erforderlich');
        }
        
        if ($amount <= 0) {
            sendError('Betrag muss positiv sein');
        }
        
        // Get user
        $stmt = $db->prepare("SELECT * FROM discord_users WHERE discord_id = ?");
        $stmt->execute([$discordId]);
        $user = $stmt->fetch();
        
        if (!$user) {
            upsertDiscordUser($db, ['discord_id' => $discordId]);
            $stmt->execute([$discordId]);
            $user = $stmt->fetch();
        }
        
        // Charge user (deduct coins)
        if ($action === 'charge') {
            $currentBalance = (int)$user['balance'];
            
            if ($currentBalance < $amount) {
                sendError('Nicht genug Coins', 400);
            }
            
            $newBalance = $currentBalance - $amount;
            
            // Update balance
            $stmt = $db->prepare("UPDATE discord_users SET balance = ? WHERE id = ?");
            $stmt->execute([$newBalance, $user['id']]);
            
            // Log transaction
            $stmt = $db->prepare("
                INSERT INTO economy_transactions 
                (user_id, discord_id, type, amount, balance_before, balance_after, description, created_at)
                VALUES (?, ?, 'purchase', ?, ?, ?, ?, NOW())
            ");
            $stmt->execute([
                $user['id'],
                $discordId,
                -$amount,
                $currentBalance,
                $newBalance,
                $reason
            ]);
            
            sendSuccess([
                'balance_before' => $currentBalance,
                'balance_after' => $newBalance,
                'amount_charged' => $amount
            ], 'Coins abgebucht');
        }
        
        // Add coins
        else if ($action === 'add') {
            $currentBalance = (int)$user['balance'];
            $newBalance = $currentBalance + $amount;
            
            // Update balance
            $stmt = $db->prepare("UPDATE discord_users SET balance = ? WHERE id = ?");
            $stmt->execute([$newBalance, $user['id']]);
            
            // Log transaction
            $stmt = $db->prepare("
                INSERT INTO economy_transactions 
                (user_id, discord_id, type, amount, balance_before, balance_after, description, created_at)
                VALUES (?, ?, 'reward', ?, ?, ?, ?, NOW())
            ");
            $stmt->execute([
                $user['id'],
                $discordId,
                $amount,
                $currentBalance,
                $newBalance,
                $reason
            ]);
            
            sendSuccess([
                'balance_before' => $currentBalance,
                'balance_after' => $newBalance,
                'amount_added' => $amount
            ], 'Coins hinzugefügt');
        }
        
        else {
            sendError('Ungültige Action', 400);
        }
    }
    
    else {
        sendError('Methode nicht erlaubt', 405);
    }
    
} catch (Exception $e) {
    logBotError('economy_api', $e->getMessage());
    sendError('Serverfehler: ' . $e->getMessage(), 500);
}
