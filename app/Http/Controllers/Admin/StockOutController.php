<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class StockOutController extends Controller
{
    public function __invoke()
    {
        return view('stockout.index');
    }
}
