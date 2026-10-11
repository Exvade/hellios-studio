<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Distributor;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): View
    {
        return view('welcome', [
            'selectedProducts' => Product::query()
                ->with('category')
                ->available()
                ->orderByDesc('is_featured')
                ->latest('id')
                ->limit(3)
                ->get(),
            'categories' => Category::query()->orderBy('name')->get(),
            'distributors' => Distributor::query()->orderBy('name')->get(),
        ]);
    }
}
