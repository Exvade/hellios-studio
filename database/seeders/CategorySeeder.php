<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            ['name' => 'Mesh', 'slug' => 'mesh', 'description' => 'Detailed multi-spoke designs for a period-correct stance.', 'accent' => 'pink'],
            ['name' => 'Deep Dish', 'slug' => 'deep-dish', 'description' => 'Bold lips, low offsets, and maximum street presence.', 'accent' => 'yellow'],
            ['name' => 'Motorsport', 'slug' => 'motorsport', 'description' => 'Track-bred forms adapted for the 1:64 scale garage.', 'accent' => 'charcoal'],
        ])->each(fn (array $category): Category => Category::query()->updateOrCreate(['slug' => $category['slug']], $category));
    }
}
