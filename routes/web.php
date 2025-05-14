<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard')->middleware('auth');

Route::resource('posts', PostController::class);