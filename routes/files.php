<?php

use Illuminate\Support\Facades\Route;
use Symlink\LaravelHelper\Http\Controllers\FileController;

Route::get("stream/{id}", [FileController::class, "stream"])->name("file.stream");

