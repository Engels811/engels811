# Engels811 Network API

Base URL: `https://wiki.engels811-ttv.de/api/bot`
Authentication: `X-API-KEY: <your_api_key>` header required for POST/DELETE actions.
Responses are JSON with the structure:
```json
{ "success": true, "data": { ... }, "error": null }
```

## Images
### GET `/images.php`
Query params:
- `filter` = `featured` | `recent` | `all`
- `page`, `limit`
- `count=true` returns `{count: number}`

### POST `/images.php`
Body: `{ "prompt": "Wolf neon logo", "image_url": "https://...", "is_featured": true }`

### DELETE `/images.php`
Body: `{ "id": 1 }`

## Videos
### GET `/videos.php`
Query params: `page`, `limit`, `count=true`
Returns `{ videos: [ { "video_id": "abc", "title": "...", "description": "...", "published_at": "..." } ] }`

## Economy
### GET `/economy.php`
Query params: `discord_id`

### POST `/economy.php`
Actions: `daily`, `work`, `add`, `charge`
Body example: `{ "action": "daily", "discord_id": "123", "amount": 50 }`

## Tickets
### POST `/tickets.php`
Create a support ticket: `{ "discord_id": "123", "username": "User", "subject": "Issue", "description": "Details" }`

### GET `/tickets.php`
Query params: `discord_id`

## Error Codes
- `400` Invalid input
- `401` Unauthorized / missing API key
- `404` Resource not found
- `405` Method not allowed
- `500` Server error
