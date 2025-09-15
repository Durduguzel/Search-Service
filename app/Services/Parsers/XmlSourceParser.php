<?php

namespace App\Services\Parsers;

use Carbon\Carbon;

class XmlSourceParser implements SourceParserInterface
{
    public function parse(string $payload): array
    {
        $xml = simplexml_load_string($payload, 'SimpleXMLElement', LIBXML_NOCDATA);
        if (!$xml) {
            return [];
        }

        $normalized = [];

        foreach ($xml->items->item as $item) {
            $stats = $item->stats;
            $categories = $item->categories->category ?? [];

            $normalized[] = [
                'external_id' => (string) ($item->id ?? null),
                'title' => (string) ($item->headline ?? ''),
                'type' => (string) ($item->type ?? ''),
                'views' => isset($stats->views) ? (int) $stats->views : 0,
                'likes' => isset($stats->likes) ? (int) $stats->likes : 0,
                'duration_seconds' => isset($stats->duration) ? $this->parseDuration((string) $stats->duration) : 0,
                'reading_time' => isset($stats->reading_time) ? (int) $stats->reading_time : 0,
                'reactions' => isset($stats->reactions) ? (int) $stats->reactions : 0,
                'comments' => isset($stats->comments) ? (int) $stats->comments : 0,
                'published_at' => isset($item->publication_date) ? Carbon::parse((string) $item->publication_date) : null,
                'raw' => json_decode(json_encode($item), true),
                'tags' => array_map('strval', (array) $categories)
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
