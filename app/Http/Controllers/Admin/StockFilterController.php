<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockFilterController extends Controller
{
    public function __invoke(Request $request)
    {
        $subQuery = '(SELECT COALESCE(SUM(quantity), 0) FROM stocks WHERE product_id = products.id)';

        $query = Product::select('products.*')
            ->selectRaw("{$subQuery} as total_stock")
            ->with('stocks');

        if ($request->filled('stock_min')) {
            $query->whereRaw("{$subQuery} >= ?", [(int) $request->stock_min]);
        }
        if ($request->filled('stock_max')) {
            $query->whereRaw("{$subQuery} <= ?", [(int) $request->stock_max]);
        }

        $sort = $request->get('sort', 'newest');
        $query = match ($sort) {
            'oldest' => $query->oldest('updated_at'),
            'stock_high' => $query->orderByDesc(DB::raw($subQuery)),
            'stock_low' => $query->orderBy(DB::raw($subQuery)),
            default => $query->latest('updated_at'),
        };

        $products = $query->paginate(20);
        $html = view('stock-management._table', compact('products'))->render();

        return response()->json(['html' => $html]);
    }
}
