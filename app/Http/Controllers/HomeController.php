<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LiveTv;
use App\Models\News;
use App\Models\news_photo;
use App\Models\Seo;
use App\Models\Social;
use App\Models\SubCategory;
use App\Models\VideoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\PhotoGallery;
use Illuminate\Support\Str;

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

        // News for Category country Big_thumbnail
        $cnbt = News::where('category_id', $countryCategory->id)->where('status', 1)->latest()->first();
        // News for Category country left side 2 news
        $cn1 = News::where('category_id', $countryCategory->id)->where('status', 1)->latest()->skip(1)->take(2)->get();
        $cn2 = News::where('category_id', $countryCategory->id)->where('status', 1)->latest()->skip(3)->take(2)->get();


        // Get News for Category international
        $internationalCategory = Category::where('category_en', 'International')->first();

        // News for Category international Big_thumbnail
        $innbt = News::where('category_id', $internationalCategory->id)->where('status', 1)->latest()->first();
        // News for Category international right side 2 news
        $inn2 = News::where('category_id', $internationalCategory->id)->where('status', 1)->latest()->skip(1)->take(2)->get();
        // News for Category international right side 4 news
        $inn4 = News::where('category_id', $internationalCategory->id)->where('status', 1)->latest()->skip(3)->take(4)->get();


        // Get News for Category Sports
        $sportsCategory = Category::where('category_en', 'Sports')->first();

        // News for Category Sports Big_thumbnail
        $snbt = News::where('category_id', $sportsCategory->id)->where('status', 1)->latest()->first();
        // News for Category Sports right side 2 news
        $sn2 = News::where('category_id', $sportsCategory->id)->where('status', 1)->latest()->skip(1)->take(2)->get();
        // News for Category Sports right side 4 news
        $sn4 = News::where('category_id', $sportsCategory->id)->where('status', 1)->latest()->skip(3)->take(4)->get();


        // Get News for Category LifeStyle
        $LifeStyleCategory = Category::where('category_en', 'Lifestyle')->first();

        // News for Category Sports Big_thumbnail
        $lsnbt = News::where('category_id', $LifeStyleCategory->id)->where('status', 1)->latest()->first();
        // News for Category Sports right side 2 news
        $lsnb = News::where('category_id', $LifeStyleCategory->id)->where('status', 1)->latest()->skip(1)->first();
        // News for Category Sports right side 4 news
        $lsnr = News::where('category_id', $LifeStyleCategory->id)->where('status', 1)->latest()->skip(2)->take(4)->get();


        // Get News for Category LifeStyle
        $lawOrderCategory = Category::where('category_en', 'Health')->first();

        // News for Category law-Order Big_thumbnail
        $lonbt = News::where('category_id', $lawOrderCategory->id)->where('status', 1)->latest()->first();

        // News for Category law-Order right side 3 news
        $lonrn3 = News::where('category_id', $lawOrderCategory->id)->where('status', 1)->latest()->skip(1)->take(3)->get();
        // News for Category law-Order right side 4 news
        $lon4 = News::where('category_id', $lawOrderCategory->id)->where('status', 1)->latest()->skip(4)->take(4)->get();


        // Get News for Category Politics
        $politicsCategory = Category::where('category_en', 'Politics')->first();

        // News for Category Politics Big_thumbnail
        $pnbt = News::where('category_id', $politicsCategory->id)->where('status', 1)->latest()->first();
        // News for Category Politics right side 3 news
        $pn3 = News::where('category_id', $politicsCategory->id)->where('status', 1)->latest()->skip(1)->take(3)->get();


        // Get News for Category finance
        $financeCategory = Category::where('category_en', 'Finance')->first();

        // News for Category finance Big_thumbnail
        $fnbt = News::where('category_id', $financeCategory->id)->where('status', 1)->latest()->first();
        // News for Category finance right side 3 news
        $fn3 = News::where('category_id', $financeCategory->id)->where('status', 1)->latest()->skip(1)->take(3)->get();

        // Get News for  Video Gallery Big thumbnail & botton 3 news
        $vgnbt = VideoGallery::where('type', 1)->latest()->first();
        $vgn3 =  VideoGallery::where('type', 0)->latest()->take(3)->get();


        // Get News for  Video Gallery Big thumbnail & botton 3 news
        $pgnbt = PhotoGallery::where('type', 1)->latest()->first();
        $pgn3 =  PhotoGallery::where('type', 0)->latest()->take(3)->get();

        // For Category News Counts
        $categoriesCount = Category::withCount('news')->get();

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
            'innbt' => $innbt,
            'inn2' => $inn2,
            'inn4' => $inn4,
            'snbt' => $snbt,
            'sn2' => $sn2,
            'sn4' => $sn4,
            'lsnbt' => $lsnbt,
            'lsnb' => $lsnb,
            'lsnr' => $lsnr,
            'lonbt' => $lonbt,
            'lonrn3' => $lonrn3,
            'lon4' => $lon4,
            'categoriesCount' => $categoriesCount,
            'vgnbt' => $vgnbt,
            'vgn3' => $vgn3,
            'pgnbt' => $pgnbt,
            'pgn3' => $pgn3,
            'pnbt' => $pnbt,
            'pn3' => $pn3,
            'fnbt' => $fnbt,
            'fn3' => $fn3,
        ]);
    }

    // For Single Page News Show

    public function showFull_news($category, $subcategory = null, $id)
    {
        $news = News::with(['newsCategory', 'newsSubCategory'])->findOrFail($id);

        $expectedCategory = Str::slug($news->newsCategory->category_en);
        $expectedSubcategory = $news->newsSubCategory ? Str::slug($news->newsSubCategory->sub_cate_en) : null;

        if (mb_strtolower($category, 'UTF-8') !== mb_strtolower($expectedCategory, 'UTF-8')) {
            abort(404, 'Category mismatch');
        }

        if ($expectedSubcategory) {
            if (!$subcategory || mb_strtolower($subcategory, 'UTF-8') !== mb_strtolower($expectedSubcategory, 'UTF-8')) {
                abort(404, 'Subcategory mismatch');
            }
        } else {
            if ($subcategory) {
                abort(404, 'Unexpected subcategory');
            }
        }

        $tagsRaw = $news->tags_en; // Only English tags now
        $tags = array_map('trim', explode(',', $tagsRaw));

        // show related Category News
        $relatedNews = News::where('category_id', $news->category_id) // Same category
            ->where('id', '!=', $news->id) // Exclude current news
            ->latest()
            ->take(5) // Limit results if needed
            ->get();

        // If news Have more Photos then show
        $morePhotos = news_photo::where('id',$news->id)->latest()->get();

        // If news Have more Photos then show
        $randomNews = News::latest()->take(100)->get()->random(12);

        return view('layouts.newsIndex.home.show', [
            'news' => $news,
            'tags' => $tags,
            'relatedNews' => $relatedNews,
            'morePhotos' => $morePhotos,
            'randomNews' => $randomNews,
        ]);
    }




    // Method For get sub_cates news
    public function sub_cate_news($name)
    {

        // Bangla or English name passed via route
        $subCategory = SubCategory::where('sub_cate_bn', $name)->firstOrFail();

        // Example: get news under this sub-category
        $posts = News::where('sub_cate_id', $subCategory->id)->get();

        return view('frontend.sub_category', compact('subCategory', 'posts'));
    }

    // Method For get Category News
    public function cate_news($name)
    {

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
