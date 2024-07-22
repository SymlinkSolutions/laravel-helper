<?php

use Illuminate\Support\Facades\Route;

Route::get("", function(){
    return view('symlink::guest.index.home');
})->name("login");