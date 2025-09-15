<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Cache;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        $titles = $request->input('title', []);
        $types = $request->input('type', []);
        $tags = $request->input('tags', []);
        $page = (int) $request->input('page', 1);
        $perPage = 10;

        // Cache oluşturma
        $cacheKey = "contents:page={$page}:type=" . json_encode($types)
            . ":tags=" . json_encode($tags)
            . ":title=" . json_encode($titles);

        $contents = Cache::remember($cacheKey, 30 * 60, function () use ($titles, $types, $tags, $perPage) {
            $query = Content::with('tags');

            // Başlıklara göre filtreleme
            if (!empty($titles)) {
                $query->where(function ($q) use ($titles) {
                    foreach ($titles as $title) {
                        $q->orWhere('title', 'like', "%{$title}%");
                    }
                });
            }

            // İçerik tipine göre filtreleme
            if (!empty($types)) {
                $query->where(function ($q) use ($types) {
                    foreach ($types as $type) {
                        if (in_array($type, ['video', 'text', 'article'])) {
                            $q->orWhere('type', $type);
                        }
                    }
                });
            }

            // Etiketlere göre filtreleme 
            if (!empty($tags)) {
                $query->whereHas('tags', function ($q) use ($tags) {
                    $q->where(function ($q2) use ($tags) {
                        foreach ($tags as $tag) {
                            $q2->orWhere('name', $tag);
                        }
                    });
                });
            }

            $query->orderByDesc('score')
                ->orderByDesc('published_at');

            return $query->paginate($perPage);
        });

        $start = ($contents->currentPage() - 1) * $contents->perPage();

        $data = $contents->values()->map(function ($content, $index) use ($start) {
            return [
                'row_number' => $start + $index + 1,
                'id' => $content->id,
                'data_source_id' => $content->data_source_id,
                'external_id' => $content->external_id,
                'title' => $content->title,
                'type' => $content->type,
                'score' => $content->score,
                'tags' => $content->tags->pluck('name')->values(),
                'views' => $content->views,
                'likes' => $content->likes,
                'duration_seconds' => $content->duration_seconds,
                'reading_time' => $content->reading_time,
                'reactions' => $content->reactions,
                'comments' => $content->comments,
                'published_at' => $content->published_at,
                'created_at' => $content->created_at,
                'updated_at' => $content->updated_at,
            ];
        });

        return response()->json([
            'current_page' => $contents->currentPage(),
            'per_page' => $contents->perPage(),
            'total' => $contents->total(),
            'last_page' => $contents->lastPage(),
            'data' => $data,
        ]);
    }
}
