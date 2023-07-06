<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminCreateTravelTest extends TestCase
{
    use RefreshDatabase;

    public function test_return_error_without_authentication()
    {
        $response = $this->postJson("/api/admin/travels");

        $response->assertStatus(401);
    }

    public function test_non_admin_user_cannot_create_travel(): void
    {
        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();
        $user->roles()->attach(Role::where('name', Role::EDITOR)->value('id'));

        $response = $this->actingAs($user)->postJson("/api/admin/travels");

        $response->assertStatus(403);
    }

    public function test_validation_fails_on_create_travel_with_admin_credentials(): void
    {
        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();
        $user->roles()->attach(Role::where('name', Role::ADMIN)->value('id'));

        $response = $this->actingAs($user)->postJson("/api/admin/travels", [
            'name' => 'Travel name',
        ]);

        $response->assertStatus(422);
    }

    public function test_create_travel_with_admin_credentials(): void
    {
        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();
        $user->roles()->attach(Role::where('name', Role::ADMIN)->first()->id);

        $response = $this->actingAs($user)->postJson("/api/admin/travels", [
            'name' => 'Travel name',
            'description' => 'Travel description',
            'isPublic' => true,
            'numberOfDays' => 10,
        ]);

        $response->assertStatus(201);
        $response->assertJsonPath('data.name', 'Travel name');
    }
}
