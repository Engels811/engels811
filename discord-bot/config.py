import os
from dotenv import load_dotenv

load_dotenv()

TOKEN = os.getenv('DISCORD_BOT_TOKEN')
API_BASE_URL = "https://wiki.engels811-ttv.de/api/bot"
API_KEY = os.getenv('BOT_API_KEY')
GUILD_ID = os.getenv('GUILD_ID')
