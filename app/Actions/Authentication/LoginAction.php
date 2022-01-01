<?php

namespace App\Actions\Authentication;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginAction
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function execute(string $email, string $password)
    {
        $this->user = $this->user
            ->where('email', $email)
            ->first();

        if ($this->user && $this->verifyPassword($password, $this->user->password)) {
            return $this->user;
        }

        return null;
    }

    protected function verifyPassword(string $plainPassword, string $hashedPassword)
    {
        return Hash::check($plainPassword, $hashedPassword);
    }

}
