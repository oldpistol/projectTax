<?php

namespace Tests\Action\Authentication;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterNewUserActionTest extends TestCase
{
    use RefreshDatabase;

    protected $registerNewUserAction;

    public function setUp(): void
    {
        parent::setUp();

        $this->registerNewUserAction = $this->app->make('App\Actions\Authentication\RegisterNewUserAction');
    }

    public function test_execute()
    {
        $data = [
            'email' => 'test@email.com',
            'name' => 'test user',
            'password' => 'password123'
        ];

        $user = $this->registerNewUserAction->execute($data);

        $this->assertTrue($user instanceof User);
        $this->assertTrue($user->wasRecentlyCreated);

        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
            'name' => $data['name']
        ]);

        $this->assertTrue(Hash::check($data['password'], $user->password));
    }
}
