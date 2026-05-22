<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockTransactionFactory extends Factory
{
    protected $model = StockTransaction::class;

    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 50);
        return [
            'product_id' => Product::factory(),
            'user_id' => User::factory(),
            'type' => fake()->randomElement(['in', 'out']),
            'size' => fake()->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
            'quantity' => $quantity,
            'stock_before' => fake()->numberBetween(0, 100),
            'stock_after' => function (array $attrs) use ($quantity) {
                return $attrs['type'] === 'in'
                    ? $attrs['stock_before'] + $quantity
                    : $attrs['stock_before'] - $quantity;
            },
        ];
    }
}
