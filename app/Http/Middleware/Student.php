<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Session;
use Redirect;

class Student
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'student')
    {
        if (Auth::guard($guard)->check()) {
            return $next($request);
        } elseif (Auth::guard('admin')->check()) {
            return Redirect::back();
        } elseif (Auth::guard('teacher')->check()) {
            return Redirect::back();
        }
        return Redirect::to('/login');

    }
}
