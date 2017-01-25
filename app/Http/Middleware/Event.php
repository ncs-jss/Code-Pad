<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Session;
use Redirect;


class Event
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
        if(!Auth::guard('student')->check()) {
            return $next($request);
        }
        return Redirect::to('/login');
    }
}
