<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth:siswas')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home/{uuid}', [HomeController::class, 'show'])->name('show');
    Route::get('/home/{uuid}/bab', [HomeController::class, 'getBab'])->name('bab');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
});
