<?php

namespace App\Http\Middleware\Auth;

use Closure;

class UserMiddleware {
    public function handle($request, Closure $next) {
        return $next($request);
    }
}