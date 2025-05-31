<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function register(): View
    {
        return view('register');
    }
    public function registerAction(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return redirect()->route('login');
    }

    public function login(): View
    {
        return view('login');
    }

    public function loginAction(Request $request): RedirectResponse
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $user = User::where('email', $request->email)->first();
            Auth::login($user);
            return redirect()->route('home');
        }
        return redirect()->back()->withErrors([
            'error' => 'Email or password is incorrect',
        ]);
    }
    
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
