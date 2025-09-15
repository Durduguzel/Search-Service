<?php

namespace App\Jobs;

use App\Models\DataSource;
use App\Models\RawEntry;
use App\Models\Content;
use App\Models\Tag;
use App\Services\Parsers\SourceParserInterface;
use App\Services\ScoreCalculator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class FetchSourceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public DataSource $source;

    public function __construct(DataSource $source)
    {
        $this->source = $source;
    }

    public function handle(): void
    {
        $response = Http::get($this->source->base_url);

        $raw = RawEntry::create([
            'data_source_id' => $this->source->id,
            'external_id' => null,
            'payload' => $response->body(),
            'format' => $this->source->format,
            'http_status' => $response->status(),
            'fetched_at' => now(),
        ]);

        if (!$response->successful()) {
            return;
        }

        // Parser instance yarat
        $parserClass = $this->source->parser_class;
        /** @var SourceParserInterface $parser */
        $parser = new $parserClass();

        $items = $parser->parse($response->body());
        $scoreCalculator = new ScoreCalculator();

        foreach ($items as $item) {
            $content = Content::updateOrCreate(
                [
                    'data_source_id' => $this->source->id,
                    'external_id' => $item['external_id'],
                ],
                [
                    'title' => $item['title'],
                    'type' => $item['type'],
                    'views' => $item['views'],
                    'likes' => $item['likes'],
                    'duration_seconds' => $item['duration_seconds'],
                    'reading_time' => $item['reading_time'],
                    'reactions' => $item['reactions'],
                    'comments' => $item['comments'],
                    'published_at' => $item['published_at'],
                    'raw' => $item['raw'],
                ]
            );

            $content->score = $scoreCalculator->calculate($content);
            $content->save();

            if (!empty($item['tags'])) {
                $tagIds = [];
                foreach ($item['tags'] as $tagName) {
                    $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
                    $tagIds[] = $tag->id;
                }
                $content->tags()->sync($tagIds);
            }
        }
    }
}
