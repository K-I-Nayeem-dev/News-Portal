<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class NewsFetchController extends Controller
{
    public function fetch()
    {
        $response = Http::get('https://newsdata.io/api/1/latest', [
            'apikey' => 'pub_f35e7f8479fb4a7185396c24d68a868b',
            'q' => 'banglanews'
        ]);

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'data' => $response->json(),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to fetch news.',
        ], $response->status());
    }
}