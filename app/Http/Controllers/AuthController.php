<?php

namespace App\Http\Controllers;

use App\Contracts\Auth\AuthenticationServiceInterface;
use App\Contracts\Auth\RegistrationServiceInterface;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{

    public function __construct(private RegistrationServiceInterface $registrationService, private AuthenticationServiceInterface $authenticationService)
    {
    }

    public function signUp(SignUpRequest $request)
    {
        $user = $this->registrationService->register($request->validated());
        Auth::login($user);

        return Redirect::route('showModule');
    }

    public function signIn(SignInRequest $request)
    {
        $user = $this->authenticationService->authenticate($request->validated());

        if ($user) {
            Auth::login($user);
            return Redirect::route('showModule');
        } else {
            return back()->withErrors(['login_error' => 'Неправильный логин или пароль.']);
        }
    }
    public  function User()
    {
        return response()->json(['data' => auth()->user()]);
    }
}
