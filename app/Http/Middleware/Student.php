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
    public function handle($request, Closure $next, $guard='student')
    {
        // if(Session::has('start') and Session::get('type')=='student')
        // {
        //     return $next($request);
        // }
        // return Redirect::to('/login');

        if(Auth::guard($guard)->check()) {
            return $next($request);
        }
        return Redirect::to('/login');

    }
}
