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

class HomeController extends Controller
{

    // Method for Home
    public function index()
    {

        // Time English To Bangla
        

        // For breaking news and Notice
        $breaking_news = DB::table('breaking_news')->where('status', 1)->latest()->get();
        $notice = DB::table('notices')->where('status', 1)->first();

        // for First section News fsbt = firstSection_bigThumbnail
        $fsbt = News::where('firstSection_bigThumbnail', 'on')->where('status', 1)->latest()->first();

        return view('layouts.newsIndex.home.home', [
            'breaking_news' => $breaking_news,
            'notice' => $notice,
            'fsbt' => $fsbt
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