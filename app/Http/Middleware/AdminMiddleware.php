<?php

namespace Admin\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if (empty(Auth::user())) {
            // dd($request);
            return redirect('admin/login');
        } elseif (!empty(Auth::user())) {

            // dd($request);
            if (Auth::user()->role != 0)

                return redirect('admin/login');
        }
        return $next($request);


    }
}