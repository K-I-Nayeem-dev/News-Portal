<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Seo;
use App\Models\Social;
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
            $view->with([
                'meta' => Seo::first(),
                'social' => Social::first(),
                'categories' => Category::where('status', 1)->orderBy('category_bn')->get(),
                'breaking_news' => DB::table('breaking_news')->where('status', 1)->latest()->get(),
                'time' => DB::table('breaking_news')->latest()->get(),
                'position' => Location::get('119.30.39.113')->cityName
            ]);
        });
    }
}
