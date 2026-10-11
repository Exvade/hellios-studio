<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class CatalogTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_catalog_renders_available_wheels_and_filters_by_category(): void
    {
        $mesh = Category::factory()->create(['name' => 'Mesh', 'slug' => 'mesh']);
        $dish = Category::factory()->create(['name' => 'Deep Dish', 'slug' => 'deep-dish']);
        $meshProduct = Product::factory()->for($mesh)->create(['name' => 'MESH 01', 'slug' => 'mesh-01']);
        Product::factory()->for($dish)->create(['name' => 'DISH 01', 'slug' => 'dish-01']);
        Product::factory()->for($mesh)->create(['name' => 'ARCHIVED', 'slug' => 'archived', 'is_available' => false]);

        $response = $this->get(route('catalog.index', ['category' => $mesh->slug]));

        $response->assertOk();
        $response->assertSee($meshProduct->name);
        $response->assertDontSee('DISH 01');
        $response->assertDontSee('ARCHIVED');
    }

    public function test_available_product_has_a_public_detail_page(): void
    {
        $product = Product::factory()->create(['name' => 'TRACK 01', 'slug' => 'track-01']);

        $response = $this->get(route('catalog.show', $product));

        $response->assertOk();
        $response->assertSee($product->name);
        $response->assertSee($product->description);
    }
}
