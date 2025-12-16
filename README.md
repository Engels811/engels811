# 🌐 Engels811 Website - Öffentliche Webseite

**Komplette öffentliche Website mit:**
- 🏠 Startseite mit Featured Content
- 🎨 AI-Logo Galerie mit Lightbox
- 🎥 YouTube Videos mit Embeds
- 🎵 Spotify Playlisten
- 💻 Hardware Setup
- 🔴 Live Stream (Twitch)
- ℹ️ About Seite

---

## 📦 Enthält:

```
engels811-website/
├── index.php              # 🏠 Startseite
├── gallery.php            # 🎨 Bildergalerie
├── videos.php             # 🎥 YouTube Videos
├── playlists.php          # 🎵 Musik Playlisten
├── hardware.php           # 💻 Gaming Setup
├── live.php               # 🔴 Live Stream
├── about.php              # ℹ️ About Page
│
├── includes/
│   ├── header.php         # Header Component
│   └── footer.php         # Footer Component
│
├── assets/
│   ├── css/
│   │   └── style.css      # Main Stylesheet (Wolf-Theme)
│   └── js/
│       └── main.js        # JavaScript Funktionen
│
└── api/
    └── bot/
        ├── images.php              # Bestehende Image API
        ├── videos.php              # Bestehende Video API
        ├── images_extended.php     # Featured, Count, Views
        └── videos_extended.php     # Count Endpoint
```

---

## 🚀 Installation

### 1. Dateien hochladen

```bash
# Alle PHP Seiten in Root
cp *.php /var/www/html/wiki.engels811-ttv.de/

# Includes
cp -r includes /var/www/html/wiki.engels811-ttv.de/

# Assets
cp -r assets /var/www/html/wiki.engels811-ttv.de/

# API Files (erweitert)
cp api/bot/*.php /var/www/html/wiki.engels811-ttv.de/api/bot/
```

### 2. Apache/Nginx Config

**.htaccess (falls noch nicht vorhanden):**
```apache
RewriteEngine On

# Redirect www to non-www
RewriteCond %{HTTP_HOST} ^www\.(.*)$ [NC]
RewriteRule ^(.*)$ https://%1/$1 [R=301,L]

# HTTPS Redirect
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

# Clean URLs (optional)
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^([^\.]+)$ $1.php [NC,L]
```

### 3. Permissions

```bash
chmod 644 /var/www/html/wiki.engels811-ttv.de/*.php
chmod 755 /var/www/html/wiki.engels811-ttv.de/assets
chmod 644 /var/www/html/wiki.engels811-ttv.de/assets/css/*
chmod 644 /var/www/html/wiki.engels811-ttv.de/assets/js/*
```

---

## 🎨 Design Features

### Engels811 Theme:
- **Primary Color:** `#ff3050` (Neon Red)
- **Dark Background:** `#0a0a0a`
- **Wolf Aesthetic** 🐺
- **Gaming Vibes** 🎮
- **Responsive Design** 📱

### CSS Highlights:
- Custom CSS Variables
- Smooth Animations
- Hover Effects
- Lightbox Gallery
- Mobile Menu
- Scroll-to-Top Button

---

## 📄 Seiten-Übersicht

### 🏠 **index.php** - Startseite
- Hero Section mit Call-to-Actions
- Featured AI-Logos (letzte 6)
- Neueste Videos (letzte 3)
- Statistiken (Stream-Stunden, Community, etc.)
- Community Call-to-Action

### 🎨 **gallery.php** - Galerie
- Alle AI-generierten Logos
- Filter: Alle / Featured / Neueste
- Lightbox für große Ansicht
- View-Counter
- Load More Funktion

### 🎥 **videos.php** - Videos
- Neuestes Video als Highlight (Embed)
- Video Grid mit Thumbnails
- YouTube Links
- View Counter & Datum
- Load More Funktion

### 🎵 **playlists.php** - Playlisten
- Spotify Embeds (4 Playlists)
- Gaming Vibes
- Hype Tracks
- Chill Sessions
- Speedrun Mode

### 💻 **hardware.php** - Hardware
- PC Specs (GPU, CPU, RAM, etc.)
- Peripherals (Mouse, Keyboard, Headset)
- Streaming Equipment
- Lighting & Green Screen
- Consoles

### 🔴 **live.php** - Live Stream
- Twitch Embed (Player)
- Twitch Chat Embed
- Stream Schedule
- Live Status Check
- Social Links

### ℹ️ **about.php** - About
- Über Engels811
- Lieblingsspiele
- Statistiken
- Social Media Links
- Community CTA

---

## 🔌 API Integration

Die Website nutzt folgende API Endpoints:

### Images API:
```javascript
// Featured Images
GET /api/bot/images.php?action=featured&limit=6

// All Images
GET /api/bot/images.php?action=list&limit=12&page=1

// Recent Images
GET /api/bot/images.php?action=recent&limit=12

// Count
GET /api/bot/images.php?action=count

// Track View
POST /api/bot/images.php?action=track_view
```

### Videos API:
```javascript
// List Videos
GET /api/bot/videos.php?action=list&limit=12&page=1

// Count
GET /api/bot/videos.php?action=count
```

---

## 📱 Responsive Design

### Breakpoints:
- **Desktop:** 1400px+
- **Tablet:** 768px - 1399px
- **Mobile:** <768px

### Mobile Features:
- Hamburger Menu
- Touch-optimized
- Optimized Images
- Stacked Layouts

---

## ⚡ Performance

### Optimierungen:
- ✅ Lazy Loading für Bilder
- ✅ CSS/JS Minification (optional)
- ✅ Async Loading
- ✅ Optimierte Grid Layouts
- ✅ Caching Headers
- ✅ Responsive Images

---

## 🎯 Features

### Interaktivität:
- ✅ Mobile Navigation Toggle
- ✅ Lightbox für Galerie
- ✅ Smooth Scroll
- ✅ Scroll-to-Top Button
- ✅ Scroll Animations
- ✅ Load More Buttons

### Social Integration:
- ✅ Twitch Embed
- ✅ YouTube Embeds
- ✅ Spotify Embeds
- ✅ Social Links (Discord, Twitter, etc.)

---

## 🔧 Anpassungen

### Design ändern:
```css
/* In /assets/css/style.css */
:root {
    --primary: #ff3050;  /* Deine Farbe */
    --dark: #0a0a0a;     /* Hintergrund */
}
```

### Links anpassen:
```php
/* In /includes/footer.php und Header */
https://twitch.tv/engels811    → Dein Twitch
https://youtube.com/@engels811 → Dein YouTube
https://discord.gg/engels811   → Dein Discord
```

### Hardware Specs:
```php
/* In /hardware.php */
Ändere die Specs in den Cards
```

---

## 🆕 Updates

### V1.0 Features:
- ✅ Alle 7 Seiten komplett
- ✅ API Integration
- ✅ Responsive Design
- ✅ Engels811 Wolf-Theme
- ✅ Lightbox Gallery
- ✅ Live Stream Integration
- ✅ Social Media Links

---

## 💡 Tipps

### SEO Optimierung:
1. Meta Tags in Header anpassen
2. Alt-Tags für Bilder
3. Sitemap erstellen
4. robots.txt konfigurieren

### Performance:
1. Bilder komprimieren
2. CSS/JS minifizieren
3. Caching aktivieren
4. CDN nutzen (optional)

---

## 🎉 Fertig!

**Website ist komplett und ready to use!** 🚀

Einfach hochladen, Links anpassen und loslegen!

---

**Made with ❤️ and 🔥 for Engels811 Network**
