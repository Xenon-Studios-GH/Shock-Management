<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\StockService;
use App\Services\WorkLogService;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    protected StockService $stockService;
    protected WorkLogService $workLogService;

    public function __construct(StockService $stockService, WorkLogService $workLogService)
    {
        $this->stockService = $stockService;
        $this->workLogService = $workLogService;
    }

    public function index()
    {
        $products = Product::orderBy('product_name')->get(['id', 'product_code', 'product_name']);
        return view('stockin.index', compact('products'));
    }

    public function preview(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required'],
            'size' => ['required', 'in:S,M,L,XL,XXL'],
            'quantity' => ['required', 'integer', 'min:1'],
            'product_name' => ['nullable', 'string', 'max:255'],
            'price' => ['nullable', 'numeric', 'min:0'],
        ]);

        $product = null;

        if ($validated['product_id'] === 'new' && !empty($validated['product_name'])) {
            $count = Product::count();
            $product = Product::create([
                'product_code' => 'Dribbling-' . str_pad($count + 1, 4, '0', STR_PAD_LEFT),
                'product_name' => $validated['product_name'],
                'price' => $validated['price'] ?? 0,
            ]);

            $this->workLogService->log(
                'Product Created',
                'stock',
                $product->id,
                "Product {$product->product_name} ({$product->product_code}) was created"
            );
        } else {
            $product = Product::findOrFail($validated['product_id']);
        }

        try {
            $preview = $this->stockService->previewIn($product, $validated['size'], $validated['quantity']);

            return response()->json([
                'product_id' => $product->id,
                'product_name' => $product->product_name,
                'product_code' => $product->product_code,
                'size' => $preview['size'],
                'current_stock' => $preview['current_stock'],
                'change' => $preview['change'],
                'new_stock' => $preview['new_stock'],
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }

    public function confirm(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'size' => ['required', 'in:S,M,L,XL,XXL'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $product = Product::findOrFail($validated['product_id']);

        try {
            $this->stockService->stockIn($product, $validated['size'], $validated['quantity']);
            return response()->json(['success' => true, 'message' => 'Stock added successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }
}
