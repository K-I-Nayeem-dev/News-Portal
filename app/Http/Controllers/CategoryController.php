<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = DB::table('categories')->latest()->get();

        return view('layouts.newsDashboard.category.index', [
            'categories' => $categories
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
            'category_name' => 'required',
            'status' => 'required'
        ]);

        $data = [
            'category_name' => $request->category_name,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => null,
        ];

        DB::table('categories')->insert($data);

        return back()->with('cate_create', 'Category Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('layouts.newsDashboard.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name,'. $category->id,
            'status' => 'required'
        ]);

        $category->category_name = $request->input('category_name');
        $category->status = $request->input('status');
        $category->updated_at = now();
        $category->save();

        return redirect()->route('categories.index')->with('cate_update', $category->category_name . ' ' . 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('cate_delete', $category->category_name . ' ' . 'Category Delete Successfully ');
    }
}
