<?php

namespace Tests\Feature\Tour;

use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TourTest extends TestCase
{
    use RefreshDatabase;

    public function test_tours_list_returns_default_sorting_correctly(): void
    {
        $travel = Travel::factory()->create(['isPublic' => true]);
        $earlierTour = Tour::factory()->create([
            'travel_id' => $travel->id,
            'startingDate' => now()->subDays(2),
            'endingDate' => now(),
        ]);
        Tour::factory()->create([
            'travel_id' => $travel->id,
            'startingDate' => now(),
            'endingDate' => now()->addDays(2),
        ]);

        $response = $this->get("/api/travels/$travel->slug/tours");

        $response->assertStatus(200);
        $response->assertJsonPath('data.0.id', $earlierTour->id);
    }

    public function test_tours_list_returns_paginated_data_correctly(): void
    {
        $travel = Travel::factory()->create(['isPublic' => true]);

        Tour::factory(config('pagination.frontend.tour.index') + 1)->create(['travel_id' => $travel->id]);

        $response = $this->get("/api/travels/$travel->slug/tours");

        $response->assertStatus(200);
        $response->assertJsonCount(config('pagination.frontend.tour.index'), 'data');
        $response->assertJsonPath('meta.last_page', 2);
    }

    public function test_tour_list_shows_only_on_public_records(): void
    {
        $publicTravel = Travel::factory()->create(['isPublic' => true]);
        $notPublicTravel = Travel::factory()->create(['isPublic' => false]);

        $publicTour = Tour::factory()->create(['travel_id' => $publicTravel->id]);
        Tour::factory()->create(['travel_id' => $notPublicTravel->id]);

        $publicResponse = $this->get("/api/travels/$publicTravel->slug/tours");
        $notPublicResponse = $this->get("/api/travels/$notPublicTravel->slug/tours");

        $publicResponse->assertStatus(200);
        $publicResponse->assertJsonCount(1, 'data');
        $publicResponse->assertJsonPath('data.0.name', $publicTour->name);
        $notPublicResponse->assertStatus(404);
    }
}
