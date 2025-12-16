# Engels811 Network

![PHP](https://img.shields.io/badge/PHP-8.1-777bb3?logo=php) ![Python](https://img.shields.io/badge/Python-3.11-3776ab?logo=python) ![Discord](https://img.shields.io/badge/Discord-Bot-5865f2?logo=discord) ![License: MIT](https://img.shields.io/badge/License-MIT-green)

Engels811 Network is a modern streaming platform that combines a responsive PHP MVC website, a Discord bot with an economy system, and RESTful APIs to keep everything in sync.

## Features
- Neon-inspired gaming design with responsive layouts
- AI-generated logo gallery with filters and lightbox
- YouTube video and Spotify playlist integrations
- Live Twitch stream embed with status check
- Discord bot with economy, moderation, and AI tools
- RESTful bot API endpoints for images, videos, economy, and tickets
- MySQL schema and migration for persistent data
- Comprehensive documentation for installation, deployment, and API usage

## Quick Start
1. Clone the repository:
   ```bash
   git clone https://github.com/yourname/engels811-network.git
   cd engels811-network
   ```
2. Follow [INSTALLATION.md](docs/INSTALLATION.md) to configure the website, database, and Discord bot.
3. Use `docker-compose up -d` to spin up the stack (optional) or configure Apache/Nginx manually.

## Tech Stack
- PHP 8.1+, Apache/Nginx, MySQL
- JavaScript (vanilla, modular helpers)
- Python 3.11, discord.py 2.3+, aiohttp
- GitHub Actions for CI/CD

## Project Structure
```
website/         PHP MVC website
├─ public/       Public assets and entry point
├─ app/          Core, controllers, views, services
├─ api/bot/      REST endpoints for the Discord bot
├─ config/       Configuration examples
└─ data/         Static data (e.g., hardware specs)

discord-bot/     Discord bot with cogs

database/        SQL schema and migrations

docs/            Documentation

scripts/         Setup and deployment helpers
.github/         Workflows and issue templates
```

## Installation
See [INSTALLATION.md](docs/INSTALLATION.md) for detailed setup instructions, including configuration, database schema import, and running the bot.

## License
This project is licensed under the MIT License. See [LICENSE](LICENSE) for details.

## Acknowledgments
- Inspired by the Engels811 community and streaming setup.
- Built with love for creators who want a cohesive platform across web and Discord.
