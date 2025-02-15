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
        return view('category.view', ['category' => $category]);
    }
}
