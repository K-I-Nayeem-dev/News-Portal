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
            'url' => $request->url,
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
    public function edit(breaking_news $breakingNews)
    {
        return view('layouts.newsDashboard.breaking_news.edit', ['breakings' => $breakingNews]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $breaking = breaking_news::findOrfail($id);

        // ✅ If only 'status' is sent (via dropdown onchange form)
        if ($request->has('status') && count($request->all()) === 3) {
            // 3 fields come from the form: _token, _method, and status
            if ($request->status == '1' || $request->status == '0') {
                $breaking->status = $request->status;
                $breaking->save();

                return back()->with('status_update', 'Status updated successfully.');
            } else {
                return back()->with('error', 'Invalid status value.');
            }
        }

        $request->validate([
            'breaking_news' => 'required',
        ]);

        $breaking->news = $request->breaking_news;
        $breaking->url = $request->url;
        $breaking->save();

        return redirect()->route('breaking_news.index')->with('news_update', 'Breaking News updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        breaking_news::findOrfail($id)->delete();
        return back()->with('news_deleted', 'Breaking News Delete Successfully ');
    }
}
