<?php

use Illuminate\Support\Facades\Route;
use Symlink\LaravelHelper\Http\Controllers\DropzoneController;

Route::middleware('web')->group(function(){

    Route::post("dopzone/upload", [DropzoneController::class, "upload"])->name('dropzone');
    Route::post("dopzone/remove", [DropzoneController::class, "remove"])->name('dropzone.remove');

    
});

