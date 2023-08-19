<?php

namespace App\Contracts\Auth;

interface AuthenticationServiceInterface
{
    public function authenticate(array $credentials);
}