<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function(){

    Route::get("test", function(){
        $user = User::where('email', "dylanschutte10@gmail.com")->first();

        Role::syncWithClasslist();

        return view('symlink::guest.index.home');
    });



    
});