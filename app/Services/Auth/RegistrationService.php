<?php

namespace App\Services\Auth;

use App\Contracts\Auth\RegistrationServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationService implements RegistrationServiceInterface
{
    public function register(array $userData)
    {
        $userData['password'] = Hash::make($userData['password']);
        return User::create($userData);
    }
}