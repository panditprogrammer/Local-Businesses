<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {

        $user = Auth::guard('adminGuard')->user();
        
        // Allow all routes if the user is a 'super' admin
        if ($user && $user->role === 'super') {
            return $next($request);
        }
        // Allow access only if the user has the specific role (e.g., 'manager')
        if ($user && $user->role === $role) {
            return $next($request);
        }
        Auth::guard('adminGuard')->logout();
        // Redirect or abort if the role doesn't match
        return redirect()->route('admin.login')->with('error','You do not have access to this page.');
    }
}
