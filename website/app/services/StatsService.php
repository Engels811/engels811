<?php

declare(strict_types=1);

namespace App\Services;

final class StatsService
{
    /**
     * Mock stats. Replace with database or API calls in production.
     *
     * @return array<string,int>
     */
    public function getSummary(): array
    {
        return [
            'images' => 128,
            'videos' => 42,
            'members' => 3560,
            'tickets' => 12,
        ];
    }
}
