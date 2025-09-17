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
use App\Models\VideoGallery;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;


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

        // Frontend Global Variables
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

        // Backend Global Variables

        View::composer('layouts.newsDashboard.dashboard', function ($view) {

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
            ]);
        });



        Gate::before(function ($user, $ability) {
            return $user->hasRole('superadmin') ? true : null;
        });
    }
}
