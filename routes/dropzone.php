<?php

use Illuminate\Support\Facades\Route;
use Symlink\LaravelHelper\Http\Controllers\DropzoneController;

Route::middleware('web')->group(function(){

    Route::post("dopzone/upload", [DropzoneController::class, "upload"])->name('dropzone');
    Route::post("dopzone/upload-cropped", [DropzoneController::class, "upload_cropped"])->name('dropzone.cropped');
    Route::post("dopzone/remove", [DropzoneController::class, "remove"])->name('dropzone.remove');

    
});

