<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Symlink\LaravelHelper\Helpers\Roles\Developer;

Route::middleware('web')->group(function(){

    Route::get("test", function(){
        $user = User::where('email', "dylanschutte10@gmail.com")->first();
        
        $user->addRole(new Developer);

        return view('symlink::guest.index.home');
    });



    
});