import { apiGet } from './main.js';

const videoGrid = document.querySelector('.video-grid');
const featured = document.querySelector('#featured-video');
let page = 1;

async function loadVideos() {
  if (!videoGrid) return;
  const response = await apiGet(`/api/bot/videos.php?page=${page}`);
  if (!response.success) return;

  response.data.videos.forEach((video, index) => {
    if (page === 1 && index === 0 && featured) {
      featured.innerHTML = `<div class="card"><h3>Neueste Episode</h3><iframe src="https://www.youtube.com/embed/${video.video_id}" allowfullscreen loading="lazy"></iframe><p>${video.title}</p></div>`;
      return;
    }
    const card = document.createElement('div');
    card.className = 'card';
    card.innerHTML = `<iframe src="https://www.youtube.com/embed/${video.video_id}" allowfullscreen loading="lazy"></iframe><h3>${video.title}</h3><p>${video.description}</p>`;
    videoGrid.appendChild(card);
  });
  page += 1;
}

const loadMoreVideos = document.querySelector('#load-more-videos');
if (loadMoreVideos) {
  loadMoreVideos.addEventListener('click', () => loadVideos());
}

loadVideos();
