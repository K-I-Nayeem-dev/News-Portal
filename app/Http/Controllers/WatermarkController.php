<?php

namespace App\Http\Controllers;

use App\Models\watermark;
use Illuminate\Http\Request;
use App\Jobs\ProcessImageUpload;
use Illuminate\Support\Facades\DB;

class WatermarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $watermarks = watermark::orderBy('watermark', 'ASC')->get();
        return view('layouts.newsDashboard.watermark.index', [
            'watermarks' => $watermarks,
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
            'watermark' => 'required',
            'status' => 'required'
        ]);

        $data = [
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => null
        ];

        // Get the latest watermark entry (assuming only one watermark exists)
        $existing = DB::table('watermarks')->latest()->first();


        if ($request->hasFile('watermark')) {

            // // If old watermark exists, delete old file
            // if ($existing && $existing->watermark && file_exists(public_path($existing->watermark))) {
            //     unlink(public_path($existing->watermark));
            // }

            // Process new image
            $job = new ProcessImageUpload(
                $request->file('watermark'),
                'uploads/water_mark/',
                1280,
                40,
                90,
            );


            $data['watermark'] = $job->handle();
            DB::table('watermarks')->insert($data);

            // if ($existing) {
            //     // Update existing watermark record
            //     $data['updated_at'] = now();
            //     DB::table('watermarks')->where('id', $existing->id)->update($data);
            // } else {
            //     // Insert new watermark record
            // DB::table('watermarks')->insert($data);
            // }

        }


        return back()->with('add_watermart', 'Watermart Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(watermark $watermark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(watermark $watermark) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, watermark $watermark)
    {
        $id = watermark::where('id', $watermark->id)->first();

        if ($request->status == 1) {
            watermark::query()->update(['status' => 0]);
            watermark::where('id', $id->id)->update(['status' => 1]);
            return back();
        } else {
            return back();
        }


        // watermark::where('id');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(watermark $watermark)
    {

        $existing = watermark::where('id', $watermark->id)->first();

        // If old watermark exists, delete old file
        if ($existing && $existing->watermark && file_exists(public_path($existing->watermark))) {
            unlink(public_path($existing->watermark));
        }
        $watermark->delete();

        return back()->with('watermarkdelete', 'Watermart Delete');
    }
}
