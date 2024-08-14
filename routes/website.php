<?php

use Illuminate\Support\Facades\Route;
use Symlink\LaravelHelper\Http\Controllers\Website\Index\HomeController;

Route::middleware(['web'])->name('website.')->group(function(){
    Route::get("", [HomeController::class, "showHome"])->name("index");



});

