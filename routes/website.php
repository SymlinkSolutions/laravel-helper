<?php

use Illuminate\Support\Facades\Route;
use Symlink\LaravelHelper\Http\Controllers\System\Index\HomeController;

Route::middleware(['web', "role:Developer"])->prefix("system")->name('system.')->group(function(){
    Route::get("", [HomeController::class, "showHome"])->name("index");



});

