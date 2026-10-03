<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Copper', 'slug' => 'copper', 'image' => null, 'description' => 'High-quality copper items including jugs, pots, and decorative pieces.', 'sort_order' => 1, 'is_active' => true],
            ['name' => 'Brass', 'slug' => 'brass', 'image' => null, 'description' => 'Durable brass cookware and household items crafted for longevity.', 'sort_order' => 2, 'is_active' => true],
            ['name' => 'Kasa', 'slug' => 'kasa', 'image' => null, 'description' => 'Traditional bronze alloy (Kasa) products with cultural significance.', 'sort_order' => 3, 'is_active' => true],
            ['name' => 'Steel', 'slug' => 'steel', 'image' => null, 'description' => 'Stainless steel and carbon steel products for modern and industrial use.', 'sort_order' => 4, 'is_active' => true],
            ['name' => 'Aluminium', 'slug' => 'aluminium', 'image' => null, 'description' => 'Lightweight aluminium goods ideal for everyday utility.', 'sort_order' => 5, 'is_active' => true],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
