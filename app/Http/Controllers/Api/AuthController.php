<?php

namespace App\Http\Controllers\Api;

use App\Actions\Authentication\LoginAction;
use App\Actions\Authentication\RegisterNewUserAction;
use App\Exceptions\InvalidCredentialException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\RegisterUserRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $request, LoginAction $loginAction)
    {
        $data = $request->validationData();

        $user = $loginAction->execute($data['email'], $data['password']);

        if (! $user)
        {
            throw new InvalidCredentialException();
        }

        $token = $user->createToken($request->userAgent())->plainTextToken;

        return response()->json([
            'token' => $token
        ]);
    }

    public function register(RegisterUserRequest $request, RegisterNewUserAction $registerNewUserAction)
    {
        $registerNewUserAction->execute($request->validationData());

        return response()->json(null, Response::HTTP_CREATED);
    }

    public function logout()
    {

    }
}
