<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterController;
use \App\Http\Controllers\DashboardController;
use \App\Http\Controllers\ProfileController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('jobs', JobController::class)->middleware('auth')->only(['create', 'edit', 'store', 'update', 'destroy']);
Route::resource('jobs', JobController::class)->except(['create', 'edit', 'store', 'update', 'destroy']);


Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
