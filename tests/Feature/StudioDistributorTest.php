<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StudioDistributorTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_unauthorized_distributor_request_redirects_to_login(): void
    {
        $this->get(route('studio.distributors.index'))
            ->assertRedirect(route('studio.login'));
    }

    public function test_valid_payload_creates_distributor_and_stores_its_logo(): void
    {
        Storage::fake('public');
        $logo = UploadedFile::fake()->image('tiny-garage.png');

        $response = $this->withSession(['hellios_studio_access' => true])
            ->post(route('studio.distributors.store'), [
                'name' => 'Tiny Garage Jakarta',
                'country' => 'Indonesia',
                'logo' => $logo,
            ]);

        $response->assertRedirect(route('studio.distributors.index'));
        $this->assertDatabaseHas('distributors', [
            'name' => 'Tiny Garage Jakarta',
            'country' => 'Indonesia',
        ]);
        Storage::disk('public')->assertExists('distributors/'.$logo->hashName());
    }

    public function test_distributor_creation_rejects_an_empty_payload(): void
    {
        $response = $this->withSession(['hellios_studio_access' => true])
            ->from(route('studio.distributors.create'))
            ->post(route('studio.distributors.store'), []);

        $response->assertRedirect(route('studio.distributors.create'));
        $response->assertSessionHasErrors([
            'name' => 'The name field is required.',
            'country' => 'The country field is required.',
        ]);
    }
}
