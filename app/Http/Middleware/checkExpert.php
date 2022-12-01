<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkExpert
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
        if(auth()->user()->acc_type  != 'U')
            {
                return response()->json([
                    'message' => 'Sorry you can not be here :( ',
                ]);
            }
        return $next($request);
    }
}
