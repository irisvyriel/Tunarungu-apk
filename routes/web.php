<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home/{uuid}', [HomeController::class, 'show'])->name('show');
Route::get('/home/{uuid}/materi', [HomeController::class, 'getMateriByBab'])->name('materi');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');