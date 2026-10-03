<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'name' => fake()->words(3, true),
            'slug' => fake()->unique()->slug(),
            'image' => null,
            'dimensions' => fake()->optional()->randomElement(['25cm x 15cm', '30cm x 20cm', '20cm x 10cm']),
            'size' => fake()->optional()->randomElement(['Small', 'Medium', 'Large', '2L', '3L']),
            'weight' => fake()->optional()->randomElement(['0.5kg', '1.0kg', '1.5kg', '2.0kg']),
            'description' => fake()->optional()->sentence(),
            'price' => fake()->optional()->randomFloat(2, 100, 5000),
            'is_active' => true,
            'is_featured' => false,
            'sort_order' => 0,
        ];
    }
}
