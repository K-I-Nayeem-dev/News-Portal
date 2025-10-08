<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsView;
use App\Models\News;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\DB;

class MostViewsNewsController extends Controller
{

    public function index()
    {
        // Step 1: Get most-viewed news IDs with total views (paginated)
        $newsViews = NewsView::select('news_id', DB::raw('COUNT(*) as total_views'))
            ->groupBy('news_id')
            ->orderByDesc('total_views')
            ->paginate(20);

        // Step 2: Collect news IDs on this page
        $newsIds = $newsViews->getCollection()->pluck('news_id')->toArray();

        // Step 3: Load all News models for these IDs
        $newsMap = News::whereIn('id', $newsIds)->get()->keyBy('id');

        // Step 4: Load all related NewsView rows (latest first)
        $latestViews = NewsView::whereIn('news_id', $newsIds)
            ->latest()
            ->get()
            ->groupBy('news_id');

        // Step 5: Transform paginated collection
        $newsViews->getCollection()->transform(function ($item) use ($newsMap, $latestViews) {
            $latestView = $latestViews->get($item->news_id)?->first();

            // Default values
            $browser = 'Unknown';
            $device = 'Unknown';
            $ip = null;
            $viewedAt = null;

            if ($latestView) {
                $agent = new Agent();
                $agent->setUserAgent($latestView->user_agent ?? '');

                // Detect browser
                $browser = $agent->browser() ?: 'Unknown';

                // Detect device type reliably
                if ($agent->isDesktop()) {
                    $device = 'Desktop';
                } elseif ($agent->isMobile()) {
                    $device = 'Mobile';
                } elseif ($agent->isTablet()) {
                    $device = 'Tablet';
                }

                $ip = $latestView->ip_address;
                $viewedAt = $latestView->created_at;
            }

            // Attach all data to item for Blade
            $item->news = $newsMap->get($item->news_id);
            $item->browser = $browser;
            $item->device_type = $device;
            $item->ip_address = $ip;
            $item->viewed_at = $viewedAt;

            return $item;
        });

        // Step 6: Return to Blade view
        return view('layouts.newsDashboard.most_views.index', compact('newsViews'));
    }

    public function show(News $news)
    {
        // Return partial view for modal
        return view('layouts.newsDashboard.most_views.show', compact('news'));
    }
}