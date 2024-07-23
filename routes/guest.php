<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function(){


    Route::get("", function(){
        return view('symlink::guest.index.home');
    })->name("home");



    
});
