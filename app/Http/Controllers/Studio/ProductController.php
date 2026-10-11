<?php

namespace App\Http\Controllers\Studio;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('studio.products.index', [
            'products' => Product::query()->with('category')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('studio.products.create', [
            'categories' => Category::query()->orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $attributes = $request->safe()->except('image');
        $attributes['is_featured'] = $request->boolean('is_featured');
        $attributes['is_available'] = $request->boolean('is_available');

        if ($request->hasFile('image')) {
            $attributes['image_path'] = $request->file('image')->store('products', 'public');
        }

        Product::query()->create($attributes);

        return to_route('studio.products.index')->with('status', 'Product added to the catalog.');
    }

    /**
     * Display the specified resource.
     */
    public function edit(Product $product): View
    {
        return view('studio.products.edit', [
            'product' => $product,
            'categories' => Category::query()->orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $attributes = $request->safe()->except('image');
        $attributes['is_featured'] = $request->boolean('is_featured');
        $attributes['is_available'] = $request->boolean('is_available');

        if ($request->hasFile('image')) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }

            $attributes['image_path'] = $request->file('image')->store('products', 'public');
        }

        $product->update($attributes);

        return to_route('studio.products.index')->with('status', 'Product updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        return to_route('studio.products.index')->with('status', 'Product removed from the catalog.');
    }
}
