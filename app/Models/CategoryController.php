<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return request()->expectsJson()
            ? response()->json(['categories' => Category::all()])
            : view('categories.index', ['categories' => Category::all()]);
    }

    public function view(Category $category)
    {
        $products = $category->products()->where('published', 1)->get();

        return view('category.view', [
            'category' => $category,
            'products' => $products,
        ]);
    }
}
