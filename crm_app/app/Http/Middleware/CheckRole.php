<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $allowAccess = false;

        if (auth()->check()) {
            foreach ($roles as $role) {
                if (auth()->user()->roles->pluck("name")->first() === $role) {
                    $allowAccess = true;
                }
            }
        }

        if (!$allowAccess) {
            return response('Can not access');
        }

        return $next($request);

    }

}
