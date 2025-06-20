<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = DB::table('categories')->where('status', 1)->get();
        $sub_category = SubCategory::latest()->get();
        return view('layouts.newsDashboard.scategories.index', [
            'categories' => $categories,
            'sub_cates' => $sub_category
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
            'category_id' => 'required',
            'sub_cate_name' => 'required|unique:sub_categories,sub_cate_name,',
            'status' => 'required'
        ]);

        $data = [
            'category_id' => $request->category_id,
            'sub_cate_name' => $request->sub_cate_name,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => null,
        ];

        DB::table('sub_categories')->insert($data);

        return back()->with('sub_cate_create', 'SubCategory Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {

        $categories = Category::all();

        return view('layouts.newsDashboard.scategories.edit', [
            'sub_cate' => $subCategory,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'sub_cate_name' => 'required',
            'category_id' => 'required',
            'status' => 'required'
        ]);

        $subCategory->sub_cate_name = $request->input('sub_cate_name');
        $subCategory->category_id = $request->input('category_id');
        $subCategory->status = $request->input('status');
        $subCategory->updated_at = now();
        $subCategory->save();

        return redirect()->route('sub_categories.index')->with('sub_cate_update', $subCategory->sub_cate_name . ' ' . 'Sub Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();

        return back()->with('sub_cate_delete', $subCategory->sub_cate_name . ' ' . 'Sub Category Delete Successfully ');
    }
}