<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class isActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
            if (auth()->guest() || (auth()->check() && auth()->user()->isActive == 1)) {
            return $next($request);
        }

         Auth::logout();

        return redirect('/login')->withErrors(['message' => 'You must be an active user to access this page.']);
    }
}
