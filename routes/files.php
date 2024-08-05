<?php

use App\Models\FileItem;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Symlink\LaravelHelper\Helpers\Roles\Developer;
use Symlink\LaravelHelper\Http\Controllers\Developer\Index\HomeController;
use Symlink\LaravelHelper\Http\Controllers\FileController;

Route::get("stream/{id}", [FileController::class, "stream"])->name("file.stream");


Route::get("test", function(){
    /**
     * @var App\Models\User
     */
    $user = User::where("email", "dylanschutte10@gmail.com")->first();
    $user->addFile("storage/temp/zdm8k/1722675455/Screenshot_22-4-2024_16610_symlink.local.jpeg");

});