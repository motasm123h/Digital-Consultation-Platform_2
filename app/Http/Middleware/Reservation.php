<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Reservation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $expert=Expert::find($request->expert_id);
        //if($request->)
        return $next($request);
    }
}
