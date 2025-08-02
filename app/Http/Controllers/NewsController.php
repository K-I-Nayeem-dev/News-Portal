<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Jobs\ProcessImageUpload;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use App\Jobs\ConvertDateToBangla;
use App\Models\District;
use App\Models\Division;
use App\Models\news_photo;
use App\Models\SubDistrict;
use App\Models\watermark;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::latest()->paginate(50);
        return view('layouts.newsDashboard.news.index', [
            'news' => $news
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::all();
        $divisions = Division::orderBy('division_en', 'ASC')->get();
        $districts = District::orderBy('district_en', 'ASC')->get();
        return view('layouts.newsDashboard.news.create', [
            'categories' => $categories,
            'divisions' => $divisions,
            'districts' => $districts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title_en' => 'required',
            'title_bn' => 'required',
            'news_source' => 'required',
            'details_en' => 'required',
            'details_bn' => 'required',
            'category_id' => 'required',
            'sub_cate_id' => 'required',
            'division_id' => 'required',
            'dist_id' => 'required',
            'tags_en' => 'required',
            'tags_bn' => 'required',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,gif|max:1024',
            'image_title' => 'required',
            'status' => 'required'
        ]);


        // // This is dynamic watermark
        $watermark = watermark::where('status', 1)->first();
        // check that watermark found or missing
        if (!$watermark || !file_exists(public_path($watermark->watermark))) {
            return back()->withErrors(['Thumbnail Watermark not found or file missing.']);
        }

        // // Image Upload process
        $imageManager = new ImageManager(new Driver());
        $originalFile = $request->file('thumbnail');

        // // // Load watermark image
        $watermark1 = $imageManager->read(public_path($watermark->watermark));

        // 🔸 1. Save full-sized image

        // Process new image
        $job = new ProcessImageUpload(
            $request->file('thumbnail'),
            'uploads/news_thumbs/',
            650,
            365,
            50,
            $watermark->watermark
        );

        // Save $path to DB or whatever you need
        $news_name =  uniqid() . '_' . time() . '.' . $originalFile->getClientOriginalExtension();
        $fullImage = $imageManager->read($originalFile)->resize(1280, 720);
        $fullImage->place($watermark1, 'bottom'); // position: bottom-right with padding
        $fullImage->save(public_path('uploads/news_photos/' . $news_name), quality: 70);

        $data = [
            'title_en' => $request->title_en,
            'title_bn' => $request->title_bn,
            'user_id' => Auth::id(),
            'news_source' => $request->news_source,
            'details_en' => $request->details_en,
            'details_bn' => $request->details_bn,
            'category_id' => $request->category_id,
            'sub_cate_id' => $request->sub_cate_id,
            'division_id' => $request->division_id,
            'dist_id' => $request->dist_id,
            'sub_dist_id' => $request->sub_dist_id,
            'tags_en' => $request->tags_en,
            'tags_bn' => $request->tags_bn,
            'image_title' => $request->image_title,
            'news_photo' => $news_name,
            'url' => $request->url,
            'genaralBigThumbnail' => $request->genarelBigThumbnail,
            'firstSection_bigThumbnail' => $request->firstSectionBigThumbnail,
            'firstSection' => $request->firstSection,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => null
        ];

        // upload image thumbnail
        $data['thumbnail'] = $job->handle();

        // Store data and get news_id for upload multiple image in database
        $news_id = DB::table('news')->insertGetId($data);


        if ($request->has('news_photos')) {

            // upload multiple image if multiple photos choosen
            foreach ($request->file('news_photos') as $photo) {
                $news_photo_name =  uniqid() . '_'  . time() . '.' . $photo->getClientOriginalExtension();

                // ✅ Fix: Use getPathname() to read file safely
                $fullImage1 = $imageManager->read($photo)->resize(650, 365);
                $fullImage1->place($watermark1, 'bottom');
                $fullImage1->save(public_path('uploads/news_related_photos/' . $news_photo_name), quality: 50);

                news_photo::create([
                    'user_id' => Auth::id(),
                    'news_id' => $news_id,
                    'photo' => $news_photo_name,
                    'created_at' => now(),
                    'updated_at' => null,
                ]);
            }
        }


        // return back to news created page
        return back()->with('news_created', 'News Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view('layouts.newsDashboard.news.show', [
            'news' => $news,
        ]);
    }



    /**
     * Display the Bangla version.
     */
    public function show_bn($id)
    {

        $news = News::findOrFail($id);
        $datetime = $news->created_at;

        $job = new ConvertDateToBangla($datetime);
        $job->handle();  // run immediately, so we get result

        $news_photos = news_photo::where('news_id', $news->id)->get();


        $banglaDateTime = $job->result;
        return view('layouts.newsDashboard.news.show_news_bn', [
            'news' => $news,
            'banglaTime' => $banglaDateTime,
            'news_photos' => $news_photos
        ]);
    }

    /**
     * Display the English version.
     */
    public function show_en($id)
    {

        $news = News::findOrFail($id);
        $news_photos = news_photo::where('news_id', $news->id)->get();

        return view('layouts.newsDashboard.news.show_news_en', [
            'news' => $news,
            'news_photos' => $news_photos
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        // Get Categories and Sub Categories get
        $categories = Category::all();
        $sub_cates = SubCategory::where('category_id', $news->category_id)->get();

        // Get Division ?? District and Sub Districts get
        $divisions = Division::all();
        $districts = District::where('division_id', $news->division_id)->get();
        $sub_dists = SubDistrict::where('district_id', $news->dist_id)->get();
        return view('layouts.newsDashboard.news.edit', [
            'news' => $news,
            'categories' => $categories,
            'sub_cates' => $sub_cates,
            'divisions' => $divisions,
            'districts' => $districts,
            'sub_dists' => $sub_dists,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */

    // This Code fully Work Perfecly update News
    public function update(Request $request, $id)
    {

        $news = News::findOrFail($id);

        // ✅ If only 'status' is sent (via dropdown onchange form)
        if ($request->has('status') && count($request->all()) === 3) {
            // 3 fields come from the form: _token, _method, and status
            if ($request->status == '1' || $request->status == '0') {
                $news->status = $request->status;
                $news->update_by_user = Auth::id();
                $news->save();

                return back()->with('status_update', 'Status updated successfully.');
            } else {
                return back()->with('error', 'Invalid status value.');
            }
        }



        // ✅ Full form update (title, paragraph, thumbnail, etc.)
        $request->validate([
            'title_en' => 'required',
            'title_bn' => 'required',
            'news_source' => 'required',
            'details_en' => 'required',
            'details_bn' => 'required',
            'category_id' => 'required',
            'sub_cate_id' => 'required',
            'division_id' => 'required',
            'dist_id' => 'required',
            'sub_dist_id' => 'required',
            'tags_en' => 'required',
            'tags_bn' => 'required',
            'image_title' => 'required',
            'status' => 'required'
        ]);

        // Fill and update
        $news->fill($request->only([
            'title_en',
            'title_bn',
            'news_source',
            'details_en',
            'details_bn',
            'category_id',
            'sub_cate_id',
            'division_id',
            'dist_id',
            'sub_dist_id',
            'tags_en',
            'tags_bn',
            'image_title',
            'url',
            'status',
        ]));

        // for news section update
        $news->firstSection_bigThumbnail = $request->firstSection_bigThumbnail; // 'on' or 'off'
        $news->firstSection = $request->firstSection; // 'on' or 'off'
        $news->genaralBigThumbnail = $request->genaralBigThumbnail; // 'on' or 'off'

        if ($request->hasFile('thumbnail')) {
            // Delete old images
            if ($news->news_photo && file_exists(public_path('uploads/news_photos/' . $news->news_photo))) {
                unlink(public_path('uploads/news_photos/' . $news->news_photo));
            }
            if ($news->thumbnail && file_exists(public_path($news->thumbnail))) {
                unlink(public_path($news->thumbnail));
            }

            // Load dynamic watermark
            $watermark = watermark::where('status', 1)->first();
            if (!$watermark || !file_exists(public_path($watermark->watermark))) {
                return back()->withErrors(['Thumbnail Watermark not found or file missing.']);
            }

            $imageManager = new ImageManager(new Driver());
            $originalFile = $request->file('thumbnail');
            $watermarkImage = $imageManager->read(public_path($watermark->watermark));

            // ✅ Full-size image with watermark
            $new_name = uniqid() . '_' . time() . '.' . $originalFile->getClientOriginalExtension();
            $fullImage = $imageManager->read($originalFile)->resize(1280, 720);
            $fullImage->place($watermarkImage, 'bottom-right'); // with padding
            $fullImage->save(public_path('uploads/news_photos/' . $new_name), quality: 70);
            $news->news_photo = $new_name;

            // ✅ Create thumbnail
            $job = new ProcessImageUpload(
                $originalFile,
                'uploads/news_thumbs/',
                650,
                365,
                50,
                $watermark->watermark // ✅ fixed typo
            );
            $news->thumbnail = $job->handle(); // must return filename
        }

        $news->update_by_user = Auth::id();
        $news->save();

        return back()->with('news_update', 'News updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete();
        return back()->with('news_delete', 'News Deleted');
    }
}