<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class TagsController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view tags', only: ['index']),
            new Middleware('permission:edit tags', only: ['edit']),
            new Middleware('permission:create tags', only: ['create']),
            new Middleware('permission:delete tags', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tags::latest()->get();
        return view('layouts.newsDashboard.tags.index', [
            'tags' => $tags,
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
            'tags_en' => 'required|min:3',
            'tags_bn' => 'required|min:3',
        ]);

        $data =
            [
                'tag_en' => $request->tags_en,
                'tag_bn' => $request->tags_bn,
                'created_at' => now(),
                'updated_at' => null,
            ];

        Tags::create($data);

        flash()
            ->addSuccess('Tags Added', [
                'position' => 'bottom-center', // 👈 correct way
            ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = Tags::findOrFail($id);
        return view('layouts.newsDashboard.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tags_en' => 'required|string|max:255',
            'tags_bn' => 'required|string|max:255',
        ]);

        $tag = Tags::findOrFail($id);

        $tag->update([
            'tag_en' => $request->tags_en,
            'tag_bn' => $request->tags_bn,
            'updated_at' => now(),
        ]);

        flash()
            ->addSuccess('Tags Updated', [
                'position' => 'bottom-center', // 👈 correct way
            ]);

        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tags::findOrFail($id);
        $tag->delete();

        flash()
            ->addSuccess('Tags Deleted', [
                'position' => 'bottom-center', // 👈 correct way
            ]);

        return redirect()->route('tags.index');
    }
}