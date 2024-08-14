<?php

namespace Symlink\LaravelHelper\Http\Middleware\Auth;

use Closure;

class Access {

    public function handle($request, Closure $next, $group = false) {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (session("user.".auth()->user()->id . ".group.{$group}")) {
            return $next($request);
        }


        $classname = "Symlink\LaravelHelper\Helpers\Roles\Access\\".$group;
        $access = new $classname();

        $roles = $access->getRoles();
        foreach ($roles as $role) {
            if (auth()->user()->hasRole($role)) {
                session([
                    "user.".auth()->user()->id . ".group.{$group}" => true
                ]);
                return $next($request);
            }
        }

        session([
            "user.".auth()->user()->id . ".group.{$group}" => false
        ]);
        return redirect()->route('unauthorized');
    }

}
