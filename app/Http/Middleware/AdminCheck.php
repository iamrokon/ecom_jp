<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Tantousya;

class AdminCheck
{
    public function handle($request, Closure $next)
    {
        if(session()->has('admin')) return $next($request);
        else return redirect()->route('admin.login');
    }
}
