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
        $videos = VideoGallery::orderBy('title', "ASC")->paginate(20);
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
            'title' => 'required|min:3',
            'embed_code' => 'required',
            'type' => 'required',
        ]);

        $data = [
            'title' => $request->title,
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
    public function edit(VideoGallery $videoGallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VideoGallery $videoGallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VideoGallery $videoGallery)
    {
        //
    }
}
