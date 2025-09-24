<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CategoryController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view categories', only: ['index']),
            new Middleware('permission:edit categories', only: ['edit']),
            new Middleware('permission:create categories', only: ['create']),
            new Middleware('permission:delete categories', only: ['destroy']),
        ];
    }

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
            'slug' => Str::slug($request->category_en),
            'status' => $request->status,
            'order' => DB::table('categories')->max('order') + 1, // set next order
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
            'category_en' => 'required|unique:categories,category_en,' . $category->id,
            'category_bn' => 'required|unique:categories,category_bn,' . $category->id,
            'status' => 'required'
        ]);

        $category->category_en = $request->category_en;
        $category->category_bn = $request->category_bn;
        $category->slug = Str::slug($request->category_en);
        $category->status = $request->status;

        // Dynamic order: if you want to update order automatically, you can calculate the next max order
        if (!$category->order) { // if order is null, assign next
            $maxOrder = DB::table('categories')->max('order');
            $category->order = $maxOrder + 1;
        }

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
    public function getSubcate($id)
    {

        $getSubCate = SubCategory::where('category_id', $id)->get();

        return response()->json($getSubCate);
    }
}
