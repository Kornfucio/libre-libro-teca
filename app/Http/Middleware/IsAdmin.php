<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    //Modificación del método handle para verificar si el usuario es administrador

    public function handle($request, Closure $next)
    {
    if (auth()->check() && auth()->user()->isAdmin()) {
        return $next($request);
    }

    abort(403);
    }

}
