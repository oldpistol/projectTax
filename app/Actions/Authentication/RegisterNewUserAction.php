<?php

namespace App\Actions\Authentication;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterNewUserAction
{
    protected $userModel;

    public function __construtor(User $user)
    {
        $this->userModel = $user;
    }

    public function execute(array $data): User
    {
        $this->userModel = User::create([
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => $this->hashPassword($data['password'])
        ]);

        return $this->userModel;
    }

    protected function hashPassword(string $plainPassword): string
    {
        return Hash::make($plainPassword);
    }
}