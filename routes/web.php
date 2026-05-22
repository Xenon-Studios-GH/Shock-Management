<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StockManagementController;
use App\Http\Controllers\Admin\StockInController;
use App\Http\Controllers\Admin\StockOutController;
use App\Http\Controllers\Admin\WorkerController;
use App\Http\Controllers\Admin\LoginLogController;
use App\Http\Controllers\Admin\WorkLogController;

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->middleware('throttle:5,1');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', LogoutController::class)->name('logout');

    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::middleware('role:superadmin')->group(function () {
        Route::get('workers', [WorkerController::class, 'index'])->name('workers.index');
        Route::get('workers/create', [WorkerController::class, 'create'])->name('workers.create');
        Route::post('workers', [WorkerController::class, 'store'])->name('workers.store');
        Route::get('workers/{worker}/edit', [WorkerController::class, 'edit'])->name('workers.edit');
        Route::put('workers/{worker}', [WorkerController::class, 'update'])->name('workers.update');
        Route::post('workers/{worker}/toggle-status', [WorkerController::class, 'toggleStatus'])->name('workers.toggle-status');

        Route::get('login-logs', [LoginLogController::class, 'index'])->name('login-logs.index');
        Route::get('work-logs', [WorkLogController::class, 'index'])->name('work-logs.index');
    });

    Route::get('stock-management', StockManagementController::class)->name('stock.management');
    Route::get('stockin', StockInController::class)->name('stock.in');
    Route::get('stockout', StockOutController::class)->name('stock.out');

    Route::redirect('/', 'dashboard');
});
