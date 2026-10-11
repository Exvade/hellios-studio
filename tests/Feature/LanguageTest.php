<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class LanguageTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_indonesian_session_renders_translated_public_copy(): void
    {
        $response = $this->withSession(['locale' => 'id'])->withoutVite()->get(route('home'));

        $response->assertOk()
            ->assertSee('SKALA KECIL. KULTUR BESAR.')
            ->assertSee('DISTRIBUTOR RESMI')
            ->assertSee('BIKIN YANG', false);
    }

    public function test_indonesian_session_translates_the_studio_login(): void
    {
        $response = $this->withSession(['locale' => 'id'])
            ->withoutVite()
            ->get(route('studio.login'));

        $response
            ->assertOk()
            ->assertSee('Akses studio.')
            ->assertSee('Ruang kerja privat');
    }

    public function test_indonesian_session_translates_the_studio_management_screen(): void
    {
        $response = $this->withSession([
            'locale' => 'id',
            'hellios_studio_access' => true,
        ])->withoutVite()->get(route('studio.products.index'));

        $response
            ->assertOk()
            ->assertSee('Meja inventaris')
            ->assertSee('Tambah velg');
    }

    public function test_language_switcher_stores_supported_locale(): void
    {
        $response = $this->from(route('home'))->put(route('language.update', 'id'));

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('locale', 'id');
    }

    public function test_language_switcher_rejects_unsupported_locale(): void
    {
        $response = $this->put(route('language.update', 'fr'));

        $response->assertNotFound();
    }
}
