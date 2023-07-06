<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_return_access_token_with_valid_credentials(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['accessToken']);
    }

    public function test_login_return_error_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password1',
        ]);

        $response->assertStatus(422);
    }

    public function test_login_return_error_with_invalid_user(): void
    {
        $response = $this->postJson('/api/login', [
            'email' => 'never@test.com',
            'password' => 'password',
        ]);

        $response->assertStatus(404);
    }
}
