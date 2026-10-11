<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class StudioProductTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_unauthorized_studio_request_redirects_to_login(): void
    {
        $response = $this->get(route('studio.products.index'));

        $response->assertRedirect(route('studio.login'));
    }

    public function test_valid_payload_creates_product_and_redirects_to_product_management(): void
    {
        $category = Category::factory()->create();

        $response = $this->withSession(['hellios_studio_access' => true])->post(route('studio.products.store'), [
            'category_id' => $category->id,
            'name' => 'MESH 07 — BRONZE',
            'series' => 'HELLIOS Select',
            'description' => 'A close-set mesh face for classic 1:64 sedans.',
            'is_available' => '1',
            'is_featured' => '1',
        ]);

        $response->assertRedirect(route('studio.products.index'));
        $this->assertDatabaseHas('products', [
            'category_id' => $category->id,
            'name' => 'MESH 07 — BRONZE',
            'is_available' => 1,
            'is_featured' => 1,
        ]);
    }

    public function test_product_creation_rejects_an_empty_payload(): void
    {
        $response = $this->withSession(['hellios_studio_access' => true])->from(route('studio.products.create'))->post(route('studio.products.store'), []);

        $response->assertRedirect(route('studio.products.create'));
        $response->assertSessionHasErrors([
            'category_id' => 'The category id field is required.',
            'name' => 'The name field is required.',
            'description' => 'The description field is required.',
        ]);
        $this->assertDatabaseCount('products', 0);
    }
}
