<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_index_only_lists_active_products(): void
    {
        $activeCategory = Category::factory()->create(['is_active' => true]);
        $inactiveCategory = Category::factory()->create(['is_active' => true]);

        $activeProduct = Product::factory()->create(['category_id' => $activeCategory->id, 'is_active' => true, 'name' => 'Active Product']);
        Product::factory()->create(['category_id' => $activeCategory->id, 'is_active' => false, 'name' => 'Inactive Product']);
        Product::factory()->create(['category_id' => $inactiveCategory->id, 'is_active' => true, 'name' => 'Other Product']);

        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertSee('Active Product');
        $response->assertDontSee('Inactive Product');
    }

    public function test_products_index_filters_by_category(): void
    {
        $copper = Category::factory()->create(['slug' => 'copper', 'is_active' => true]);
        $brass = Category::factory()->create(['slug' => 'brass', 'is_active' => true]);

        Product::factory()->create(['category_id' => $copper->id, 'name' => 'Copper Jug', 'is_active' => true]);
        Product::factory()->create(['category_id' => $brass->id, 'name' => 'Brass Pot', 'is_active' => true]);

        $response = $this->get('/products?category=copper');

        $response->assertStatus(200);
        $response->assertSee('Copper Jug');
        $response->assertDontSee('Brass Pot');
    }

    public function test_products_index_searches_by_name_and_description(): void
    {
        $category = Category::factory()->create(['is_active' => true]);

        Product::factory()->create(['category_id' => $category->id, 'name' => 'Copper Jug', 'description' => 'A fine jug.', 'is_active' => true]);
        Product::factory()->create(['category_id' => $category->id, 'name' => 'Brass Pot', 'description' => 'A heavy pot.', 'is_active' => true]);

        $response = $this->get('/products?q=jug');

        $response->assertStatus(200);
        $response->assertSee('Copper Jug');
        $response->assertDontSee('Brass Pot');

        $response = $this->get('/products?q=heavy');

        $response->assertStatus(200);
        $response->assertSee('Brass Pot');
        $response->assertDontSee('Copper Jug');
    }

    public function test_products_show_returns_404_for_inactive_product(): void
    {
        $category = Category::factory()->create(['is_active' => true]);
        $product = Product::factory()->create(['category_id' => $category->id, 'slug' => 'test-product', 'is_active' => false]);

        $response = $this->get('/products/test-product');

        $response->assertStatus(404);
    }

    public function test_products_show_returns_404_for_inactive_category(): void
    {
        $category = Category::factory()->create(['is_active' => false]);
        $product = Product::factory()->create(['category_id' => $category->id, 'slug' => 'test-product', 'is_active' => true]);

        $response = $this->get('/products/test-product');

        $response->assertStatus(404);
    }

    public function test_categories_index_lists_active_products_count(): void
    {
        $category = Category::factory()->create(['is_active' => true]);

        Product::factory()->count(3)->create(['category_id' => $category->id, 'is_active' => true]);
        Product::factory()->count(2)->create(['category_id' => $category->id, 'is_active' => false]);

        $response = $this->get('/categories');

        $response->assertStatus(200);
        $response->assertSee('3 products');
    }
}
