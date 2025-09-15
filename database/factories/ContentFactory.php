<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Content;

class ContentFactory extends Factory
{
    protected $model = Content::class;

    public function definition()
    {
        $type = $this->faker->randomElement(['video', 'text', 'article']);

        return [
            'data_source_id' => 1,
            'external_id' => $this->faker->uuid,
            'title' => $this->faker->sentence,
            'type' => $type,
            'views' => $type === 'video' ? $this->faker->numberBetween(0, 50000) : 0,
            'likes' => $type === 'video' ? $this->faker->numberBetween(0, 5000) : 0,
            'duration_seconds' => $type === 'video' ? $this->faker->numberBetween(30, 3600) : 0,
            'reading_time' => $type === 'text' || $type === 'article' ? $this->faker->numberBetween(1, 60) : 0,
            'reactions' => $type === 'text' || $type === 'article' ? $this->faker->numberBetween(0, 200) : 0,
            'comments' => $this->faker->numberBetween(0, 100),
            'published_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'score' => 0, 
        ];
    }
}
