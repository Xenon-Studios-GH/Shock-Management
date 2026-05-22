<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class StockManagementController extends Controller
{
    public function __invoke()
    {
        return view('stock-management.index');
    }
}
