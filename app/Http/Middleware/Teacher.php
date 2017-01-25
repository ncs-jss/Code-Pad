<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Session;
use Redirect;

class Teacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard='teacher')
    {

        if (Auth::guard($guard)->check()) {
            return $next($request);
        } elseif (Auth::guard('admin')->check()) {
            return Redirect::back();
        } elseif (Auth::guard('student')->check()) {
            return Redirect::back();
        }
        return Redirect::to('/login');
    }
}
