<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        // Category & Subcategories
        $categories = Category::orderBy('category_bn', 'ASC')->where('status', 1)->get();
        $sub_cates = SubCategory::where('status', 1)->get();

        $breaking_news = DB::table('breaking_news')->where('status', 1)->latest()->get();
        $time = DB::table('breaking_news')->latest()->get();

        return view('layouts.newsIndex.home', [

            'position' => Location::get('119.30.39.113')->cityName,
            'breaking_news' => $breaking_news,
            'time' => $time,
            'categories' => $categories,
            'sub_cates' => $sub_cates,

        ]);
    }
}