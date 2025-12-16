import asyncio
import logging
import os

import discord
from discord.ext import commands, tasks

import config

logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

intents = discord.Intents.default()
intents.message_content = True
intents.members = True
intents.guilds = True

bot = commands.Bot(command_prefix="!", intents=intents)

STATUS_MESSAGES = [
    "engels811-ttv.de",
    "Twitch & YouTube",
    "AI Logos im Katalog",
]

@bot.event
async def on_ready():
    logger.info("Bot online als %s", bot.user)
    try:
        synced = await bot.tree.sync(guild=discord.Object(id=int(config.GUILD_ID))) if config.GUILD_ID else await bot.tree.sync()
        logger.info("Slash Commands synchronisiert: %s", len(synced))
    except Exception as exc:  # noqa: BLE001
        logger.exception("Fehler beim Sync: %s", exc)
    cycle_status.start()

@bot.event
async def on_member_join(member: discord.Member):
    try:
        await member.send("Willkommen bei Engels811 Network!")
    except discord.Forbidden:
        logger.info("Konnte %s nicht anschreiben", member)

@bot.event
async def on_command_error(ctx: commands.Context, error: commands.CommandError):
    await ctx.send(f"Fehler: {error}")

@tasks.loop(minutes=5)
async def cycle_status():
    for status in STATUS_MESSAGES:
        await bot.change_presence(activity=discord.Game(name=status))
        await asyncio.sleep(60)


async def load_cogs():
    for ext in ("cogs.general", "cogs.ai", "cogs.economy", "cogs.moderation"):
        await bot.load_extension(ext)


def main():
    token = config.TOKEN or os.getenv('DISCORD_BOT_TOKEN')
    if not token:
        raise RuntimeError("DISCORD_BOT_TOKEN nicht gesetzt")
    bot.remove_command('help')
    bot.loop.create_task(load_cogs())
    bot.run(token)


if __name__ == "__main__":
    main()
