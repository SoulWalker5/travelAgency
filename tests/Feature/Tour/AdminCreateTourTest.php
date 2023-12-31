<?php

namespace Tests\Feature\Tour;

use App\Models\Role;
use App\Models\Travel;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCreateTourTest extends TestCase
{
    use RefreshDatabase;

    public function test_return_error_without_authentication()
    {
        $travel = Travel::factory()->create();
        $response = $this->postJson("/api/admin/travels/$travel->id/tours");

        $response->assertStatus(401);
    }

    public function test_non_admin_user_cannot_create_travel()
    {
        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();
        $user->roles()->attach(Role::where('name', Role::EDITOR)->value('id'));
        $travel = Travel::factory()->create();

        $response = $this->actingAs($user)->postJson("/api/admin/travels/$travel->id/tours");

        $response->assertStatus(403);
    }

    public function test_validation_fails_on_create_travel_with_admin_credentials(): void
    {
        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();
        $user->roles()->attach(Role::where('name', Role::ADMIN)->value('id'));
        $travel = Travel::factory()->create();

        $response = $this->actingAs($user)->postJson("/api/admin/travels/$travel->id/tours", [
            'price' => 10.99,
        ]);

        $response->assertStatus(422);
    }

    public function test_create_travel_with_admin_credentials(): void
    {
        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();
        $user->roles()->attach(Role::where('name', Role::ADMIN)->first()->id);
        $travel = Travel::factory()->create();

        $response = $this->actingAs($user)->postJson("/api/admin/travels/$travel->id/tours", [
            'name' => 'My awesome tour',
            'startingDate' => now()->addDay()->toDateTimeString(),
            'endingDate' => now()->addDays(2)->toDateTimeString(),
            'price' => 99.99,
        ]);

        $response->assertStatus(201);
        $response->assertJsonPath('data.name', 'My awesome tour');
    }
}
