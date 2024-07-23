<?php

use Illuminate\Support\Facades\Route;
use Symlink\LaravelHelper\Http\Controllers\Guest\Index\LoginController;
use Symlink\LaravelHelper\Http\Controllers\Guest\Index\RegisterController;

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->middleware('web')->name('register');
Route::post('register', [RegisterController::class, 'register'])->middleware('web');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');