<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::get('/register', function () {
        return view('register');
    })->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.post');
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');
});
