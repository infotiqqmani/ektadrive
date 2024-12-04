<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);

    // }

    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role == 3) {
            return $next($request);
        }

        return redirect()->route('admin.login')->with('error', 'Unauthorized access');
    }
}
