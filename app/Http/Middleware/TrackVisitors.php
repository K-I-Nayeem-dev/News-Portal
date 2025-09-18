<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;
use Carbon\Carbon;

class TrackVisitors
{
    public function handle(Request $request, Closure $next): Response
    {
        $today = Carbon::today();

        if (!Visitor::where('ip', $request->ip())
            ->whereDate('visit_date', $today)
            ->exists()) {

            Visitor::create([
                'ip' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'visit_date' => $today,
            ]);
        }

        return $next($request);
    }
}
