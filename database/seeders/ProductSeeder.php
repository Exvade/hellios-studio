<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::query()->get()->keyBy('slug');

        collect([
            ['name' => 'MESH 01 — POLISHED', 'slug' => 'mesh-01-polished', 'category' => 'mesh', 'series' => 'HELIIOS Select', 'description' => 'An airy, twelve-window mesh with a bright machined face and a fine stepped lip. Built to sharpen classic sedans and tuned coupes.', 'is_featured' => true],
            ['name' => 'MESH 02 — GUNMETAL', 'slug' => 'mesh-02-gunmetal', 'category' => 'mesh', 'series' => 'HELIIOS Select', 'description' => 'Tight latticework, smoked center and a purposeful silhouette for the cars that live low.', 'is_featured' => false],
            ['name' => 'DISH 01 — CHROME', 'slug' => 'dish-01-chrome', 'category' => 'deep-dish', 'series' => 'HELIIOS Street', 'description' => 'Wide-lip five-spoke energy, scaled down without losing the drama of a proper street build.', 'is_featured' => true],
            ['name' => 'DISH 02 — BRONZE', 'slug' => 'dish-02-bronze', 'category' => 'deep-dish', 'series' => 'HELIIOS Street', 'description' => 'A warm bronze finish and deep-set center for compact legends and weekend parking-lot heroes.', 'is_featured' => false],
            ['name' => 'RALLY 01 — WHITE', 'slug' => 'rally-01-white', 'category' => 'motorsport', 'series' => 'HELIIOS Race', 'description' => 'Eight crisp windows, a chunky hub and a clean white finish that channels old-school competition cars.', 'is_featured' => false],
            ['name' => 'TRACK 01 — SILVER', 'slug' => 'track-01-silver', 'category' => 'motorsport', 'series' => 'HELIIOS Race', 'description' => 'Lean five-spoke geometry for time-attack silhouettes, modern castings and fast-looking displays.', 'is_featured' => true],
        ])->each(function (array $product) use ($categories): void {
            Product::query()->updateOrCreate(
                ['slug' => $product['slug']],
                [
                    'category_id' => $categories[$product['category']]->id,
                    'name' => $product['name'],
                    'series' => $product['series'],
                    'description' => $product['description'],
                    'is_featured' => $product['is_featured'],
                    'is_available' => true,
                ],
            );
        });
    }
}
