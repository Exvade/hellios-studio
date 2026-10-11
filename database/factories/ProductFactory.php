<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->bothify('HSW-### ??');

        return [
            'category_id' => Category::factory(),
            'name' => $name,
            'slug' => str($name)->slug()->toString(),
            'series' => fake()->randomElement(['Street Series', 'Heritage Series', 'Track Series']),
            'description' => fake()->paragraph(),
            'is_featured' => false,
            'is_available' => true,
        ];
    }
}
