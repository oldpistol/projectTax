<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class InvalidCredentialException extends Exception
{
    public function render($request)
    {
        return response()->json(['message' => __('Invalid credentials.')], Response::HTTP_UNAUTHORIZED);
    }
}
