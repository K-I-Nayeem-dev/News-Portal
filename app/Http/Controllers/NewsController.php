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
use App\Models\news_photo;
use App\Models\watermark;

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
            'uploads/water_mark/water_mark_t.png'
        );

        // Save $path to DB or whatever you need
        $news_name =  uniqid() . '_'. time() . '.' . $originalFile->getClientOriginalExtension();
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
        $datetime = $news->created_at;

        $job = new ConvertDateToBangla($datetime);
        $job->handle();  // run immediately, so we get result

        $news_photos = news_photo::where('news_id', $news->id)->get();


        $banglaDateTime = $job->result;
        return view('layouts.newsDashboard.news.show', [
            'news' => $news,
            'banglaTime' => $banglaDateTime,
            'news_photos' => $news_photos
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $categories = Category::all();
        $sub_cates = SubCategory::all();
        return view('layouts.newsDashboard.news.edit', [
            'news' => $news,
            'categories' => $categories,
            'sub_cates' => $sub_cates,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, News $news)
    // {
    //     $request->validate([
    //         'title' => 'required',
    //         'news_source' => 'required',
    //         'paragraph' => 'required',
    //         'category_id' => 'required',
    //         'sub_cate_id' => 'required',
    //         'thumbnail' => 'required|image|mimes:jpg,jpeg,png,gif|max:1024',
    //         'image_title' => 'required',
    //         'status' => 'required'
    //     ]);

    //     // // Image Upload process
    //     // $imageManager = new ImageManager(new Driver());
    //     // $originalFile = $request->file('thumbnail');

    //     // // // Load watermark image
    //     // $watermark1 = $imageManager->read(public_path('uploads/water_mark/water_mark_p.png'));

    //     // // 🔸 1. Save full-sized image

    //     // // Process new image
    //     // $job = new ProcessImageUpload(
    //     //     $request->file('thumbnail'),
    //     //     'uploads/news_thumbs/',
    //     //     650,
    //     //     365,
    //     //     50,
    //     //     'uploads/water_mark/water_mark_t.png'
    //     // );

    //     // // Save $path to DB or whatever you need
    //     // $news_name = Str::random(5) . time() . '.' . $originalFile->getClientOriginalExtension();
    //     // $fullImage = $imageManager->read($originalFile)->resize(1280, 720);
    //     // $fullImage->place($watermark1, 'bottom'); // position: bottom-right with padding
    //     // $fullImage->save(public_path('uploads/news_photos/' . $news_name), quality: 70);


    //     // $news->title = $request->title;
    //     // $news->user_id = Auth::id();
    //     // $news->news_source = $request->news_source;
    //     // $news->paragraph = $request->paragraph;
    //     // $news->category_id = $request->category_id;
    //     // $news->sub_cate_id = $request->sub_cate_id;
    //     // $news->image_title = $request->image_title;
    //     // $news->news_photo = $news_name;
    //     // $news->url = $request->url;
    //     // $news->status = $request->status;
    //     // $news->created_at = now();
    //     // $news->updated_at = null;
    //     // $news->thumbnail = $job->handle();
    //     // $news->save();

    //     // 🔸 Setup image file
    //     $originalFile = $request->file('thumbnail');

    //     // 🔸 Generate new image name
    //     $new_name = Str::random(5) . time() . '.' . $originalFile->getClientOriginalExtension();

    //     $Image = new ImageManager(new Driver());


    //     if ($request->hasFile('thumbnail')) {

    //         // 👉 Full image
    //         $watermark1 = $Image->read(public_path('uploads/water_mark/water_mark_p.png'));
    //         $full = $Image->read($originalFile)->resize(1280, 720);
    //         $full->place($watermark1, 'bottom');
    //         $full->save(public_path('uploads/news_photos/' . $new_name), quality: 70);

    //         // 👉 Thumbnail via job
    //         $job = new ProcessImageUpload(
    //             $originalFile,
    //             'uploads/news_thumbs/',
    //             650,
    //             365,
    //             50,
    //             'uploads/water_mark/water_mark_t.png'
    //         );

    //         $news->fill($request->only([
    //             'title',
    //             'news_source',
    //             'paragraph',
    //             'category_id',
    //             'sub_cate_id',
    //             'image_title',
    //             'url',
    //             'status'
    //         ]))->fill([
    //             'user_id' => Auth::id(),
    //             'news_photo' => $new_name,
    //             'thumbnail' => $job->handle(),
    //             'updated_at' => now()
    //         ])->save();

    //     } else {

    //         // 🔸 Delete old main photo
    //         $mainPath = public_path('uploads/news_photos/' . $news->news_photo);
    //         if (file_exists($mainPath)) {
    //             unlink($mainPath);
    //         }

    //         // 🔸 Delete old thumbnail
    //         $thumbPath = public_path($news->thumbnail); // Assuming full relative path stored
    //         if (file_exists($thumbPath)) {
    //             unlink($thumbPath);
    //         }

    //         // 🔁 Re-upload full image
    //         $watermark1 = $Image->read(public_path('uploads/water_mark/water_mark_p.png'));
    //         $full = $Image->read($originalFile)->resize(1280, 720);
    //         $full->place($watermark1, 'bottom');
    //         $full->save(public_path('uploads/news_photos/' . $new_name), quality: 70);

    //         // 🔁 Re-upload thumbnail
    //         $job = new ProcessImageUpload(
    //             $originalFile,
    //             'uploads/news_thumbs/',
    //             650,
    //             365,
    //             50,
    //             'uploads/water_mark/water_mark_t.png'
    //         );

    //         $news->fill($request->only([
    //             'title',
    //             'news_source',
    //             'paragraph',
    //             'category_id',
    //             'sub_cate_id',
    //             'image_title',
    //             'url',
    //             'status'
    //         ]))->fill([
    //             'user_id' => Auth::id(),
    //             'news_photo' => $new_name,
    //             'thumbnail' => $job->handle(),
    //             'updated_at' => now()
    //         ])->save();

    //     }



    //     return back()->with('news_update', 'News Updated Successfully');
    // }

    // public function update(Request $request, News $news)
    // {


    //     if ($request->has('status')) {
    //         if ($request->status == '1' || $request->status == '0') {
    //             $news->status = $request->status;
    //             $news->update_by_user = Auth::id(); // Optional
    //             $news->save();

    //             return back()->with('status_update', 'Status updated successfully.');
    //         }
    //     }

    //     $request->validate([
    //         'title' => 'required',
    //         'paragraph' => 'required',
    //         'category_id' => 'required',
    //         'sub_cate_id' => 'required',
    //         'url' => 'required',
    //         'news_source' => 'required',
    //         'image_title' => 'required',
    //         'status' => 'required',
    //         'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
    //     ]);


    //     // ✅ Update other fields
    //     $news->fill($request->only([
    //         'title',
    //         'paragraph',
    //         'category_id',
    //         'sub_cate_id',
    //         'url',
    //         'news_source',
    //         'image_title',
    //         'status',
    //         'update_by_user'
    //     ]));

    //     // ✅ Only update image if a new one is uploaded
    //     if ($request->hasFile('thumbnail')) {
    //         // Delete old image
    //         if ($news->news_photo && file_exists(public_path('uploads/news_photos/' . $news->news_photo))) {
    //             unlink(public_path('uploads/news_photos/' . $news->news_photo));
    //         }
    //         if ($news->thumbnail && file_exists(public_path($news->thumbnail))) {
    //             unlink(public_path($news->thumbnail));
    //         }

    //         // Process full image
    //         $Image = new ImageManager(new Driver());
    //         $originalFile = $request->file('thumbnail');
    //         $new_name = Str::random(5) . time() . '.' . $originalFile->getClientOriginalExtension();

    //         $watermark1 = $Image->read(public_path('uploads/water_mark/water_mark_p.png'));
    //         $fullImage = $Image->read($originalFile)->resize(1280, 720);
    //         $fullImage->place($watermark1, 'bottom');
    //         $fullImage->save(public_path('uploads/news_photos/' . $new_name), quality: 70);

    //         // Thumbnail via job
    //         $job = new ProcessImageUpload(
    //             $originalFile,
    //             'uploads/news_thumbs/',
    //             650,
    //             365,
    //             50,
    //             'uploads/water_mark/water_mark_t.png'
    //         );

    //         $news->news_photo = $new_name;
    //         $news->thumbnail = $job->handle();
    //     }

    //     $news->update_by_user = Auth::id();
    //     $news->save();

    //     return back()->with('news_update', 'News updated successfully.');
    // }

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
            'title' => 'required',
            'paragraph' => 'required',
            'category_id' => 'required',
            'sub_cate_id' => 'required',
            'url' => 'required',
            'news_source' => 'required',
            'image_title' => 'required',
            'status' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
        ]);

        // Fill and update
        $news->fill($request->only([
            'title',
            'paragraph',
            'category_id',
            'sub_cate_id',
            'url',
            'news_source',
            'image_title',
            'status',
        ]));

        if ($request->hasFile('thumbnail')) {
            // Delete old images
            if ($news->news_photo && file_exists(public_path('uploads/news_photos/' . $news->news_photo))) {
                unlink(public_path('uploads/news_photos/' . $news->news_photo));
            }
            if ($news->thumbnail && file_exists(public_path($news->thumbnail))) {
                unlink(public_path($news->thumbnail));
            }

            // Process new image
            $imageManager = new ImageManager(new Driver());
            $originalFile = $request->file('thumbnail');
            $new_name = Str::random(5) . time() . '.' . $originalFile->getClientOriginalExtension();

            $watermark1 = $imageManager->read(public_path('uploads/water_mark/water_mark_p.png'));
            $fullImage = $imageManager->read($originalFile)->resize(1280, 720);
            $fullImage->place($watermark1, 'bottom');
            $fullImage->save(public_path('uploads/news_photos/' . $new_name), quality: 70);

            // Create thumbnail using job
            $job = new ProcessImageUpload(
                $originalFile,
                'uploads/news_thumbs/',
                650,
                365,
                50,
                'uploads/water_mark/water_mark_t.png'
            );

            $news->news_photo = $new_name;
            $news->thumbnail = $job->handle(); // This must return file name
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