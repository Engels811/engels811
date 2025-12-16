document.addEventListener("DOMContentLoaded", () => {
  const M = window.WLN_MEDIA;
  if (!M) return;

  // Logo
  const logo = document.querySelector(".nav-logo");
  if (logo) logo.src = M.logo;

  // Hero
  const heroBg = document.querySelector(".hero-bg");
  if (heroBg) {
    heroBg.style.backgroundImage = `
      linear-gradient(
        to bottom,
        rgba(10,4,25,.15),
        rgba(10,4,25,.55),
        rgba(5,1,13,1)
      ),
      url('${M.hero.city}')
    `;
  }

  // Projekte
  document.querySelector("[data-project='city'] img").src = M.projects.city;
  document.querySelector("[data-project='fm'] img").src = M.projects.fm;
  document.querySelector("[data-project='dev'] img").src = M.projects.dev;

  // Discord
  document.querySelector("[data-discord='city'] img").src = M.discord.city;
  document.querySelector("[data-discord='logs'] img").src = M.discord.logs;
});
