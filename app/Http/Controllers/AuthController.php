<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login()
    {

    }

    public function showRegisterForm(): View
    {
        return view('auth.register');
    }


    public function register()
    {

    }

    public function logout()
    {

    }
}
