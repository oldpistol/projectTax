<?php

namespace Tests\Feature\Api\Authentication;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected $password = 'password123';

    public function test_has_validations()
    {
        $response = $this->postJson('api/login', []);

        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrorFor('email')
            ->assertJsonValidationErrorFor('password');
    }

    public function test_user_can_login_using_correct_credentials()
    {
        $user = User::factory()->create([
            'password' => Hash::make($this->password)
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => $this->password
        ]);

        $response
            ->assertOk()
            ->assertJsonStructure(['token']);
    }

    public function test_user_cannot_login_if_credentials_is_wrong()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'invalid@email.com',
            'password' => 'password'
        ]);

        $response->assertUnauthorized();
    }
}
