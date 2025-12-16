# Deployment Guide

This guide covers production deployment for the Engels811 Network website and Discord bot.

## Server Requirements
- Ubuntu 22.04 LTS (recommended)
- PHP 8.1+ with `pdo_mysql`, `curl`, `mbstring`, `openssl`
- MySQL 8.0+
- Apache or Nginx with HTTPS termination
- Systemd access for running services

## Web Server Configuration
### Apache Example
- Set `DocumentRoot` to `/var/www/engels811-network/website/public`.
- Enable `mod_rewrite` and `AllowOverride All` for clean URLs.
- Ensure the provided `.htaccess` is present.

### Nginx Example
```
server {
    listen 80;
    server_name engels811-ttv.de www.engels811-ttv.de;
    return 301 https://$host$request_uri;
}

server {
    listen 443 ssl;
    server_name engels811-ttv.de;
    root /var/www/engels811-network/website/public;
    index index.php;

    ssl_certificate /etc/letsencrypt/live/engels811-ttv.de/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/engels811-ttv.de/privkey.pem;

    location / {
        try_files $uri $uri/ /index.php?$args;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.1-fpm.sock;
    }
}
```

## SSL Setup
Use Let's Encrypt with certbot to provision certificates:
```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d engels811-ttv.de -d www.engels811-ttv.de
```

## Environment Variables
- Website config lives in `website/config/config.php` and `website/config/config_bot_extended.php` (copied from examples).
- Discord bot uses `.env` with `DISCORD_BOT_TOKEN`, `BOT_API_KEY`, and `GUILD_ID`.

## Database Migration
Run migrations after deployment:
```bash
mysql -u root -p engels811 < database/migrations/001_initial.sql
```

## Systemd Service for Discord Bot
Create `/etc/systemd/system/engels811-bot.service`:
```
[Unit]
Description=Engels811 Discord Bot
After=network.target

[Service]
Type=simple
User=www-data
WorkingDirectory=/var/www/engels811-network/discord-bot
Environment="PYTHONUNBUFFERED=1"
ExecStart=/usr/bin/python3 bot.py
Restart=always

[Install]
WantedBy=multi-user.target
```
Enable and start:
```bash
sudo systemctl daemon-reload
sudo systemctl enable engels811-bot
sudo systemctl start engels811-bot
```

## CI/CD
GitHub Actions workflow `.github/workflows/deploy.yml` runs on pushes to `main`. Configure SSH secrets (`SSH_HOST`, `SSH_USER`, `SSH_KEY`) to deploy to your server. Adjust the workflow commands to match your environment.
