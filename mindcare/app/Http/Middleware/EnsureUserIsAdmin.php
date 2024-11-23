<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has either the admin role (role 1) or superadmin role (role 2)
        if (Auth::check() && (Auth::user()->role == 1 || Auth::user()->role == 2)) {
            return $next($request);
        }

        // Redirect or abort if the user is neither an admin nor a superadmin
        return redirect('/home'); // Or any other route
    }
}
