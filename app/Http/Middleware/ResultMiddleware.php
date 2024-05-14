<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResultMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response{
        if(auth()->check() && (auth()->user()->hasRole(["admin", "worker"]))){
            return $next($request);
        }else{
            return redirect()->route('home.index')->withErrors('Brak uprawnien');
        }
    }
}
