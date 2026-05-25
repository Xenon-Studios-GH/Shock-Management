<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StockTransaction;
use App\Models\Product;
use Illuminate\Http\Request;

class StockActivityController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = StockTransaction::with('product', 'user')
            ->where('created_at', '>=', now()->subDays(90));

        if ($request->filled('type') && in_array($request->type, ['in', 'out'])) {
            $query->where('type', $request->type);
        }

        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $transactions = $query->latest()->paginate(20);

        $products = Product::orderBy('product_name')->get(['id', 'product_code', 'product_name']);
        $stockInCount = StockTransaction::where('type', 'in')->count();
        $stockOutCount = StockTransaction::where('type', 'out')->count();
        $todayCount = StockTransaction::whereDate('created_at', today())->count();

        return view('stock-activity.index', compact(
            'transactions',
            'products',
            'stockInCount',
            'stockOutCount',
            'todayCount'
        ));
    }
}
