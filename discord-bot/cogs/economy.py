import discord
from discord import app_commands
from discord.ext import commands
from utils.api_helper import api_request, error_embed

class Economy(commands.Cog):
    def __init__(self, bot: commands.Bot):
        self.bot = bot

    @app_commands.command(name="balance", description="Zeigt dein Guthaben")
    async def balance(self, interaction: discord.Interaction, user: discord.User | None = None):
        target = user or interaction.user
        try:
            data = await api_request(f"economy.php?discord_id={target.id}")
            bal = data.get('data', {})
            embed = discord.Embed(title=f"Kontostand von {target.display_name}", color=0xff3050)
            embed.add_field(name="Wallet", value=bal.get('balance', 0))
            embed.add_field(name="Bank", value=bal.get('bank_balance', 0))
            await interaction.response.send_message(embed=embed)
        except Exception as exc:  # noqa: BLE001
            await interaction.response.send_message(embed=error_embed(str(exc)), ephemeral=True)

    @app_commands.command(name="daily", description="Tägliche Belohnung")
    async def daily(self, interaction: discord.Interaction):
        await self._reward(interaction, 'daily')

    @app_commands.command(name="work", description="Verdiene Coins")
    async def work(self, interaction: discord.Interaction):
        await self._reward(interaction, 'work')

    async def _reward(self, interaction: discord.Interaction, action: str):
        await interaction.response.defer(ephemeral=True)
        try:
            data = await api_request('economy.php', 'POST', {'action': action, 'discord_id': interaction.user.id})
            amount = data.get('data', {}).get('amount', 0)
            await interaction.followup.send(f"{action.title()} abgeschlossen! +{amount} Coins")
        except Exception as exc:  # noqa: BLE001
            await interaction.followup.send(embed=error_embed(str(exc)))

    @app_commands.command(name="leaderboard", description="Top 10 Nutzer")
    async def leaderboard(self, interaction: discord.Interaction):
        embed = discord.Embed(title="Leaderboard", description="Kommt bald", color=0xff3050)
        await interaction.response.send_message(embed=embed, ephemeral=True)

def setup(bot: commands.Bot):
    bot.add_cog(Economy(bot))
