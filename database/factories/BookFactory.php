<?php

namespace Database\Factories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'genre_id'     => Genre::factory(),
            'title'        => rtrim(fake()->realText(30), '.'),
            'author'       => fake()->name(),
            'year'         => fake()->numberBetween(1850, 2025),
            'pages'        => fake()->numberBetween(100, 800),
            'price'        => fake()->randomFloat(2, 1000, 15000),
            'description'  => fake()->realText(200),
            'is_available' => fake()->boolean(80), // 80% книг будут в наличии
        ];
    }
}