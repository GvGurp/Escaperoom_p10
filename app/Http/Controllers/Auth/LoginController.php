<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Zorg dat deze import aanwezig is

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function redirectTo()
    {
        // Check the role of the authenticated user
        if (Auth::user()->role === 'user') {
            return 'player/player_home'; // Redirect to admin home
        }

        return 'admin/admin_home'; // Redirect to player home
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Override the username method to support login with email or username.
     */
    public function username()
    {
        return 'login';
    }

    /**
     * Customize the login process to handle email or username.
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = $request->only('login', 'password');

        // Check if login input is an email or username
        $field = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Attempt to log in with the determined field
        return Auth::attempt([
            $field => $credentials['login'],
            'password' => $credentials['password']
        ], $request->filled('remember'));
    }

    /**
     * Validate the login request.
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);
    }
}
