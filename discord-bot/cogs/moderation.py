import discord
from discord import app_commands
from discord.ext import commands

class Moderation(commands.Cog):
    def __init__(self, bot: commands.Bot):
        self.bot = bot

    async def interaction_check(self, interaction: discord.Interaction) -> bool:
        return interaction.user.guild_permissions.manage_messages  # type: ignore[attr-defined]

    @app_commands.command(name="clear", description="Löscht Nachrichten")
    @app_commands.checks.has_permissions(manage_messages=True)
    async def clear(self, interaction: discord.Interaction, amount: int):
        channel = interaction.channel
        if isinstance(channel, discord.TextChannel):
            deleted = await channel.purge(limit=amount)
            await interaction.response.send_message(f"{len(deleted)} Nachrichten gelöscht", ephemeral=True)

    @app_commands.command(name="kick", description="Kicke einen Nutzer")
    @app_commands.checks.has_permissions(kick_members=True)
    async def kick(self, interaction: discord.Interaction, user: discord.Member, reason: str):
        await user.kick(reason=reason)
        await interaction.response.send_message(f"{user.display_name} wurde gekickt: {reason}")

    @app_commands.command(name="ban", description="Banne einen Nutzer")
    @app_commands.checks.has_permissions(ban_members=True)
    async def ban(self, interaction: discord.Interaction, user: discord.Member, reason: str):
        await user.ban(reason=reason)
        await interaction.response.send_message(f"{user.display_name} wurde gebannt: {reason}")

def setup(bot: commands.Bot):
    bot.add_cog(Moderation(bot))
