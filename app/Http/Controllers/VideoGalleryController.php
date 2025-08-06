<?php

namespace App\Http\Controllers;

use App\Models\VideoGallery;
use Illuminate\Http\Request;

class VideoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = VideoGallery::latest()->paginate(20);
        return view('layouts.newsDashboard.gallery.videos_gallery.index', [
            'videos' => $videos
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
            'embed_code' => 'required',
            'type' => 'required',
        ]);

        $data = [
            'title_en' => $request->title_en,
            'title_bn' => $request->title_bn,
            'type' => $request->type,
            'embed_code' => $request->embed_code,
            'created_at' => now(),
            'updated_at' => null
        ];


        VideoGallery::create($data);

        return back()->with('video_uploaded', 'Video Uploaded Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(VideoGallery $videoGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $video = VideoGallery::findOrFail($id);
        return view('layouts.newsDashboard.gallery.videos_gallery.edit', [
            'video' => $video
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $data = [
            'title_en' => $request->title_en,
            'title_bn' => $request->title_bn,
            'type' => $request->type,
            'embed_code' => $request->embed_code,
            'updated_at' => now()
        ];


        VideoGallery::findOrFail($id)->update($data);

        return back()->with('video_update', 'Video Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        VideoGallery::findOrFail($id)->delete();

        return back()->with('video_delete', 'Video Delete');

    }
}