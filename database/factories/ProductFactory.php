<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    private static int $codeCounter = 0;

    public function definition(): array
    {
        static::$codeCounter++;
        return [
            'product_code' => 'Dribbling-' . str_pad(static::$codeCounter, 4, '0', STR_PAD_LEFT),
            'product_name' => fake()->words(2, true) . ' ' . fake()->randomElement(['T-Shirt', 'Hoodie', 'Jacket', 'Cap']),
            'price' => fake()->randomFloat(2, 10, 200),
        ];
    }
}
