<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class StockFilterController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = Product::with('stocks');

        if ($request->filled('size')) {
            $query->whereHas('stocks', function ($q) use ($request) {
                $q->where('size', $request->size);
            });
        }

        if ($request->filled('stock_min')) {
            $query->whereHas('stocks', function ($q) use ($request) {
                $q->where('quantity', '>=', $request->stock_min);
            });
        }

        if ($request->filled('stock_max')) {
            $query->whereHas('stocks', function ($q) use ($request) {
                $q->where('quantity', '<=', $request->stock_max);
            });
        }

        $sort = $request->get('sort', 'newest');
        $query = match ($sort) {
            'oldest' => $query->oldest(),
            'stock_high' => $query->withMax('stocks', 'quantity')->orderBy('stocks_max_quantity', 'desc'),
            'stock_low' => $query->withMax('stocks', 'quantity')->orderBy('stocks_max_quantity', 'asc'),
            default => $query->latest(),
        };

        $products = $query->paginate(20);
        $html = view('stock-management._table', compact('products'))->render();

        return response()->json(['html' => $html]);
    }
}
