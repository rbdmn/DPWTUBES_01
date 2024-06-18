<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function LoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($this->attemptLogin($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.home'));
        }

        return redirect()->route('admin.login')->with('error', 'Email atau password kurang tepat');
    }

    private function attemptLogin($credentials)
    {
        $validEmail = 'admin@gmail.com';
        $validPassword = '123';

        return $credentials['email'] === $validEmail && $credentials['password'] === $validPassword;
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}