<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WorkLog;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $totalWorkers = User::where('role', 'staff')->count();
        $recentLogs = WorkLog::with('user')->latest()->take(5)->get();

        return view('dashboard.index', compact('totalWorkers', 'recentLogs'));
    }
}
