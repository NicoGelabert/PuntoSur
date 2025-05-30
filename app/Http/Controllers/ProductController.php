<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    public function index()
    {
        $query = Product::query();

        return $this->renderProducts($query);
    }

    private function renderProducts(Builder $query)
    {
        $search = \request()->get('search');
        $sort = \request()->get('sort', '-updated_at');

        if ($sort) {
            $sortDirection = 'asc';
            if ($sort[0] === '-') {
                $sortDirection = 'desc';
            }
            $sortField = preg_replace('/^-?/', '', $sort);

            $query->orderBy($sortField, $sortDirection);
        }
        $products = $query
            ->where('published', '=', 1)
            ->where(function ($query) use ($search) {
                /** @var $query \Illuminate\Database\Eloquent\Builder */
                $query->where('products.title', 'like', "%$search%")
                    ->orWhere('products.description', 'like', "%$search%");
            })

            ->paginate(5);

        return view('product.index', [
            'products' => $products
        ]);

    }

    public function view($categorySlug, $productSlug)
    {
        // Obtener la categoría usando el slug
        $category = Category::where('slug', $categorySlug)->firstOrFail();

        // Obtener el producto usando el slug
        $product = Product::where('slug', $productSlug)->firstOrFail();
        
        // Cargar el producto con sus relaciones
        $product->load(['categories', 'images', 'prices', 'alergens', 'tags']);

        // --- Lógica para la cookie ---
        $viewedProducts = json_decode(Cookie::get('recently_viewed'), true) ?? [];

        // Remover el producto si ya está en la lista (para evitar duplicados)
        $viewedProducts = array_filter($viewedProducts, fn($id) => $id != $product->id);

        // Agregar el producto actual al inicio
        array_unshift($viewedProducts, $product->id);

        // Limitar a los últimos 5 productos
        $viewedProducts = array_slice($viewedProducts, 0, 5);

        // Guardar la cookie (duración: 7 días)
        Cookie::queue('recently_viewed', json_encode($viewedProducts), 60 * 24 * 7);

        // Retornar la vista con la información necesaria
        return view('product.view', [
            'product' => $product,
            'category' => $category,
        ]);
    }
}
