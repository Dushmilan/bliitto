<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<News>
 */
class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'date' => fake()->date('Y-m-d'),
            'image' => null,
            'description' => fake()->sentence(),
            'link' => null,
            'published' => true,
        ];
    }

    public function unpublished(): static
    {
        return $this->state(fn (): array => ['published' => false]);
    }
}
