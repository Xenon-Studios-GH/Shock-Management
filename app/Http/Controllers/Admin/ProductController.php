<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\WorkLogService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected WorkLogService $workLogService;

    public function __construct(WorkLogService $workLogService)
    {
        $this->workLogService = $workLogService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        $validated['product_code'] = Product::generateProductCode();

        $product = Product::create($validated);

        $this->workLogService->log(
            'Product Created',
            'stock',
            $product->id,
            "Product {$product->product_name} ({$product->product_code}) was created"
        );

        return response()->json([
            'id' => $product->id,
            'product_code' => $product->product_code,
            'product_name' => $product->product_name,
            'price' => $product->price,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'product_name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        $product->update($validated);

        $this->workLogService->log(
            'Product Updated',
            'stock',
            $product->id,
            "Product {$product->product_name} was updated"
        );

        return back()->with('success', 'Product updated successfully.');
    }
}
