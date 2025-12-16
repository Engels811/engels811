import { apiGet, openLightbox, formatNumber } from './main.js';

async function loadFeaturedImages() {
  const container = document.querySelector('#featured-images');
  if (!container) return;
  const res = await apiGet('/api/bot/images.php?filter=featured&limit=6');
  if (!res.success) return;
  container.innerHTML = '';
  res.data.images.forEach((img) => {
    const card = document.createElement('div');
    card.className = 'gallery-item';
    card.innerHTML = `<img src="${img.image_url}" alt="${img.prompt}"><span class="tag">Featured</span>`;
    card.addEventListener('click', () => openLightbox(img.image_url));
    container.appendChild(card);
  });
}

async function loadLatestVideos() {
  const container = document.querySelector('#latest-videos');
  if (!container) return;
  const res = await apiGet('/api/bot/videos.php?limit=3');
  if (!res.success) return;
  container.innerHTML = '';
  res.data.videos.forEach((video) => {
    const card = document.createElement('div');
    card.className = 'card';
    card.innerHTML = `<iframe src="https://www.youtube.com/embed/${video.video_id}" allowfullscreen loading="lazy"></iframe><h3>${video.title}</h3>`;
    container.appendChild(card);
  });
}

function populateStats() {
  const statsEl = document.querySelector('#stats');
  if (!statsEl || !statsEl.dataset) return;
  const { images, videos, members, tickets } = statsEl.dataset;
  const values = { images, videos, members, tickets };
  statsEl.querySelectorAll('[data-stat]').forEach((el) => {
    const key = el.dataset.stat;
    const val = values[key];
    el.querySelector('strong').textContent = formatNumber(Number(val));
  });
}

loadFeaturedImages();
loadLatestVideos();
populateStats();
