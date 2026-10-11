<?php

namespace App\Http\Controllers\Studio;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class StudioDashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('studio.dashboard', [
            'categoryCount' => Category::query()->count(),
            'featuredCount' => Product::query()->where('is_featured', true)->count(),
            'latestProducts' => Product::query()
                ->with('category')
                ->latest()
                ->limit(4)
                ->get(),
            'productCount' => Product::query()->count(),
            'visibleCount' => Product::query()->available()->count(),
        ]);
    }
}
