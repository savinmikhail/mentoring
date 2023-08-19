<?php

namespace App\Http\Controllers;

use App\Contracts\Auth\AuthenticationServiceInterface;
use App\Contracts\Auth\RegistrationServiceInterface;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Services\Auth\AuthenticationService;
use App\Services\Auth\RegistrationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    protected $registrationService;
    protected $authenticationService;

    public function __construct(
        RegistrationServiceInterface $registrationService,
        AuthenticationServiceInterface $authenticationService
    ) {
        $this->registrationService = $registrationService;
        $this->authenticationService = $authenticationService;
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
}
