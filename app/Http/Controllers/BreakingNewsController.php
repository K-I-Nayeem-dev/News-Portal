<?php

namespace App\Http\Controllers;

use App\Models\breaking_news;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BreakingNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $breaking_news = DB::table('breaking_news')->latest()->get();

        return view('layouts.newsDashboard.breaking_news.index', [
            'breaking_news' => $breaking_news
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
            'breaking_news' => 'required',
            'status' => 'required'
        ]);

        $data = [
            'news' => $request->breaking_news,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => null,
        ];

        DB::table('breaking_news')->insert($data);

        return back()->with('Bn_added', 'Posted News Online');
    }

    /**
     * Display the specified resource.
     */
    public function show(breaking_news $breaking_news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(breaking_news $breakingnews)
    {
        return view('layouts.newsDashboard.breaking_news.edit', ['breaking' => $breakingnews]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, breaking_news $breakingnews)
    {
        $request->validate([
            'breaking_news' => 'required',
            'status' => 'required'
        ]);

        $breakingnews->news = $request->input('breaking_news');
        $breakingnews->status = $request->input('status');
        $breakingnews->updated_at = now();
        $breakingnews->save();

        return redirect()->route('breakingnews.index')->with('news_update','Breaking News updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(breaking_news $breakingnews)
    {
        $breakingnews->delete();

        return back()->with('news_deleted', 'Breaking News Delete Successfully ');
    }
}