<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
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
        // if (Auth::check() && Auth::user()->status == 1) {
        //     return $next($request);
        // } else {
        //     Auth::logout();
        //     return redirect('/login')->with('error_login', 'Invalid User');
        // }

        if (Auth::check() && Auth::user()->user_type_id != 5) {
            return $next($request);
        } else {
            Auth::logout();
            return redirect('/login')->with('error_login', 'Invalid User');
        }
    }
}
