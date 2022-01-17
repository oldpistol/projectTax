<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_requires_authorization()
    {
        $response = $this->getJson('/api/user');

        $response->assertUnauthorized();
    }

    public function test_user_detail_can_be_retrieved()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->getJson('/api/user');

        $response
            ->assertOk()
            ->assertExactJson([
                'data' => [
                    'id' => $user->id,
                    'email' => $user->email,
                    'name' => $user->name
                ]
            ]);
    }

    public function test_can_get_list_of_documents_group_by_year()
    {
        $this->assertTrue(true);
    }
}
