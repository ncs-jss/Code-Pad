<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Redirect;

class Teacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Session::has('start') and Session::get('type')=='teacher')
        {
            return $next($request);
        }
        return Redirect::to('/login');
    }
}
