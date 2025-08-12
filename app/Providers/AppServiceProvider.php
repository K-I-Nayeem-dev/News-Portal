<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Seo;
use App\Models\Social;
use App\Models\Website_Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\ServiceProvider;


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
    public function boot(): void
    {

        View::composer('layouts.newsIndex.newsMaster', function ($view) {
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
            ]);
        });
    }
}