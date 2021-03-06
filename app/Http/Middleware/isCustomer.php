<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->roles->first()->name != 'Customer'){
            return abort(404);
        }
        return $next($request);
    }
}
