<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessImageUpload;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;
use App\Models\PhotoGallery;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PhotoGalleryController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view gallery', only: ['index']),
            new Middleware('permission:edit gallery', only: ['edit']),
            new Middleware('permission:create gallery', only: ['create']),
            new Middleware('permission:delete gallery', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = PhotoGallery::latest()->paginate(30);
        return view('layouts.newsDashboard.gallery.photos_gallery.index', [
            'photos' => $photos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|min:3',
            'title_bn' => 'required|min:3',
            'type' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:1024',
        ]);

        $data = [
            'title_en' => $request->title_en,
            'title_bn' => $request->title_bn,
            'type' => $request->type,
            'created_at' => now(),
            'updated_at' => null
        ];


        if ($request->hasFile('image')) {

            $imageManager = new ImageManager(new Driver());

            // Save $path to DB or whatever you need
            $news_name =  uniqid() . '_' . time() . '.' . $request->image->getClientOriginalExtension();
            $fullImage = $imageManager->read($request->image)->resize(500, 310);
            $fullImage->save(public_path('uploads/photo_gallery/' . $news_name), quality: 70);

            $data['image'] = 'uploads/photo_gallery/' . $news_name;
        }

        PhotoGallery::create($data);

        return back()->with('photo_uploaded', 'Photo Uploaded Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(PhotoGallery $photoGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $photo = PhotoGallery::findOrFail($id);
        return view('layouts.newsDashboard.gallery.photos_gallery.edit', [
            'photo' => $photo
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $photo = PhotoGallery::findOrFail($id);

        $data = [
            'title_en' => $request->title_en,
            'title_bn' => $request->title_bn,
            'type' => $request->type,
            'updated_at' => now()
        ];

        if ($request->hasFile('image')) {

            $imageManager = new ImageManager(new Driver());

            // Delete old image if exists
            if (!empty($photo->image) && file_exists(public_path($photo->image))) {
                unlink(public_path($photo->image));
            }

            // Generate new file name
            $news_name = uniqid() . '_' . time() . '.' . $request->image->getClientOriginalExtension();

            // Resize and save
            $fullImage = $imageManager->read($request->image)->resize(500, 310);
            $fullImage->save(public_path('uploads/photo_gallery/' . $news_name), quality: 70);

            // Set path for DB
            $data['image'] = 'uploads/photo_gallery/' . $news_name;
        }

        $photo->update($data);

        return back()->with('photo_updated', 'Photo Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $photo = PhotoGallery::findOrFail($id);

        // Delete old image if exists
        if (!empty($photo->image) && file_exists(public_path($photo->image))) {
            unlink(public_path($photo->image));
        }

        // Delete record from DB
        $photo->delete();

        return back()->with('photo_delete', 'Photo Deleted');
    }
}
