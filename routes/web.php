<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;

// Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Redirect /dashboard to admin dashboard
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');
});

// =============================================
// All Authenticated Users (Dashboard + Categories)
// =============================================
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    
    // Admin Dashboard
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    // Categories (All users can manage)
    Route::resource('categories', CategoryController::class);
    Route::post('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])
        ->name('categories.toggle-status');
    Route::get('get-subcategories', [CategoryController::class, 'getSubcategories'])
        ->name('categories.subcategories');
});

// =============================================
// Admin Only Routes
// =============================================
Route::middleware(['auth:sanctum', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Future: User Management, Settings, Backup
});

// =============================================
// Admin + Manager Routes
// =============================================
Route::middleware(['auth:sanctum', 'verified', 'role:admin,manager'])->prefix('admin')->name('admin.')->group(function () {
    // Future: Products, Purchases, Reports, Suppliers
});

// =============================================
// Admin + Manager + Cashier Routes (POS)
// =============================================
Route::middleware(['auth:sanctum', 'verified', 'role:admin,manager,cashier'])->prefix('pos')->name('pos.')->group(function () {
    // Future: POS Screen, Sales, Customers
});

// Brand Routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('brands', \App\Http\Controllers\Admin\BrandController::class);
});

// Unit Routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('units', \App\Http\Controllers\Admin\UnitController::class);
});

// Product Routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
});

// POS Routes
Route::middleware(['auth:sanctum', 'verified'])->prefix('pos')->name('pos.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\PosController::class, 'index'])->name('index');
    Route::post('/add-to-cart', [App\Http\Controllers\Admin\PosController::class, 'addToCart'])->name('add-to-cart');
    Route::post('/remove-from-cart', [App\Http\Controllers\Admin\PosController::class, 'removeFromCart'])->name('remove-cart');
    Route::post('/update-cart', [App\Http\Controllers\Admin\PosController::class, 'updateCart'])->name('update-cart');
    Route::post('/checkout', [App\Http\Controllers\Admin\PosController::class, 'checkout'])->name('checkout');
    Route::get('/invoice/{id}', [App\Http\Controllers\Admin\PosController::class, 'invoice'])->name('invoice');
});

// Sales History Routes
Route::middleware(['auth:sanctum', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/sales', [App\Http\Controllers\Admin\SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales/{sale}', [App\Http\Controllers\Admin\SaleController::class, 'show'])->name('sales.show');
});

// Customer Routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('customers', \App\Http\Controllers\Admin\CustomerController::class);
});