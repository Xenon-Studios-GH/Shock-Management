<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Seeder;

class DemoProductSeeder extends Seeder
{
    private const SIZES = ['S', 'M', 'L', 'XL', 'XXL'];

    public function run(): void
    {
        $products = [
            ['name' => 'Classic Cotton T-Shirt', 'price' => 24.99],
            ['name' => 'Premium Hoodie', 'price' => 59.99],
            ['name' => 'Slim Fit Polo', 'price' => 34.99],
            ['name' => 'Denim Jacket', 'price' => 89.99],
            ['name' => 'Sports Cap', 'price' => 14.99],
            ['name' => 'Casual Chinos', 'price' => 44.99],
            ['name' => 'Graphic Tank Top', 'price' => 19.99],
            ['name' => 'Wool Blend Sweater', 'price' => 49.99],
            ['name' => 'Performance Shorts', 'price' => 29.99],
            ['name' => 'Formal Blazer', 'price' => 129.99],
        ];

        $counter = Product::count();

        foreach ($products as $data) {
            $counter++;
            $product = Product::create([
                'product_code' => 'Dribbling-' . str_pad($counter, 4, '0', STR_PAD_LEFT),
                'product_name' => $data['name'],
                'price' => $data['price'],
            ]);

            foreach (self::SIZES as $size) {
                Stock::create([
                    'product_id' => $product->id,
                    'size' => $size,
                    'quantity' => fake()->numberBetween(0, 80),
                ]);
            }
        }

        $this->command->info('Created ' . count($products) . ' demo products with stock entries.');
    }
}