<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CuitController;


Route::middleware('auth')->group(function () {
    Route::get('/', [CuitController::class, 'index'])->name('home');
    Route::post('/post', [CuitController::class, 'post'])->name('post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerAction'])->name('register.post');
    Route::post('/login', [AuthController::class, 'loginAction'])->name('login.post');
});
