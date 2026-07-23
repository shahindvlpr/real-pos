<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Admin Routes
Route::middleware(['auth:sanctum', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Category Routes (Outside admin prefix to keep URLs clean)
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('categories', CategoryController::class);
    
    // Additional category routes
    Route::post('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])
        ->name('categories.toggle-status');
    Route::get('get-subcategories', [CategoryController::class, 'getSubcategories'])
        ->name('categories.subcategories');
});