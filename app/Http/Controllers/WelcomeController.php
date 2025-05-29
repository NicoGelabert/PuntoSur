<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\HomeHeroBanner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // $products = Product::all();
        $homeherobanners = HomeHeroBanner::all();
        // Categorías para ProductList.vue
        // Cargar las subcategorías relacionadas
        $categories = Category::where('active', 1)->get();
        $products = Product::whereHas('categories', function ($query) use ($categories) {
            $query->whereIn('categories.id', $categories->pluck('id'));
        })
        ->where('published', 1)
        ->with(['images', 'categories', 'categories.parent', 'prices'])
        ->get()
        ->map(function ($product) {
            $firstImage = $product->images->first();
            $product->image_url = $firstImage ? Storage::url($firstImage->path) : asset('images/placeholder.png');
            return $product;
        });
        // dd($products);
        return view('welcome', compact('homeherobanners', 'categories', 'products'));
    }
}
