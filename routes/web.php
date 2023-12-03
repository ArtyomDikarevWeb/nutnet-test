<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/login',  [AuthController::class, 'showLoginForm'])->name('auth.login.form');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register',  [AuthController::class, 'showRegisterForm'])->name('auth.register.form');
Route::post('/register',  [AuthController::class, 'register'])->name('auth.register');

Route::group([], function () {
    Route::get('/logout',  [AuthController::class, 'logout'])->name('auth.logout');


});
