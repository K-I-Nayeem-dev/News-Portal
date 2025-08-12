<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Routing\Controllers\Middleware;

class AdsController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view ads', only: ['index']),
            new Middleware('permission:edit ads', only: ['edit']),
            new Middleware('permission:create ads', only: ['create']),
            new Middleware('permission:delete ads', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ads = Ads::latest()->paginate(30);
        return view('layouts.newsDashboard.ads.index', [
            'ads' => $ads
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
            'url' => 'required',
            'type' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:1024',
        ]);

        $data = [
            'url' => $request->url,
            'type' => $request->type,
            'created_at' => now(),
            'updated_at' => null
        ];


        if ($request->hasFile('image')) {
            $imageManager = new ImageManager(new Driver());

            // File name
            $news_name = uniqid() . '_' . time() . '.' . $request->image->getClientOriginalExtension();

            // Set dimensions based on type
            if ($request->type == 1) {
                // Square
                $width = 300;
                $height = 250;
            } else {
                // Horizontal
                $width = 728;
                $height = 90;
            }

            // Resize
            $fullImage = $imageManager->read($request->image)->resize($width, $height);

            // Save image
            $fullImage->save(public_path('uploads/ads_photos/' . $news_name), quality: 70);

            $data['image'] = 'uploads/ads_photos/' . $news_name;
        }


        Ads::create($data);

        return back()->with('ads_photo_uploaded', 'Ads Photo Uploaded Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ads $ads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ad = Ads::findOrFail($id);
        return view('layouts.newsDashboard.ads.edit', [
            'ad' => $ad
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'url'   => 'required',
            'type'  => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
        ]);

        $ads = Ads::findOrFail($id);

        $data = [
            'url'        => $request->url,
            'type'       => $request->type,
            'updated_at' => now()
        ];

        $imageManager = new ImageManager(new Driver());

        // Determine dimensions based on type
        if ($request->type == 1) {
            // Square
            $width = 300;
            $height = 250;
        } else {
            // Horizontal
            $width = 728;
            $height = 90;
        }

        if ($request->hasFile('image')) {
            // Delete old image
            if (!empty($ads->image) && file_exists(public_path($ads->image))) {
                unlink(public_path($ads->image));
            }

            // New image name
            $news_name = uniqid() . '_' . time() . '.' . $request->image->getClientOriginalExtension();

            // Resize & save new image
            $fullImage = $imageManager->read($request->image)->resize($width, $height);
            $fullImage->save(public_path('uploads/ads_photos/' . $news_name), quality: 70);

            $data['image'] = 'uploads/ads_photos/' . $news_name;
        } elseif ($ads->type != $request->type && !empty($ads->image) && file_exists(public_path($ads->image))) {
            // Type changed but no new image → reprocess the old image
            $existingImage = $imageManager->read(public_path($ads->image))->resize($width, $height);
            $existingImage->save(public_path($ads->image), quality: 70);
        }

        $ads->update($data);

        return back()->with('ads_updated', 'Ad Updated Successfully');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ad = Ads::findOrFail($id);

        // Delete old image if exists
        if (!empty($ad->image) && file_exists(public_path($ad->image))) {
            unlink(public_path($ad->image));
        }

        // Delete record from DB
        $ad->delete();

        return back()->with('ad_delete', 'Ad Photo Deleted');
    }
}