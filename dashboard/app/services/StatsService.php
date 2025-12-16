<?php

class StatsService
{
    public static function getKpis(): array
    {
        // TODO: später echte APIs / DB
        return [
            'stream_hours' => 500,
            'community'    => 1234,
            'ai_images'    => self::fetchCount('/api/bot/images.php?action=count', 50),
            'videos'       => self::fetchCount('/api/bot/videos.php?action=count', 25),
        ];
    }

    public static function getSystem(): array
    {
        return [
            'dashboard' => 'Online',
            'api'       => self::ping('/api/health.php'),
            'time'      => date('H:i:s'),
        ];
    }

    private static function fetchCount(string $url, int $fallback): int
    {
        try {
            $json = @file_get_contents($url);
            if (!$json) return $fallback;
            $data = json_decode($json, true);
            return (int)($data['data']['count'] ?? $fallback);
        } catch (\Throwable $e) {
            return $fallback;
        }
    }

    private static function ping(string $url): string
    {
        return @file_get_contents($url) !== false ? 'Online' : 'Offline';
    }
}
