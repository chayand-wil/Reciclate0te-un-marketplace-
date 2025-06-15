<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
public function handle(Request $request, Closure $next, $role)
{
    $user = auth()->user()->load('rol');
    if ($user->rol->slug !== $role) {
        return response()->json(['error' => 'No autorizadoooo'], 403);
    }   

    return $next($request);
}

}
