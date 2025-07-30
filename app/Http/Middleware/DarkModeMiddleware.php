<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DarkModeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('dark_mode')) {
            session(['dark_mode' => $request->input('dark_mode')]);
        }

        view()->share('dark_mode', session('dark_mode', false));

        return $next($request);
    }
}
