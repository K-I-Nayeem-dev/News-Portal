<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
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
            'category_en' => 'required|unique:categories,category_en',
            'category_bn' => 'required|unique:categories,category_bn',
            'status' => 'required'
        ]);

        $data = [
            'category_en' => $request->category_en,
            'category_bn' => $request->category_bn,
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
            'category_en' => 'required|unique:categories,category_en,'. $category->id,
            'category_bn' => 'required|unique:categories,category_bn,'. $category->id,
            'status' => 'required'
        ]);

        $category->category_en = $request->input('category_en');
        $category->category_bn = $request->input('category_bn');
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

    // For Dynamic live Drop down
    public function getSubcate($id){

        $getSubCate = SubCategory::where('category_id', $id)->get();

        return response()->json($getSubCate);

    }


}