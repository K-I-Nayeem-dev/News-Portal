<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LiveTv;
use App\Models\News;
use App\Models\Seo;
use App\Models\Social;
use App\Models\SubCategory;
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
        return view('layouts.newsIndex.home.home');
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
}