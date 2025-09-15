<?php

namespace App\Services\Parsers;

use Carbon\Carbon;

class JsonSourceParser implements SourceParserInterface
{
    public function parse(string $payload): array
    {
        $data = json_decode($payload, true);
        if (!isset($data['contents']) || !is_array($data['contents'])) {
            return [];
        }

        $normalized = [];

        foreach ($data['contents'] as $item) {
            $normalized[] = [
                'external_id' => $item['id'] ?? null,
                'title' => $item['title'] ?? '',
                'type' => $item['type'] ?? '',
                'views' => $item['metrics']['views'] ?? 0,
                'likes' => $item['metrics']['likes'] ?? 0,
                'duration_seconds' => $this->parseDuration($item['metrics']['duration']) ?? 0,
                'reading_time' => $item['metrics']['reading_time'] ?? 0,
                'reactions' => $item['metrics']['reactions'] ?? 0,
                'comments' => $item['metrics']['comments'] ?? 0,
                'published_at' => isset($item['published_at']) ? Carbon::parse($item['published_at']) : null,
                'raw' => $item,
                'tags' => $item['tags'] ?? [],
            ];
        }

        return $normalized;
    }

    private function parseDuration(?string $duration): ?int
    {
        if (!$duration) {
            return null;
        }

        $parts = explode(':', $duration);
        $parts = array_reverse($parts);
        $seconds = 0;

        if (isset($parts[0]))
            $seconds += (int) $parts[0];
        if (isset($parts[1]))
            $seconds += (int) $parts[1] * 60;
        if (isset($parts[2]))
            $seconds += (int) $parts[2] * 3600;

        return $seconds;
    }
}
