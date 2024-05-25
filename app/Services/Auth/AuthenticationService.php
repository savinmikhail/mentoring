<?php

namespace App\Services\Auth;

use App\Contracts\Auth\AuthenticationServiceInterface;
use Illuminate\Support\Facades\Auth;

class AuthenticationService implements AuthenticationServiceInterface
{
    public function authenticate(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            return Auth::user();
        }
        return null;
    }
}