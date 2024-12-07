<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getAllCategories()
    {
        // Fetch all categories with nested children
        $categories = Category::whereNull('parent_id') // Top-level categories
            ->with('children') // Load subcategories recursively
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $categories
        ], 200);
    }
}
