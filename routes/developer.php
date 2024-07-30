<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Symlink\LaravelHelper\Helpers\Roles\Developer;
use Symlink\LaravelHelper\Http\Controllers\Developer\Index\HomeController;

Route::middleware(['web', "role:Developer"])->prefix("dev")->name('dev.')->group(function(){

    Route::get("", [HomeController::class, "showHome"])->name("index");
    Route::post("", [HomeController::class, "storeGeneralSettings"])->name("index.general.store");


});