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
use App\Models\Tags;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class NewsController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view news', only: ['index']),
            new Middleware('permission:edit news', only: ['edit']),
            new Middleware('permission:create news', only: ['create']),
            new Middleware('permission:delete news', only: ['destroy']),
        ];
    }

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


        $categories = Category::with(['subCategories' => function ($query) {
            $query->orderBy('order', 'asc'); // order subcategories
        }])
            ->orderBy('order', 'asc') // order categories
            ->get();

        $divisions = Division::orderBy('division_en', 'ASC')->get();
        $districts = District::orderBy('district_en', 'ASC')->get();
        $tags = Tags::orderBy('tag_en', 'ASC')->get();
        return view('layouts.newsDashboard.news.create', [
            'categories' => $categories,
            'divisions' => $divisions,
            'districts' => $districts,
            'tags' => $tags,
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
            'tags_en' => 'nullable|string',
            'tags_bn' => 'nullable|string',
            'category_id' => 'required',
            'division_id' => 'required',
            'dist_id' => 'required',
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

        // Process new image for thumbnail
        $job = new ProcessImageUpload(
            $request->file('thumbnail'),
            'uploads/news_thumbs/',
            1200,
            830,
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
            'image_title' => $request->image_title,
            'news_photo' => $news_name,
            'url' => $request->url,
            'trendyNews' => $request->trendyNews ? 1 : 0,
            'firstSection_bigThumbnail' => $request->firstSection_bigThumbnail ? 1 : 0,
            'firstSection' => $request->firstSection ? 1 : 0,
            'status' => $request->status ? 1 : 0,
            'created_at' => now(),
            'updated_at' => null
        ];

        // upload image thumbnail
        $data['thumbnail'] = $job->handle();

        // Store data using Eloquent model
        $news = News::create($data);
        $news_id = $news->id;


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

        // Split and clean incoming tags
        $tagsEn = array_filter(array_map('trim', explode(',', $request->tag_en)));
        $tagsBn = array_filter(array_map('trim', explode(',', $request->tag_bn)));

        $tagIds = [];

        foreach ($tagsEn as $index => $enName) {
            $bnName = $tagsBn[$index] ?? null;

            // Insert new tag if not exists, or get existing tag
            $tag = Tags::firstOrCreate(
                ['tag_en' => $enName], // unique column
                ['tag_bn' => $bnName]  // additional data
            );

            $tagIds[] = $tag->id;
        }

        // After the existing tag creation loop
        if (!empty($tagIds)) {
            $pivotData = [];
            foreach ($tagIds as $tagId) {
                $pivotData[] = [
                    'news_id' => $news_id,
                    'tag_id' => $tagId,
                    'created_at' => now(),
                    'updated_at' => null
                ];
            }

            DB::table('news_tags')->insert($pivotData); // Make sure table name matches your migration
        }

        // return back to news created page
        return back()->with('news_created', 'News Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $news = News::findOrFail($id);
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
    public function edit($id)
    {
        $news = News::with('tags')->findOrFail($id); // Load news with its tags

        // Get Categories and Sub Categories
        $categories = Category::all();
        $sub_cates = SubCategory::where('category_id', $news->category_id)->get();

        // Get Division, District and Sub Districts
        $divisions = Division::all();
        $districts = District::where('division_id', $news->division_id)->get();
        $sub_dists = SubDistrict::where('district_id', $news->dist_id)->get();

        // Get all tags and selected tag IDs
        $all_tags = Tags::all();
        $selected_tag_ids = $news->tags->pluck('id')->toArray(); // Get selected tag IDs as array

        // Get selected tags for display (if you need them separately)
        $selected_tags = $news->tags;

        return view('layouts.newsDashboard.news.edit', [
            'news' => $news,
            'categories' => $categories,
            'sub_cates' => $sub_cates,
            'divisions' => $divisions,
            'districts' => $districts,
            'sub_dists' => $sub_dists,
            'all_tags' => $all_tags,
            'selected_tag_ids' => $selected_tag_ids,
            'selected_tags' => $selected_tags,
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

                flash()
                    ->addSuccess('Status updated successfully', [
                        'position' => 'bottom-center', // 👈 correct way
                    ]);
                return back();
            } else {
                flash()
                    ->addError('Invalid status value.', [
                        'position' => 'bottom-center', // 👈 correct way
                    ]);
                return back();
            }
        }

        // ✅ Full form update (title, paragraph, thumbnail, etc.)
        $request->validate([
            'title_en' => 'required',
            'title_bn' => 'required',
            'news_source' => 'required',
            'details_en' => 'required',
            'details_bn' => 'required',
            'tag_en' => 'nullable|string',
            'tag_bn' => 'nullable|string',
            'category_id' => 'required',
            'division_id' => 'required',
            'dist_id' => 'required',
            'sub_dist_id' => 'required',
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
            'image_title',
            'url',
            'status',
        ]));

        // ✅ Convert checkbox values to integers (0 or 1)
        $news->firstSection_bigThumbnail = $request->firstSection_bigThumbnail == '1' ? 1 : 0;
        $news->firstSection = $request->firstSection == '1' ? 1 : 0;
        $news->trendyNews = $request->trendyNews == '1' ? 1 : 0;

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
                1200,
                830,
                50,
                $watermark->watermark
            );
            $news->thumbnail = $job->handle();
        }

        $news->update_by_user = Auth::id();
        $news->save();

        // ✅ Handle Tags Update
        if ($request->has('tag_en') || $request->has('tag_bn')) {
            // Split and clean incoming tags
            $tagsEn = array_filter(array_map('trim', explode(',', $request->tag_en ?? '')));
            $tagsBn = array_filter(array_map('trim', explode(',', $request->tag_bn ?? '')));

            $tagIds = [];

            // Process each English tag with corresponding Bengali tag
            foreach ($tagsEn as $index => $enName) {
                if (!empty($enName)) {
                    $bnName = $tagsBn[$index] ?? null;

                    // Insert new tag if not exists, or get existing tag
                    $tag = Tags::firstOrCreate(
                        ['tag_en' => $enName], // unique column
                        ['tag_bn' => $bnName]  // additional data
                    );

                    $tagIds[] = $tag->id;
                }
            }

            // Update tags relationship (sync will remove old tags and add new ones)
            if (!empty($tagIds)) {
                $news->tags()->sync($tagIds);
            } else {
                // If no tags provided, remove all existing tags
                $news->tags()->detach();
            }
        }

        flash()
            ->addSuccess('News Update', [
                'position' => 'bottom-center', // 👈 correct way
            ]);

        return back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        News::findOrFail($id)->delete();
        return back()->with('news_delete', 'News Deleted');
    }
}
