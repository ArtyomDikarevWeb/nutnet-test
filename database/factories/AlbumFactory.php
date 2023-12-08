<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AlbumFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->text(18),
            'artist' => fake()->name(),
            'description' => fake()->text(),
            'cover_url' => 'https://fakeimg.pl/300x300/a43ba2/000',
        ];
    }
}
