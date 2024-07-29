<?php

namespace Symlink\LaravelHelper\Http\Middleware\Auth;

use Closure;

class Role {

    public function handle($request, Closure $next, $role = false) {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        /**
         * @var \App\Models\User;
         */
        $user = auth()->user();
        if ($role && !$user->hasRole($role)) {
            return redirect()->route('unauthorized'); // Adjust the route name as needed
        }

        return $next($request);
    }

}