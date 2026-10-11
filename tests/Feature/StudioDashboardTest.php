<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class StudioDashboardTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_guest_is_redirected_to_studio_login_from_dashboard(): void
    {
        $this->get(route('studio.index'))
            ->assertRedirect(route('studio.login'));
    }

    public function test_authenticated_studio_user_can_view_the_dashboard(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->for($category)->create([
            'is_featured' => true,
            'is_available' => true,
        ]);

        $response = $this->withSession(['hellios_studio_access' => true])
            ->get(route('studio.index'));

        $response
            ->assertOk()
            ->assertSee(__('hellios.studio.dashboard'))
            ->assertSee($product->name)
            ->assertSee(__('hellios.studio.total_wheels'));
    }
}
