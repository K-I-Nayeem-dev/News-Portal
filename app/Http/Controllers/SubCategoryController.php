<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            'sub_cate_en' => 'required|unique:sub_categories,sub_cate_en,',
            'sub_cate_bn' => 'required|unique:sub_categories,sub_cate_bn,',
            'status' => 'required'
        ]);

        $data = [
            'category_id' => $request->category_id,
            'sub_cate_en' => $request->sub_cate_en,
            'sub_cate_bn' => $request->sub_cate_bn,
            'slug' => Str::slug($request->sub_cate_en),
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
            'sub_cate_en' => 'required',
            'sub_cate_bn' => 'required',
            'category_id' => 'required',
            'status' => 'required'
        ]);

        $subCategory->sub_cate_en = $request->input('sub_cate_en');
        $subCategory->sub_cate_bn = $request->input('sub_cate_bn');
        $subCategory->category_id = $request->input('category_id');
        $subCategory->slug =  Str::slug($subCategory->sub_cate_en);
        $subCategory->status = $request->input('status');
        $subCategory->updated_at = now();
        $subCategory->save();

        return back()->with('sub_cate_update', $subCategory->sub_cate_name . ' ' . 'Sub Category updated successfully.');
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