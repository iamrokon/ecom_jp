<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class UserLogin
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
        if (Session::has('userlogin')) {
            return $next($request);
        }else {
            return redirect('/loadAuthenticationPage');
        }
    }
}
