<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        return request()->expectsJson()
            ? response()->json(['categories' => Categories::all()])
            : view('categories.index', ['categories' => Categories::all()]);
    }


    public function view(Categories $categories)
    {
        return view('categories.view', ['categories' => $categories]);
    }

}
