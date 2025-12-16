#!/usr/bin/env bash
set -euo pipefail

echo "[1/4] Copying config samples..."
cp -n website/config/config.php.example website/config/config.php || true
cp -n website/config/config_bot_extended.php.example website/config/config_bot_extended.php || true
cp -n discord-bot/.env.example discord-bot/.env || true

echo "[2/4] Installing Python dependencies..."
python3 -m venv .venv
source .venv/bin/activate
pip install -r discord-bot/requirements.txt

echo "[3/4] Creating database (if not exists)..."
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS engels811 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -u root -p engels811 < database/schema.sql


echo "[4/4] Done. Update configs and run services."
