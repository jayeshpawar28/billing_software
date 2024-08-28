<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ValidMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if(Auth::check()){
        //     return $next($request);
        // } else {
        //     return redirect()->route('login')->with('error', 'User not login');
        // }
        if (Auth::check()) {
            return $next($request);
        } else {
            return redirect()->route('login')->with('error', 'User not logged in');
        }
    
    }
    
}
