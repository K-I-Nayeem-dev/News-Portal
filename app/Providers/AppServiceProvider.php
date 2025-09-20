<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Seo;
use App\Models\Social;
use App\Models\Website_Setting;
use App\Models\Ads;
use App\Models\breaking_news;
use App\Models\District;
use App\Models\Division;
use App\Models\LiveTv;
use App\Models\News;
use App\Models\Notice;
use App\Models\PhotoGallery;
use App\Models\SubCategory;
use App\Models\SubDistrict;
use App\Models\User;
use App\Models\VideoGallery;
use App\Models\Visitor;
use App\Models\BandwidthUsage;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Jenssegers\Agent\Agent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Router $router): void
    {

        // Register alias for bandwidth tracking middleware
        $router->aliasMiddleware('track.bandwidth', \App\Http\Middleware\TrackBandwidth::class);


        // Frontend Global Variables
        View::composer('layouts.newsIndex.newsMaster', function ($view) {

            // Footer Logo //
            $logo = Website_Setting::value('logo');

            // footer details //
            $footer_details = Website_Setting::latest()->first();

            $ip = request()->ip();

            // For local testing, override IP if needed:
            $ip = '119.30.39.113';

            $location = Location::get($ip);

            $cityEn = $location ? $location->cityName : 'Unknown';

            // Simple manual Bangla translations for common BD cities (expand as needed)
            $cityBnMap = [
                'Dhaka' => 'ঢাকা',
                'Chittagong' => 'চট্টগ্রাম',
                'Khulna' => 'খুলনা',
                'Rajshahi' => 'রাজশাহী',
                'Barisal' => 'বরিশাল',
                'Sylhet' => 'সিলেট',
                'Rangpur' => 'রংপুর',
                'Mymensingh' => 'ময়মনসিংহ',
            ];

            $cityBn = $cityBnMap[$cityEn] ?? $cityEn; // fallback to English if not found

            $view->with([
                'meta' => Seo::first(),
                'social' => Social::first(),
                'categories' => Category::where('status', 1)->orderBy('category_bn')->get(),
                'time' => DB::table('breaking_news')->latest()->get(),
                'position_en' => $cityEn,
                'position_bn' => $cityBn,
                'getCates' => Category::latest()->take(8)->get(),
                'webSite_setting' => Website_Setting::latest()->first(),
                'logo' => $logo,
                'footer_details' => $footer_details,
            ]);
        });

        // Backend Global Variables

        View::composer('layouts.newsDashboard.dashboard', function ($view) {

            // For User device Detect Start
            $agent = new Agent();

            // Fetch all user agents from visitor table
            $allAgents = Visitor::pluck('user_agent');

            $visitorCounts = [
                'Mobile' => 0,
                'Tablet' => 0,
                'Desktop' => 0,
                'Other' => 0,
            ];

            foreach ($allAgents as $uaString) {
                $agent->setUserAgent($uaString);

                if ($agent->isMobile() && !$agent->isTablet()) {
                    $visitorCounts['Mobile']++;
                } elseif ($agent->isTablet()) {
                    $visitorCounts['Tablet']++;
                } elseif ($agent->isDesktop()) {
                    $visitorCounts['Desktop']++;
                } else {
                    $visitorCounts['Other']++;
                }
            }
            // For User device Detect End

            // -------------------------
            // ✅ Weather Section
            // -------------------------

            $city = "Dhaka"; // আপনি চাইলে visitor location থেকেও আনতে পারেন
            $apiKey = env('OPENWEATHER_API_KEY');
            $weather = null;

            if ($apiKey) {
                $weatherApiUrl = "https://api.openweathermap.org/data/2.5/weather";

                $response = Http::get($weatherApiUrl, [
                    'q'     => $city,
                    'appid' => $apiKey,
                    'units' => 'metric',
                ]);

                if ($response->successful()) {
                    $weather = $response->json();
                } else {
                    // Debug এর জন্য error message রাখি
                    $weather = [
                        'error' => $response->json('message') ?? 'Weather data not available'
                    ];
                }
            }

            // -------------------------
            // ✅ Weather Section
            // -------------------------

            // -------------------------
            // Bandwidth Usage Data
            // -------------------------

            // ---------- BANDWIDTH: fetch & prepare chart series ----------
            $bandwidths = BandwidthUsage::orderBy('id', 'desc')->get(); // all months, newest first
            $latestBandwidth = $bandwidths->first(); // latest month (or null)
            $totalBandwidthBytes = $bandwidths->sum('used_bytes'); // total across months

            // Build per-month series for sparkline charts (MB units, two decimals)
            $allChartsData = []; // [ id => [mbValues day1..dayN] ]

            foreach ($bandwidths as $bw) {
                $daily = json_decode($bw->daily_data, true) ?? [];

                $series = [];

                // Try to build a full-month series (filling missing days with 0)
                try {
                    $dt = Carbon::createFromFormat('F Y', $bw->month); // month string format expected
                    $daysInMonth = $dt->daysInMonth;

                    for ($d = 1; $d <= $daysInMonth; $d++) {
                        $dateKey = $dt->copy()->day($d)->format('Y-m-d');
                        $bytes = isset($daily[$dateKey]) ? (int)$daily[$dateKey] : 0;
                        // convert bytes -> MB (for chart)
                        $series[] = round($bytes / 1024 / 1024, 2);
                    }
                } catch (\Exception $e) {
                    // Fallback: use whatever keys exist (sorted) — good for partial months or older format
                    ksort($daily);
                    foreach ($daily as $bytes) {
                        $series[] = round((int)$bytes / 1024 / 1024, 2);
                    }
                }

                $allChartsData[$bw->id] = $series;
            }

            // latest chart series (for dashboard single card)
            $latestChartData = $latestBandwidth ? ($allChartsData[$latestBandwidth->id] ?? []) : [];

            // -------------------------
            // Bandwidth Usage Data
            // -------------------------


            // -------------------------
            // Browser Stats
            // -------------------------


            $visitors = DB::table('visitors')->select('user_agent')->get();

            $browserCounts = [];
            foreach ($visitors as $visitor) {
                $agent = new Agent();
                $agent->setUserAgent($visitor->user_agent);
                $browser = $agent->browser(); // যেমন Chrome, Firefox, Safari

                if (!isset($browserCounts[$browser])) {
                    $browserCounts[$browser] = 0;
                }
                $browserCounts[$browser]++;
            }

            $totalVisitors = array_sum($browserCounts);

            $browserLogos = [
                'Chrome' => ['logo' => 'chrome-logo.svg', 'color' => 'info'],
                'Firefox' => ['logo' => 'firefox-logo.svg', 'color' => 'danger'],
                'Safari' => ['logo' => 'safari-logo.svg', 'color' => 'warning'],
                'Internet Explorer' => ['logo' => 'internet-logo.png', 'color' => 'success'],
                'Opera' => ['logo' => 'opera-logo.svg', 'color' => 'primary'],
                'Edge' => ['logo' => 'edge-logo.svg', 'color' => 'info'],
                'Netscape' => ['logo' => 'netscape-logo.png', 'color' => 'danger'],
            ];

            // -------------------------
            // Browser Stats
            // -------------------------




            $ads = Ads::all();
            $headlines = breaking_news::all();
            $headlines_active = breaking_news::where('status', 1)->get();
            $news = News::all();
            $news_active = News::where('status', 1)->get();
            $categories = Category::all();
            $categories_active = Category::where('status', 1)->get();
            $sub_categories = SubCategory::all();
            $sub_categories_active = SubCategory::where('status', 1)->get();
            $division = Division::all();
            $division_active = Division::where('status', 1)->get();
            $district = District::all();
            $district_active = District::where('status', 1)->get();
            $sub_district = SubDistrict::all();
            $sub_district_active = SubDistrict::where('status', 1)->get();
            $photo = PhotoGallery::all();
            $video = VideoGallery::all();
            $social_links = Social::first();
            $seos = Seo::first();
            $live_tv = LiveTv::first();
            $notice = Notice::first();
            $users = User::all();
            $roles = Role::all();
            $permissions = Permission::all();
            $todayVisitors = Visitor::whereDate('visit_date', today())->count();



            $view->with([
                'ads' => $ads,
                'headlines' => $headlines,
                'headlines_active' => $headlines_active,
                'news' => $news,
                'news_active' => $news_active,
                'categories' => $categories,
                'categories_active' => $categories_active,
                'sub_categories' => $sub_categories,
                'sub_categories_active' => $sub_categories_active,
                'division' => $division,
                'division_active' => $division_active,
                'district' => $district,
                'district_active' => $district_active,
                'sub_district' => $sub_district,
                'sub_district_active' => $sub_district_active,
                'photo' => $photo,
                'video' => $video,
                'social_links' => $social_links,
                'seos' => $seos,
                'live_tv' => $live_tv,
                'notice' => $notice,
                'users' => $users,
                'roles' => $roles,
                'permissions' => $permissions,
                'todayVisitors' => $todayVisitors,
                'totalVisitors' => $totalVisitors,
                'visitorData' => $visitorCounts,
                'weather' => $weather,
                'browserCounts' => $browserCounts,
                'browserLogos' => $browserLogos,

                // bandwidth
                'bandwidths' => $bandwidths,
                'latestBandwidth' => $latestBandwidth,
                'totalBandwidthBytes' => $totalBandwidthBytes,
                'latestChartData' => $latestChartData,   // array (MB)
                'allChartsData' => $allChartsData,       // associative array id => series
            ]);
        });



        Gate::before(function ($user, $ability) {
            return $user->hasRole('superadmin') ? true : null;
        });
    }
}
