<?php

namespace Tests\Feature;

use App\Models\Distributor;
use App\Models\Product;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_home_prioritizes_featured_products_and_excludes_hidden_products(): void
    {
        $featured = Product::factory()->create(['is_featured' => true]);
        Product::factory()->count(4)->create();
        $hidden = Product::factory()->create(['is_featured' => true, 'is_available' => false]);

        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertSee($featured->name)
            ->assertDontSee($hidden->name)
            ->assertViewHas('selectedProducts', fn ($products): bool => $products->count() === 3
                && $products->first()->is($featured));
    }

    public function test_home_renders_uploaded_product_image_and_category_link(): void
    {
        $product = Product::factory()->create(['image_path' => 'products/wheel.jpg']);

        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertSee('/storage/products/wheel.jpg', false)
            ->assertSee(route('catalog.show', $product))
            ->assertSee(route('catalog.index', ['category' => $product->category->slug]));
    }

    public function test_home_renders_distributor_logo_or_name_fallback(): void
    {
        $withLogo = Distributor::factory()->create(['logo_path' => 'distributors/tiny-garage.png']);
        $withoutLogo = Distributor::factory()->create(['logo_path' => null]);

        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertSee('/storage/'.$withLogo->logo_path, false)
            ->assertSee($withoutLogo->name)
            ->assertDontSee($withLogo->country)
            ->assertDontSee($withoutLogo->country);
    }

    public function test_home_renders_with_an_empty_catalog(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertSee('The collection is being prepared.')
            ->assertSee('OFFICIAL DISTRIBUTORS')
            ->assertSee('BIG ATTITUDE.');
    }
}
