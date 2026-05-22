<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class StockSearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->get('q');

        $products = Product::where('product_code', 'like', "%{$query}%")
            ->orWhere('product_name', 'like', "%{$query}%")
            ->orWhereHas('stocks', function ($q) use ($query) {
                $q->where('size', 'like', "%{$query}%");
            })
            ->with('stocks')
            ->paginate(20);

        $html = view('stock-management._table', compact('products'))->render();

        return response()->json(['html' => $html]);
    }
}
