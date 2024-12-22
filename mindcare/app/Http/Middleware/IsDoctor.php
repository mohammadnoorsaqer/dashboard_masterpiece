<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsDoctor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the authenticated user's role is 'doctor' (role ID: 3)
        if (auth()->check() && auth()->user()->role == 3) {
            return $next($request); // Allow access for doctors
        }

        // Deny access to unauthorized users
        abort(403, 'Unauthorized access');
    }
    
}
