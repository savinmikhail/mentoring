<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signUp(UserRequest $request)
    {
        $validateData = $request->validationData();
        $validateData['password']  = Hash::make($validateData['password']);
        $user = User::create($validateData);
        Auth::login($user);
        return redirect()->route('showModule');
    }

    public function signIn(SignInRequest $request)
    {
        $credentials = $request->validated();

        if(Auth::attempt($credentials)){
            $user = User::where('email', $credentials['email'])->first();
            Auth::login($user);
            return redirect()->route('showModule');
        } else {
            echo 'test';
        }




    }
}
