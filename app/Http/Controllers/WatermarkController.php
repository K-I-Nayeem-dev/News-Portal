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
        $watermarks = watermark::all();
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

            // If old watermark exists, delete old file
            if ($existing && $existing->watermark && file_exists(public_path($existing->watermark))) {
                unlink(public_path($existing->watermark));
            }

            // Process new image
            $job = new ProcessImageUpload(
                $request->file('watermark'),
                'uploads/water_mark/',
                120,
                120,
                70,
            );

            $data['watermark'] = $job->handle();

            if ($existing) {
                // Update existing watermark record
                $data['updated_at'] = now();
                DB::table('watermarks')->where('id', $existing->id)->update($data);
            } else {
                // Insert new watermark record
                DB::table('watermarks')->insert($data);
            }

        }
        

        return 'ok';
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
    public function edit(watermark $watermark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, watermark $watermark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(watermark $watermark)
    {
        //
    }
}
