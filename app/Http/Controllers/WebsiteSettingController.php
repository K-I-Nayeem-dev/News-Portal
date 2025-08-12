<?php

namespace App\Http\Controllers;

use App\Models\Website_Setting;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class WebsiteSettingController extends Controller implements HasMiddleware
{


    public static function middleware(): array
    {
        return [
            new Middleware('permission:view website setting', only: ['index']),
            new Middleware('permission:edit website setting', only: ['edit']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $web_settings = Website_Setting::latest()->first();
        return view('layouts.newsDashboard.website_setting.index', [
            'web_settings' => $web_settings
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Website_Setting $website_Setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Website_Setting $website_Setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = [
            'about_us' => $request->about_us,
            'address' => $request->address,
            'editor_details' => $request->editor_details,
            'advertise_link' => $request->advertise_link
        ];

        $logo = Website_Setting::findOrFail($id);

        if ($request->hasFile('logo')) {

            $imageManager = new ImageManager(new Driver());

            // Delete old image if exists
            if (!empty($logo->logo) && file_exists(public_path(ltrim($logo->logo, '/')))) {
                unlink(public_path(ltrim($logo->logo, '/')));
            }

            // Generate new file name
            $news_name = uniqid() . '_' . time() . '.' . $request->logo->getClientOriginalExtension();

            // Resize and save
            $fullImage = $imageManager->read($request->logo)->resize(230, 50);
            $fullImage->save(public_path('uploads/logo/' . $news_name), quality: 70);

            // Set path for DB
            $data['logo'] = 'uploads/logo/' . $news_name;
        }

        $logo->update($data);

        return back()->with('website_setting_update', 'Website Setting Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Website_Setting $website_Setting)
    {
        //
    }
}
