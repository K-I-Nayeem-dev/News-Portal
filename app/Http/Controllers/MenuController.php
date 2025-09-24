<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Category::with('subCategories')
            ->orderBy('order')
            ->get();

        return view('layouts.newsDashboard.menuBuilder.index', compact('categories'));
    }

    public function updateCategoryOrder(Request $request)
    {
        $request->validate([
            'categories' => 'required|array',
            'categories.*.id' => 'required|integer',
            'categories.*.order' => 'required|integer'
        ]);

        foreach ($request->categories as $category) {
            Category::updateOrder($category['id'], $category['order']);
        }

        return response()->json(['success' => true, 'message' => 'Category order updated successfully']);
    }

    public function updateSubCategoryOrder(Request $request)
    {
        $request->validate([
            'subcategories' => 'required|array',
            'subcategories.*.id' => 'required|integer',
            'subcategories.*.order' => 'required|integer',
            'subcategories.*.category_id' => 'required|integer'
        ]);

        foreach ($request->subcategories as $subCategory) {
            SubCategory::updateOrder(
                $subCategory['id'],
                $subCategory['order'],
                $subCategory['category_id']
            );
        }

        return response()->json(['success' => true, 'message' => 'Subcategory order updated successfully']);
    }

    public function reorderAll(Request $request)
    {
        $request->validate([
            'data' => 'required|array'
        ]);

        foreach ($request->data as $categoryData) {
            Category::updateOrder($categoryData['id'], $categoryData['order']);

            if (isset($categoryData['subcategories'])) {
                foreach ($categoryData['subcategories'] as $subCategoryData) {
                    SubCategory::updateOrder(
                        $subCategoryData['id'],
                        $subCategoryData['order'],
                        $categoryData['id']
                    );
                }
            }
        }

        return response()->json(['success' => true, 'message' => 'Menu order updated successfully']);
    }
}
