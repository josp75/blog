<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(): Factory|View|Application
    {
        return view('auth.login');

    }

    public function doLogin(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('blog.index'));
        }
        return to_route('auth.login')->withErrors(['email' => 'email invalide'])->onlyInput('email');

    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return to_route('auth.login');

    }
}
