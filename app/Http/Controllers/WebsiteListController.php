<?php

namespace App\Http\Controllers;

use App\Models\WebsiteList;
use Illuminate\Http\Request;

class WebsiteListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $websites = WebsiteList::orderBy('name', 'ASC')->get();
        return view('layouts.newsDashboard.setting.websitelist.index',[
            'websites' => $websites
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
            'name' => 'required',
            'url' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'url' => $request->url,
            'created_at' => now(),
            'updated_at' => null,
        ];

        WebsiteList::insert($data);

        return back()->with('website_add', 'Website Link Added');

    }

    /**
     * Display the specified resource.
     */
    public function show(WebsiteList $websiteList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $website = WebsiteList::findOrFail($id);
        return view('layouts.newsDashboard.setting.websitelist.edit', [
            'website' => $website
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'name' => $request->name,
            'url' => $request->url,
            'updated_at' => now(),
        ];

        WebsiteList::findOrfail($id)->update($data);

        return back()->with('website_update', 'Website Link Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        WebsiteList::find($id)->delete();
        return back()->with('website_delete', "Website Link Delete Successfully");
    }
}