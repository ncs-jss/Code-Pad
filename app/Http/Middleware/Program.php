<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Redirect;

class Program
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
        if(Session::has('record_id'))
            return $next($request);
        return Redirect::back();
    }
}
