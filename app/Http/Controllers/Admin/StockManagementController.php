<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class StockManagementController extends Controller
{
    public function __invoke(Request $request)
    {
        $products = Product::with('stocks')->paginate(20);
        $stockIn30d = StockTransaction::where('type', 'in')
            ->where('created_at', '>=', now()->subDays(30))->sum('quantity');
        $stockOut30d = StockTransaction::where('type', 'out')
            ->where('created_at', '>=', now()->subDays(30))->sum('quantity');
        $totalInventory = Stock::sum('quantity');

        return view('stock-management.index', compact(
            'products', 'stockIn30d', 'stockOut30d', 'totalInventory'
        ));
    }
}
