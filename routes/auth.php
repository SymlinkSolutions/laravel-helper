<?php

use Illuminate\Support\Facades\Route;
use Symlink\LaravelHelper\Http\Controllers\Guest\Index\LoginController;
use Symlink\LaravelHelper\Http\Controllers\Guest\Index\RegisterController;

Route::middleware('web')->group(function(){

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
    
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');



    Route::get('unauthorized', function(){
        return view("symlink::guest.index.unauthorized");
    })->name('unauthorized');


    
});

