<?php

namespace Tests\Feature;

 use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Travel;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_travel_list_returns_paginated_data_correctly(): void
    {
        Travel::factory(6)->create(['isPublic' => true]);

        $response = $this->get('/api/travels');

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
        $response->assertJsonPath('meta.last_page', 2);
    }

    public function test_travel_list_shown_only_public_records(): void
    {
        $publicTravel = Travel::factory()->create(['isPublic' => true]);
        Travel::factory()->create(['isPublic' => false]);

        $response = $this->get('/api/travels');

        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
        $response->assertJsonPath('data.0.name', $publicTravel->name);
    }
}
