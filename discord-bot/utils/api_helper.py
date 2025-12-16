import aiohttp
from discord import Embed
import config

async def api_request(endpoint: str, method: str = 'GET', data=None):
    url = f"{config.API_BASE_URL}/{endpoint}"
    headers = {'X-API-KEY': config.API_KEY} if config.API_KEY else {}
    async with aiohttp.ClientSession(headers=headers) as session:
        async with session.request(method, url, json=data) as resp:
            resp.raise_for_status()
            return await resp.json()


def error_embed(message: str) -> Embed:
    return Embed(title="Fehler", description=message, color=0xff3050)
