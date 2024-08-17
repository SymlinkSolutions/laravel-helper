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

        $app_classname = "App\Helpers\Roles\Access\\".$group;
        $classname = "Symlink\LaravelHelper\Helpers\Roles\Access\\".$group;

        if (class_exists($app_classname)){
            $access = new $app_classname();
        } else if (class_exists($classname)) {
            $access = new $classname();
        } else {
            return redirect()->route('unauthorized');
        }


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
