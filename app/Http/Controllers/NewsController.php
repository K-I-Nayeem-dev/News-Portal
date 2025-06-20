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

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::latest()->get();
        return view('layouts.newsDashboard.news.index', [
            'news' => $news
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(News $news)
    {

        $categories = Category::all();
        $sub_cates = SubCategory::all();
        return view('layouts.newsDashboard.news.create', [
            'categories' => $categories,
            'sub_cates' => $sub_cates,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'news_source' => 'required',
            'paragraph' => 'required',
            'category_id' => 'required',
            'sub_cate_id' => 'required',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,gif|max:1024',
            'image_title' => 'required',
            'status' => 'required'
        ]);

        // Image Upload process
        $imageManager = new ImageManager(new Driver());
        $originalFile = $request->file('thumbnail');

        // // Load watermark image
        $watermark1 = $imageManager->read(public_path('uploads/water_mark/water_mark_p.png'));

        // 🔸 1. Save full-sized image

        // Process new image
        $job = new ProcessImageUpload(
            $request->file('thumbnail'),
            'uploads/news_thumbs/',
            650,
            365,
            50,
            'uploads/water_mark/water_mark_t.png'
        );

        // Save $path to DB or whatever you need
        $news_name = Str::random(5) . time() . '.' . $originalFile->getClientOriginalExtension();
        $fullImage = $imageManager->read($originalFile)->resize(1280, 720);
        $fullImage->place($watermark1, 'bottom'); // position: bottom-right with padding
        $fullImage->save(public_path('uploads/news_photos/' . $news_name), quality: 70);

        $data = [
            'title' => $request->title,
            'user_id' => Auth::id(),
            'news_source' => $request->news_source,
            'paragraph' => $request->paragraph,
            'category_id' => $request->category_id,
            'sub_cate_id' => $request->sub_cate_id,
            'image_title' => $request->image_title,
            'news_photo' => $news_name,
            'url' => $request->url,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => null
        ];

        $data['thumbnail'] = $job->handle();

        DB::table('news')->insert($data);


        return back()->with('news_created', 'News Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view('layouts.newsDashboard.news.show',[
            'news' => $news
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        //
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