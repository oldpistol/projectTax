<?php

namespace Tests\Feature\Api\Authentication;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_new_user()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@email.com',
            'password' => 'password123'
        ];

        $response = $this->postJson('/api/register', [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'password_confirmation' => $data['password']
        ]);

        $response->assertCreated();
    }

    public function test_has_validations()
    {
        $response = $this->postJson('/api/register', []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_validate_email_already_exists()
    {
        $existingUser = User::factory()->create();

        $response = $this->postJson('/api/register', [
            'email' => $existingUser->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrorFor('email');
    }
}
