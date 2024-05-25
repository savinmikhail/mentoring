<?php

namespace App\Contracts\Auth;

interface RegistrationServiceInterface
{
    public function register(array $userData);
}