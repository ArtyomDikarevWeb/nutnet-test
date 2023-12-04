<?php

namespace App\Http\Controllers;

use App\Actions\Auth\AuthLoginAction;
use App\Actions\Auth\AuthRegisterAction;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * @throws \Exception
     */
    public function login(AuthRequest $request, AuthLoginAction $action): RedirectResponse
    {
        $result = $action($request->dto());

        if ($result) {
            return response()->redirectToRoute('auth.login');
        }

        return response()->redirectToRoute('auth.login');
    }

    public function showRegisterForm(): View
    {
        return view('auth.register');
    }


    public function register(AuthRequest $request, AuthRegisterAction $action): RedirectResponse
    {
        $result = $action($request->dto());

        if ($result) {
            return response()->redirectToRoute('auth.login');
        }

        return response()->redirectToRoute('auth.login');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return response()->redirectToRoute('auth.login');
    }
}
