<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(Request $request): View
    {
        $selectedCategory = null;

        if ($request->filled('category')) {
            $selectedCategory = Category::query()
                ->where('slug', $request->string('category')->toString())
                ->firstOrFail();
        }

        $products = Product::query()
            ->with('category')
            ->available()
            ->when(
                $selectedCategory,
                fn ($query) => $query->whereBelongsTo($selectedCategory),
            )
            ->latest()
            ->get();

        return view('catalog.index', [
            'categories' => Category::query()->withCount('products')->orderBy('name')->get(),
            'products' => $products,
            'selectedCategory' => $selectedCategory,
        ]);
    }

    public function show(Product $product): View
    {
        abort_unless($product->is_available, 404);

        return view('catalog.show', [
            'product' => $product->load('category'),
            'relatedProducts' => Product::query()
                ->with('category')
                ->available()
                ->whereBelongsTo($product->category)
                ->whereKeyNot($product->getKey())
                ->latest()
                ->take(3)
                ->get(),
        ]);
    }
}
