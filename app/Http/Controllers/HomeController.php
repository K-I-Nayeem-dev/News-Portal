<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Division;
use App\Models\LiveTv;
use App\Models\News;
use App\Models\news_photo;
use App\Models\SubCategory;
use App\Models\VideoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\PhotoGallery;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use App\Models\Ads;
use App\Models\Tags;
use App\Models\Poll;

class HomeController extends Controller
{
    // Method for Home
    public function index()
    {

        // For breaking news and Notice
        $breaking_news = DB::table('breaking_news')->where('status', 1)->latest()->get();
        $notice = DB::table('notices')->where('status', 1)->first();

        // for First section News fsbt = firstSection_bigThumbnail
        $fsbt = News::where('firstSection_bigThumbnail', 1)->where('status', 1)->latest()->first();


        // for First section News fs = firstSection 1
        $fs1 = News::where('firstSection', 1)->where('status', 1)->latest()->take(2)->get();

        // for First section News fs = firstSection 1
        $fs2 = News::where('firstSection', 1)->where('status', 1)->latest()->skip(2)->take(2)->get();

        // for First section News fs = firstSection Select 9 News
        $fs9 = News::where('firstSection', 1)->where('status', 1)->latest()->skip(4)->take(9)->get();

        // for First section News Trending News
        $tn = News::where('trendyNews', 1)->where('status', 1)->latest()->take(10)->get();

        // for First section News Special Report
        $sn = videogallery::where('special_news', 1)->latest()->take(9)->get();

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

        // Get News for Category JObs
        $jobsCategory = Category::where('category_en', 'Jobs')->first();

        // News for Category JObs Big_thumbnail
        $jnbt = News::where('category_id', $jobsCategory->id)->where('status', 1)->latest()->first();
        // News for Category finance right side 3 news
        $jn3 = News::where('category_id', $jobsCategory->id)->where('status', 1)->latest()->skip(1)->take(3)->get();


        // Get News for Category Others
        $othersCategory = Category::where('category_en', 'Others')->first();

        // News for Category Others Big_thumbnail
        $onbt = News::where('category_id', $othersCategory->id)->where('status', 1)->latest()->first();
        // News for Category finance right side 3 news
        $on3 = News::where('category_id', $othersCategory->id)->where('status', 1)->latest()->skip(1)->take(3)->get();


        // Get News for Category Crimes
        $crimesCategory = Category::where('category_en', 'Crimes')->first();

        // News for Category Crimes Big_thumbnail
        $crnbt = News::where('category_id', $crimesCategory->id)->where('status', 1)->latest()->first();
        // News for Category finance right side 3 news
        $crn3 = News::where('category_id', $crimesCategory->id)->where('status', 1)->latest()->skip(1)->take(3)->get();


        // Get News for Category Crimes
        $technologyCategory = Category::where('category_en', 'Technologies')->first();

        // News for Category Crimes Big_thumbnail
        $tnbt = News::where('category_id', $technologyCategory->id)->where('status', 1)->latest()->first();
        // News for Category finance right side 3 news
        $tn3 = News::where('category_id', $technologyCategory->id)->where('status', 1)->latest()->skip(1)->take(3)->get();

        // Get News for  Video Gallery Big thumbnail & botton 3 news
        $vgnbt = VideoGallery::where('type', 1)->latest()->first();
        $vgn3 =  VideoGallery::where('type', 0)->latest()->take(3)->get();


        // Get News for  Video Gallery Big thumbnail & botton 3 news
        $pgnbt = PhotoGallery::where('type', 1)->latest()->first();
        $pgn3 =  PhotoGallery::where('type', 0)->latest()->take(3)->get();

        $divisions = Division::orderBy('division_en', 'ASC')->get();

        $fbp = Ads::where('front_bottom', 1)->first();


        // For Category News Counts
        $tagsWithNewsCount = Tags::withCount('news')
            ->having('news_count', '>', 0)
            ->get();

        // For Polls
        $poll = Poll::where('is_active', 1)
            ->where('expires_at', '>=', now())
            ->with('options')
            ->latest()
            ->first();

        $totalVotes = $poll ? $poll->options->sum('votes_count') : 0;


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
            'tagsWithNewsCount' => $tagsWithNewsCount,
            'vgnbt' => $vgnbt,
            'vgn3' => $vgn3,
            'pgnbt' => $pgnbt,
            'pgn3' => $pgn3,
            'pnbt' => $pnbt,
            'pn3' => $pn3,
            'fnbt' => $fnbt,
            'fn3' => $fn3,
            'jnbt' => $jnbt,
            'jn3' => $jn3,
            'onbt' => $onbt,
            'on3' => $on3,
            'crnbt' => $crnbt,
            'crn3' => $crn3,
            'tnbt' => $tnbt,
            'tn3' => $tn3,
            'divisions' => $divisions,
            'fbp' => $fbp,
            'poll' => $poll,
            'totalVotes' => $totalVotes,

        ]);
    }

    // Only Category News Show when Click Nav
    public function getCate_news($categoryName, Request $request)
    {
        // Find category by English name
        $category = Category::where('slug', $categoryName)->firstOrFail();
        $get_subcates = SubCategory::where('category_id', $category->id)->orderBy('sub_cate_en', 'DESC')->get();

        // Fetch latest news in that category
        $cnbt = News::where('category_id', $category->id)->latest()->first();
        $cn2 = News::where('category_id', $category->id)->latest()->skip(1)->take(2)->get();
        $cn4 = News::where('category_id', $category->id)->latest()->skip(3)->take(4)->get();

        // For Infinite News Scroll
        $acn = News::where('category_id', $category->id)->latest()->skip(7)->paginate(10);
        if ($request->ajax()) {
            $view = view('layouts.newsIndex.category_news.load', compact('acn'))->render();
            return Response::json(['view' => $view, 'nextPageUrl' => $acn->nextPageUrl()]);
        }

        $cs1 = Ads::where('category_sidebar1', 1)->first();
        $cs2 = Ads::where('category_sidebar2', 1)->first();




        // Retrun view with compact variable
        return view('layouts.newsIndex.category_news.index', [
            'category' => $category,
            'get_subcates' => $get_subcates,
            'cnbt' => $cnbt,
            'cn2' => $cn2,
            'cn4' => $cn4,
            'acn' => $acn,
            'cs1' => $cs1,
            'cs2' => $cs2,
        ]);
    }





    // For Single Page News Show
    public function showFull_news($category, $subcategory = null, $id)
    {
        $news = News::with(['newsCategory', 'newsSubCategory', 'tags'])->findOrFail($id);

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



        // show related Category News
        $relatedNews = News::where('category_id', $news->category_id) // Same category
            ->where('id', '!=', $news->id) // Exclude current news
            ->latest()
            ->take(5) // Limit results if needed
            ->get();

        // If news Have more Photos then show
        $morePhotos = news_photo::where('id', $news->id)->latest()->get();

        // If news Have more Photos then show
        $randomNews = News::latest()->take(100)->get()->random(12);

        $nlb = Ads::where('news_left_banner', 1)->first();
        $n3s_1 = Ads::where('news_3_sidebar', 1)->first();
        $n3s_2 = Ads::where('news_3_sidebar', 1)->skip(1)->first();
        $n3s_3 = Ads::where('news_3_sidebar', 1)->skip(2)->first();
        $fbp = Ads::where('front_bottom', 1)->first();
        $nb = Ads::where('news_bottom', 1)->first();
        $nm = Ads::where('news_details_middle', 1)->first();




        return view('layouts.newsIndex.home.show', [
            'news' => $news,
            'relatedNews' => $relatedNews,
            'morePhotos' => $morePhotos,
            'randomNews' => $randomNews,
            'nlb' => $nlb,
            'n3s_1' => $n3s_1,
            'n3s_2' => $n3s_2,
            'n3s_3' => $n3s_3,
            'fbp' => $fbp,
            'nb' => $nb,
            'nm' => $nm,
        ]);
    }

    // Method For get sub_cates news
    public function sub_cate_news($categorySlug, $subCategorySlug, Request $request)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $subCategory = SubCategory::where('slug', $subCategorySlug)
            ->where('category_id', $category->id)
            ->firstOrFail();


        // Fetch latest news in that category
        $scnbt = News::where('sub_cate_id', $subCategory->id)->latest()->first();
        $scn2 = News::where('sub_cate_id', $subCategory->id)->latest()->skip(1)->take(2)->get();
        $scn4 = News::where('sub_cate_id', $subCategory->id)->latest()->skip(3)->take(4)->get();

        // For Infinite News Scroll
        $ascn = News::where('sub_cate_id', $subCategory->id)->latest()->skip(7)->paginate(10);

        if ($request->ajax()) {
            $view = view('layouts.newsIndex.subcategory_news.load', compact('ascn'))->render();
            return response()->json(['view' => $view, 'nextPageUrl' => $ascn->nextPageUrl()]);
        }

        $scs1 = Ads::where('subcategory_sidebar1', 1)->first();
        $scs2 = Ads::where('subcategory_sidebar2', 1)->first();


        return view('layouts.newsIndex.subcategory_news.index', [
            'category' => $category,
            'subCategory' => $subCategory,
            'scnbt' => $scnbt,
            'scn2' => $scn2,
            'scn4' => $scn4,
            'ascn' => $ascn,
            'scs1' => $scs1,
            'scs2' => $scs2,

        ]);
    }

    // In your NewsController (or appropriate controller)

    public function getTagNews($slug)
    {
        // Try to find tag by slug column
        $tag = Tags::where('slug', $slug)->first();

        // Get news only if tag exists
        $tagNews = $tag
            ? News::with(['newsCategory', 'newsSubcategory', 'tags'])
            ->whereHas('tags', function ($query) use ($tag) {
                $query->where('tags.id', $tag->id);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(50)
            : collect(); // empty collection if no tag

        // Pass data to Blade
        return view('layouts.newsIndex.tags.index', compact('tag', 'tagNews'));
    }




    // Method for english website
    public function english()
    {
        Session::get('lang');
        session()->forget('lang');
        session()->put('lang', 'english');
        return back();
    }

    // Method for Bangla website
    public function bangla()
    {
        Session::get('lang');
        session()->forget('lang');
        session()->put('lang', 'bangla');
        return back();
    }

    // Method For Watching Live TV
    public function livetv()
    {

        $liveTv = LiveTv::where('status', 1)->first();

        $ls1 = Ads::where('liveTv_sidebar1', 1)->first();
        $ls2 = Ads::where('liveTv_sidebar2', 1)->first();
        $lb = Ads::where('liveTv_bottom', 1)->first();



        return view('layouts.newsIndex.livetv.index', [
            'liveTv' => $liveTv,
            'ls1' => $ls1,
            'ls2' => $ls2,
            'lb' => $lb,
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

    public function all_polls()
    {

        // Get the poll that's showing on the homepage
        $homepagePoll = Poll::where('is_active', 1)
            ->where('expires_at', '>=', now())
            ->latest()
            ->first();

        // Get all polls except the homepage poll
        $polls = Poll::with('options')
            ->when($homepagePoll, function ($query) use ($homepagePoll) {
                $query->where('id', '!=', $homepagePoll->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('layouts.newsIndex.polls.index', [
            'polls' => $polls,
        ]);
    }

    // For news Search
    public function search(Request $request)
    {
        $query = $request->input('q');

        if (empty($query)) {
            return redirect()->back()->with('error', 'Please enter a search term');
        }

        $news = News::with(['newsCategory', 'newsSubCategory', 'tags'])
            ->where(function ($q) use ($query) {
                // Search in news title (English and Bengali)
                $q->where('title_en', 'LIKE', "%{$query}%")
                    ->orWhere('title_bn', 'LIKE', "%{$query}%")

                    // Search in news content (English and Bengali)
                    ->orWhere('details_en', 'LIKE', "%{$query}%")
                    ->orWhere('details_bn', 'LIKE', "%{$query}%")

                    // Search in category (English and Bengali)
                    ->orWhereHas('newsCategory', function ($q) use ($query) {
                        $q->where('category_en', 'LIKE', "%{$query}%")
                            ->orWhere('category_bn', 'LIKE', "%{$query}%");
                    })

                    // Search in subcategory (English and Bengali)
                    ->orWhereHas('newsSubCategory', function ($q) use ($query) {
                        $q->where('sub_cate_en', 'LIKE', "%{$query}%")
                            ->orWhere('sub_cate_bn', 'LIKE', "%{$query}%");
                    })

                    // Search in tags (English and Bengali)
                    ->orWhereHas('tags', function ($q) use ($query) {
                        $q->where('tag_en', 'LIKE', "%{$query}%")
                            ->orWhere('tag_bn', 'LIKE', "%{$query}%");
                    });
            })
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(30);

        return view('layouts.newsIndex.search.index', compact('news', 'query'));
    }

    // Location Search with division->district->subdistrict

    public function country_search(Request $request)
    {
        $divisionId    = $request->query('division_id');
        $districtId    = $request->query('district_id');
        $subdistrictId = $request->query('subdistrict_id');

        $query = News::query();

        if ($divisionId) {
            $query->where('division_id', $divisionId);
        }

        if ($districtId) {
            $query->where('district_id', $districtId);
        }

        if ($subdistrictId) {
            $query->where('subdistrict_id', $subdistrictId);
        }

        $news = $query->latest()->paginate(15);

        return view('layouts.newsIndex.search.country_search', compact('news'));
    }
}