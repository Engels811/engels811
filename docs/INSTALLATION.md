# Installation Guide

Follow these steps to set up the Engels811 Network locally or on a development server.

## Prerequisites
- PHP 8.1+ with PDO MySQL extension
- MySQL 8.0+
- Python 3.11+
- Composer (for dependency management if you add packages)
- Node.js (optional for tooling)
- Git, cURL, and OpenSSL

## 1) Clone the Repository
```bash
git clone https://github.com/yourname/engels811-network.git
cd engels811-network
```

## 2) Configure the Website
1. Copy the sample config:
   ```bash
   cp website/config/config.php.example website/config/config.php
   cp website/config/config_bot_extended.php.example website/config/config_bot_extended.php
   ```
2. Update database credentials, API URLs, and bot API keys in the copied files.
3. Ensure `website/public` is configured as the web root in Apache/Nginx.

## 3) Database Setup
1. Create the database:
   ```bash
   mysql -u root -p -e "CREATE DATABASE engels811 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
   ```
2. Import the schema:
   ```bash
   mysql -u root -p engels811 < database/schema.sql
   ```
3. Apply migrations as needed:
   ```bash
   mysql -u root -p engels811 < database/migrations/001_initial.sql
   ```

## 4) Discord Bot Setup
1. Create a Discord application and bot, invite it to your guild with the required intents.
2. Install Python dependencies:
   ```bash
   cd discord-bot
   python3 -m venv .venv
   source .venv/bin/activate
   pip install -r requirements.txt
   ```
3. Copy the environment file:
   ```bash
   cp .env.example .env
   ```
4. Fill in `DISCORD_BOT_TOKEN`, `BOT_API_KEY`, and `GUILD_ID`.
5. Run the bot:
   ```bash
   python bot.py
   ```

## 5) Optional Docker Setup
If you want to run via Docker Compose:
```bash
docker-compose up -d
```
This will start PHP/Apache, MySQL, and the Discord bot container as defined in `docker-compose.yml`.

## 6) Verify
- Open the website at your configured host and ensure pages load.
- Use the Discord slash commands `/ping` or `/help` to confirm the bot is online.
- Check API endpoints under `/api/bot` for JSON responses.
