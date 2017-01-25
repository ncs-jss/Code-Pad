<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Session;
use Redirect;


class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if(Auth::guard($guard)->check()) {
            return $next($request);
        } elseif (Auth::guard('student')->check()) {
            return Redirect::back();
        } elseif (Auth::guard('teacher')->check()) {
            return Redirect::back();
        }
        return Redirect::to('/admin');
    }
}
