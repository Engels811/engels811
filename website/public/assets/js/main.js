const navToggle = document.querySelector('.mobile-toggle');
const navLinks = document.querySelector('.nav-links');

if (navToggle && navLinks) {
  navToggle.addEventListener('click', () => {
    navLinks.classList.toggle('open');
  });
}

export const formatNumber = (value) => value.toLocaleString('de-DE');
export const qs = (sel) => document.querySelector(sel);
export const qsa = (sel) => Array.from(document.querySelectorAll(sel));

// Lightbox
const lightbox = document.createElement('div');
lightbox.id = 'lightbox';
lightbox.style.cssText = 'position:fixed;inset:0;background:rgba(0,0,0,.8);display:none;align-items:center;justify-content:center;z-index:99;';
const img = document.createElement('img');
img.style.maxWidth = '90%';
img.style.maxHeight = '90%';
lightbox.appendChild(img);
document.body.appendChild(lightbox);

lightbox.addEventListener('click', () => (lightbox.style.display = 'none'));

export function openLightbox(src) {
  img.src = src;
  lightbox.style.display = 'flex';
}

export async function apiGet(endpoint) {
  const res = await fetch(endpoint);
  if (!res.ok) throw new Error('API request failed');
  return res.json();
}

export function smoothScroll(selector) {
  const el = qs(selector);
  if (el) el.scrollIntoView({ behavior: 'smooth' });
}
