<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Symlink\LaravelHelper\Helpers\Roles\Developer;
use Symlink\LaravelHelper\Http\Controllers\Developer\Index\HomeController;

Route::middleware(['web', "role:Developer"])->prefix("dev")->name('dev.')->group(function(){

    Route::get("/test", function(){
        $path = 'temp/zdm8k/1722675455/Screenshot_22-4-2024_16610_symlink.local.jpeg';
    
        // Check if the file exists
        if (!Storage::disk('public')->exists($path)) {
            return response()->json(['message' => 'File not found'], 404);
        }

        // Get the file contents
        $file = Storage::disk('public')->get($path);

        // Get the file's mime type
        // $mimeType = Storage::disk('public')->mimeType($path);

        // Return the file contents with the correct content type
        return response($file, 200)->header('Content-Type', "");
    });


    Route::get("", [HomeController::class, "showHome"])->name("index");
    Route::get("/assets", [HomeController::class, "showAssets"])->name("assets");
    Route::get("/build-sass", [HomeController::class, "updateStyles"])->name("update.styles");
    Route::get("/reset-colors", [HomeController::class, "reset_colors"])->name("reset.colors");
    Route::post("", [HomeController::class, "storeGeneralSettings"])->name("index.general.store");


});