<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Content;
use App\Services\ScoreCalculator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class ScoreCalculatorTest extends TestCase
{
    use RefreshDatabase;

    protected ScoreCalculator $calculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->calculator = new ScoreCalculator();
    }

    /** @test */
    public function it_calculates_score_for_video_content()
    {
        $content = Content::factory()->make([
            'type' => 'video',
            'views' => 10000,
            'likes' => 500,
            'duration_seconds' => 600,
            'published_at' => Carbon::now()->subDays(3),
        ]);

        $score = $this->calculator->calculate($content);

        // Video için manual hesaplama: ((10000/1000 + 500/100) * 1.5) + 5 + ((500/10000)*10)
        $expected = ((10 + 5) * 1.5) + 5 + 0.5; // 30.5
        $this->assertEquals($expected, $score);
    }

    /** @test */
    public function it_calculates_score_for_text_content()
    {
        $content = new Content([
            'type' => 'article',
            'reading_time' => 20,
            'reactions' => 10,
            'published_at' => now()->subDays(4),
        ]);

        $score = $this->calculator->calculate($content);
        $expected = round((20 + (10 / 50)) * 1 + 5 + (10 / 20) * 5, 2);
        $this->assertEquals($expected, $score);
    }

    /** @test */
    public function it_handles_content_with_no_views_or_reading_time()
    {
        $content = Content::factory()->make([
            'type' => 'video',
            'views' => 0,
            'likes' => 0,
            'published_at' => null,
        ]);

        $score = $this->calculator->calculate($content);
        $expected = 0;
        $this->assertEquals($expected, $score);
    }
}
