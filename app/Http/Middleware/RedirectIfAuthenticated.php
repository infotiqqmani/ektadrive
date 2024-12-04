<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next, string ...$guards): Response
    // {
    //     $guards = empty($guards) ? [null] : $guards;

    //     foreach ($guards as $guard) {
    //         if (Auth::guard($guard)->check()) {
    //             return redirect(RouteServiceProvider::HOME);
    //         }
    //     }

    //     return $next($request);
    // }
    // ==========
    // public function handle($request, Closure $next, $guard = null)
    // {
    //     if (Auth::guard($guard)->check()) {
    //         $user = Auth::guard($guard)->user();

    //         switch ($user->role) {
    //             case 1:
    //                 return redirect()->route('admin.dashboard');
    //             case 2:
    //                 return redirect()->route('teamlead.dashboard');
    //             case 3:
    //                 return redirect()->route('user.dashboard');
    //         }
    //     }

    //     return $next($request);
    // }

    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
            switch ($user->role) {
                case 1:
                    return redirect()->route('admin.dashboard');
                case 2:
                    return redirect()->route('teamlead.dashboard');
                case 3:
                    return redirect()->route('user.dashboard');
                default:
                    return redirect('/login');
            }
        }

        return $next($request);
    }
}
