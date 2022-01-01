<?php

namespace Tests\Action\Authentication;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginActionTest extends TestCase
{
    use RefreshDatabase;

    protected $loginAction;

    protected $password = 'abc123';

    public function setUp(): void
    {
        parent::setUp();

        $this->loginAction = $this->app->make('App\Actions\Authentication\LoginAction');
    }

    public function test_execute_with_correct_credentials()
    {
        $user = $this->createNewUser();

        $loginUser = $this->loginAction->execute($user->email, $this->password);

        $this->assertTrue($loginUser instanceof User);
    }

    public function test_execute_with_wrong_credentials()
    {
        $user = $this->createNewUser();

        $loginUser = $this->loginAction->execute($user->email, 'wrongPassword');

        $this->assertNull($loginUser);
    }

    protected function createNewUser()
    {
        return User::factory()->create([
            'password' => Hash::make($this->password)
        ]);
    }
}