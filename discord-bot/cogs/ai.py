import discord
from discord import app_commands
from discord.ext import commands
from utils.api_helper import api_request, error_embed

class AI(commands.Cog):
    def __init__(self, bot: commands.Bot):
        self.bot = bot

    @app_commands.command(name="generate", description="Generiere ein AI-Logo")
    async def generate(self, interaction: discord.Interaction, prompt: str):
        await interaction.response.defer()
        try:
            data = await api_request('images.php', 'POST', {'prompt': prompt, 'image_url': 'https://placehold.co/512', 'is_featured': False})
            image = data.get('data', {}).get('image', {})
            embed = discord.Embed(title="Dein Logo", description=prompt, color=0xff3050)
            embed.set_image(url=image.get('image_url'))
            await interaction.followup.send(embed=embed)
        except Exception as exc:  # noqa: BLE001
            await interaction.followup.send(embed=error_embed(str(exc)))

    @app_commands.command(name="gallery", description="Zeige featured Logos")
    async def gallery(self, interaction: discord.Interaction):
        try:
            data = await api_request('images.php?filter=featured')
            images = data.get('data', {}).get('images', [])[:5]
            embed = discord.Embed(title="Featured Galerie", color=0xff3050)
            for item in images:
                embed.add_field(name=item['prompt'], value=item['image_url'], inline=False)
            await interaction.response.send_message(embed=embed)
        except Exception as exc:  # noqa: BLE001
            await interaction.response.send_message(embed=error_embed(str(exc)), ephemeral=True)

def setup(bot: commands.Bot):
    bot.add_cog(AI(bot))
