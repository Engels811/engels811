import { apiGet, openLightbox, qsa } from './main.js';

const galleryEl = document.querySelector('.gallery-grid');
const filters = qsa('[data-filter]');
let currentFilter = 'all';
let page = 1;

async function loadImages(reset = false) {
  if (!galleryEl) return;
  if (reset) {
    galleryEl.innerHTML = '';
    page = 1;
  }
  const response = await apiGet(`/api/bot/images.php?filter=${currentFilter}&page=${page}`);
  if (!response.success) return;
  response.data.images.forEach((item) => {
    const card = document.createElement('div');
    card.className = 'gallery-item';
    card.innerHTML = `<img src="${item.image_url}" alt="${item.prompt}"><span class="tag">${item.is_featured ? 'Featured' : 'Neu'}</span>`;
    card.addEventListener('click', () => openLightbox(item.image_url));
    galleryEl.appendChild(card);
  });
  page += 1;
}

filters.forEach((btn) => {
  btn.addEventListener('click', () => {
    currentFilter = btn.dataset.filter;
    filters.forEach((el) => el.classList.remove('active'));
    btn.classList.add('active');
    loadImages(true);
  });
});

const loadMoreBtn = document.querySelector('#load-more-images');
if (loadMoreBtn) {
  loadMoreBtn.addEventListener('click', () => loadImages());
}

loadImages();
