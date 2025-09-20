<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\BandwidthUsage;

use Symfony\Component\HttpFoundation\Response;

class TrackBandwidth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // --- Get request + response size (in bytes) ---
        $requestSize  = strlen(json_encode($request->all()));
        $responseSize = strlen($response->getContent());
        $totalBytes   = $requestSize + $responseSize;

        // --- Current month + day ---
        $month = now()->format('F Y');   // e.g. "September 2025"
        $day   = now()->format('Y-m-d'); // e.g. "2025-09-21"

        // --- Find or create monthly record ---
        $bandwidth = BandwidthUsage::firstOrCreate(
            ['month' => $month],
            [
                'used_bytes' => 0,
                'daily_data' => json_encode([]),
            ]
        );

        // --- Update total used bytes ---
        $bandwidth->used_bytes += $totalBytes;

        // --- Update daily data JSON (store bytes) ---
        $dailyData = json_decode($bandwidth->daily_data, true);
        if (!is_array($dailyData)) {
            $dailyData = [];
        }

        if (!isset($dailyData[$day])) {
            $dailyData[$day] = 0;
        }
        $dailyData[$day] += $totalBytes;

        $bandwidth->daily_data = json_encode($dailyData);
        $bandwidth->save();

        return $response;
    }
}
