import discord
from discord import app_commands
from discord.ext import commands
import config

class General(commands.Cog):
    def __init__(self, bot: commands.Bot):
        self.bot = bot

    @app_commands.command(name="help", description="Zeige alle Commands")
    async def help(self, interaction: discord.Interaction):
        embed = discord.Embed(title="Engels811 Bot", description="Befehlsübersicht", color=0xff3050)
        embed.add_field(name="/info", value="Bot Informationen", inline=False)
        embed.add_field(name="/stats", value="Server Statistiken", inline=False)
        embed.add_field(name="/ping", value="Latenz prüfen", inline=False)
        await interaction.response.send_message(embed=embed, ephemeral=True)

    @app_commands.command(name="info", description="Informationen zum Bot")
    async def info(self, interaction: discord.Interaction):
        embed = discord.Embed(title="Engels811 Network", description="Streaming Plattform & Bot", color=0xff3050)
        embed.add_field(name="API", value=config.API_BASE_URL, inline=False)
        await interaction.response.send_message(embed=embed, ephemeral=True)

    @app_commands.command(name="stats", description="Server Statistiken")
    async def stats(self, interaction: discord.Interaction):
        guild = interaction.guild
        if not guild:
            await interaction.response.send_message("Nur in Servern verfügbar", ephemeral=True)
            return
        members = guild.member_count
        channels = len(guild.channels)
        embed = discord.Embed(title="Server Stats", color=0xff3050)
        embed.add_field(name="Mitglieder", value=members)
        embed.add_field(name="Channels", value=channels)
        await interaction.response.send_message(embed=embed)

    @app_commands.command(name="ping", description="Zeigt die Bot-Latenz")
    async def ping(self, interaction: discord.Interaction):
        await interaction.response.send_message(f"Pong! {round(self.bot.latency * 1000)}ms")

def setup(bot: commands.Bot):
    bot.add_cog(General(bot))
