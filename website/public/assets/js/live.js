import { apiGet } from './main.js';

async function loadLiveStatus() {
  const statusEl = document.querySelector('#live-status');
  if (!statusEl) return;
  try {
    const res = await apiGet('/api/bot/videos.php?limit=1');
    statusEl.textContent = res.success ? 'Live-Status: online 🚀' : 'Status nicht verfügbar';
  } catch (e) {
    statusEl.textContent = 'Status nicht verfügbar';
  }
}

loadLiveStatus();
