<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/login',  [AuthController::class, 'login'])->name('auth.login');
Route::get('/register',  [AuthController::class, 'register'])->name('auth.register');
Route::get('/logout',  [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/', function () {
});
