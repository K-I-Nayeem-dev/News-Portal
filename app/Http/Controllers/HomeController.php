<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LiveTv;
use App\Models\News;
use App\Models\Seo;
use App\Models\Social;
use App\Models\SubCategory;
use App\Models\VideoGallery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Stevebauman\Location\Facades\Location;
use App\Jobs\ConvertDateToBangla;

class HomeController extends Controller
{
    // Method for Home
    public function index()
    {

        // For breaking news and Notice
        $breaking_news = DB::table('breaking_news')->where('status', 1)->latest()->get();
        $notice = DB::table('notices')->where('status', 1)->first();

        // for First section News fsbt = firstSection_bigThumbnail
        $fsbt = News::where('firstSection_bigThumbnail', 'on')->where('status', 1)->latest()->first();

        // for First section News fs = firstSection 1
        $fs1 = News::where('firstSection', 'on')->where('status', 1)->latest()->take(2)->get();

        // for First section News fs = firstSection 1
        $fs2 = News::where('firstSection', 'on')->where('status', 1)->latest()->skip(2)->take(2)->get();

        // for First section News fs = firstSection Select 9 News
        $fs9 = News::where('firstSection', 'on')->where('status', 1)->latest()->skip(4)->take(9)->get();

        // for First section News Trending News
        $tn = News::where('trendyNews', 'on')->where('status', 1)->latest()->take(10)->get();

        // for First section News Special Report
        $sn = videogallery::where('special_news', 'on')->latest()->take(9)->get();

        // Get News for Category national
        $nationalCategory = Category::where('category_en', 'national')->first();

        // News for Category national Big_thumbnail
        $nnbt = News::where('category_id', $nationalCategory->id)->where('status', 1)->latest()->first();
        // News for Category national left side 2 news
        $nnln = News::where('category_id', $nationalCategory->id)->where('status', 1)->latest()->skip(1)->take(2)->get();
        // News for Category national right side 4 news
        $nnrn = News::where('category_id', $nationalCategory->id)->where('status', 1)->latest()->skip(3)->take(5)->get();

        // Get News for Category national
        $entertainmentCategory = Category::where('category_en', 'Entertainment')->first();

        // News for Category Entertenmail Big_thumbnail
        $enbt = News::where('category_id', $entertainmentCategory->id)->where('status', 1)->latest()->first();
        // News for Category Entertenmail left side 2 news
        $enrn = News::where('category_id', $entertainmentCategory->id)->where('status', 1)->latest()->skip(1)->take(4)->get();

        // Get News for Category national
        $countryCategory = Category::where('category_en', 'Country')->first();

        // News for Category Entertenmail Big_thumbnail
        $cnbt = News::where('category_id', $countryCategory->id)->where('status', 1)->latest()->first();
        // News for Category Entertenmail left side 2 news
        $cn1 = News::where('category_id', $countryCategory->id)->where('status', 1)->latest()->skip(1)->take(2)->get();
        $cn2 = News::where('category_id', $countryCategory->id)->where('status', 1)->latest()->skip(3)->take(2)->get();



        return view('layouts.newsIndex.home.home', [
            'breaking_news' => $breaking_news,
            'notice' => $notice,
            'fsbt' => $fsbt,
            'fs1' => $fs1,
            'fs2' => $fs2,
            'fs9' => $fs9,
            'tn' => $tn,
            'sn' => $sn,
            'nnbt' => $nnbt,
            'nnln' =>   $nnln,
            'nnrn' => $nnrn,
            'enbt' => $enbt,
            'enrn' => $enrn,
            'cnbt' => $cnbt,
            'cn1' => $cn1,
            'cn2' => $cn2,
        ]);
    }

    // Method For get sub_cates news
    public function sub_cate_news($name)
    {
        dd('sub_cates: ' . $name);

        // Bangla or English name passed via route
        $subCategory = SubCategory::where('sub_cate_bn', $name)->firstOrFail();

        // Example: get news under this sub-category
        $posts = News::where('sub_cate_id', $subCategory->id)->get();

        return view('frontend.sub_category', compact('subCategory', 'posts'));
    }

    // Method For get Category News
    public function cate_news($name)
    {
        dd('cates: ' . $name);

        // Bangla or English name passed via route
        $subCategory = SubCategory::where('sub_cate_bn', $name)->firstOrFail();

        // Example: get news under this sub-category
        $posts = News::where('sub_cate_id', $subCategory->id)->get();

        return view('frontend.sub_category', compact('subCategory', 'posts'));
    }

    // Method for bangla website
    public function bangla()
    {
        Session::get('lang');
        session()->forget('lang');
        session()->put('lang', 'bangla');
        return back();
    }

    // Method for english website
    public function english()
    {
        Session::get('lang');
        session()->forget('lang');
        session()->put('lang', 'english');
        return back();
    }

    // Method For Watching Live TV
    public function livetv()
    {

        $liveTv = LiveTv::where('status', 1)->first();

        return view('layouts.newsIndex.livetv.index', [
            'liveTv' => $liveTv,
        ]);
    }

    // Method For Watching Live TV
    public function videogallery(Request $request)
    {

        // Video Gallery show in index page with 12 video data
        $videos = VideoGallery::latest()->paginate(3);

        // For Load More (Lazy Load Button)
        if ($request->ajax()) {
            return view('layouts.newsIndex.video_gallery.data', [
                'videos' => $videos
            ]); // a separate view for loop
        }

        // Return view
        return view('layouts.newsIndex.video_gallery.index', [
            'videos' => $videos
        ]);
    }
}
