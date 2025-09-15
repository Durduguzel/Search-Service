<?php

namespace App\Services;

use App\Models\Content;

class ScoreCalculator
{
    public function calculate(Content $content): float
    {
        // 1 - Temel Puan
        if ($content->type === 'video') {
            $base = ($content->views / 1000) + ($content->likes / 100);
        } else { // text/article
            $base = ($content->reading_time ?? 0) + ($content->reactions / 50);
        }

        // 2 - İçerik Türü Katsayısı
        $typeCoef = $content->type === 'video' ? 1.5 : 1.0;

        // 3 - Güncellik Puanı
        $freshness = 0;
        if ($content->published_at) {
            $diffDays = now()->diffInDays($content->published_at);
            if ($diffDays <= 7) {
                $freshness = 5;
            } elseif ($diffDays <= 30) {
                $freshness = 3;
            } elseif ($diffDays <= 90) {
                $freshness = 1;
            } else {
                $freshness = 0;
            }
        }

        // 4 - Etkileşim Puanı
        $interaction = 0;
        if ($content->type === 'video') {
            $interaction = $content->views > 0 ? ($content->likes / $content->views) * 10 : 0;
        } else { // text/article
            $interaction = ($content->reading_time ?? 1) > 0 ? ($content->reactions / $content->reading_time) * 5 : 0;
        }

        // 5 - Final Skor
        $finalScore = ($base * $typeCoef) + $freshness + $interaction;

        return round($finalScore, 2);
    }
}
