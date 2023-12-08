<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlbumController;

Route::middleware(['web'])
    ->group(function () {
        Route::get('/login',  [AuthController::class, 'showLoginForm'])->name('auth.login.form');
        Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
        Route::get('/register',  [AuthController::class, 'showRegisterForm'])->name('auth.register.form');
        Route::post('/register',  [AuthController::class, 'register'])->name('auth.register');

        Route::group(['middleware' => 'can:logged-in-user'], function () {
            Route::get('/logout',  [AuthController::class, 'logout'])->name('auth.logout');

            Route::resource('/albums', AlbumController::class);
        });
});


