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


// Supplier Routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('suppliers', \App\Http\Controllers\Admin\SupplierController::class);
});

// Purchase Routes
Route::middleware(['auth:sanctum', 'verified'])->prefix('purchases')->name('purchases.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\PurchaseController::class, 'index'])->name('index');
    Route::get('/create', [\App\Http\Controllers\Admin\PurchaseController::class, 'create'])->name('create');
    Route::post('/', [\App\Http\Controllers\Admin\PurchaseController::class, 'store'])->name('store');
    Route::get('/{purchase}', [\App\Http\Controllers\Admin\PurchaseController::class, 'show'])->name('show');
    Route::delete('/{purchase}', [\App\Http\Controllers\Admin\PurchaseController::class, 'destroy'])->name('destroy');
});

// Report Routes
Route::middleware(['auth:sanctum', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
});

// User Management Routes (Admin Only)
Route::middleware(['auth:sanctum', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
});

// Inventory Routes
Route::middleware(['auth:sanctum', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/inventory', [\App\Http\Controllers\Admin\InventoryController::class, 'index'])->name('inventory.index');
    Route::get('/inventory/stock-in', [\App\Http\Controllers\Admin\InventoryController::class, 'stockIn'])->name('inventory.stock-in');
    Route::post('/inventory/stock-in', [\App\Http\Controllers\Admin\InventoryController::class, 'stockInStore'])->name('inventory.stock-in-store');
    Route::get('/inventory/stock-out', [\App\Http\Controllers\Admin\InventoryController::class, 'stockOut'])->name('inventory.stock-out');
    Route::post('/inventory/stock-out', [\App\Http\Controllers\Admin\InventoryController::class, 'stockOutStore'])->name('inventory.stock-out-store');
    Route::get('/inventory/history', [\App\Http\Controllers\Admin\InventoryController::class, 'history'])->name('inventory.history');
});

Route::get('/inventory/report', [\App\Http\Controllers\Admin\InventoryController::class, 'report'])->name('inventory.report');

Route::middleware(['auth:sanctum', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});

// Sales Return Routes
Route::middleware(['auth:sanctum', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/sales/returns', [\App\Http\Controllers\Admin\SaleReturnController::class, 'index'])->name('sales.returns.index');
    Route::get('/sales/returns/create', [\App\Http\Controllers\Admin\SaleReturnController::class, 'create'])->name('sales.returns.create');
    Route::post('/sales/returns/find', [\App\Http\Controllers\Admin\SaleReturnController::class, 'findSale'])->name('sales.returns.find');
    Route::post('/sales/returns', [\App\Http\Controllers\Admin\SaleReturnController::class, 'store'])->name('sales.returns.store');
    Route::get('/sales/returns/{saleReturn}', [\App\Http\Controllers\Admin\SaleReturnController::class, 'show'])->name('sales.returns.show');
});

// Print Invoice Route
Route::get('/pos/invoice/{id}/print', [\App\Http\Controllers\Admin\PosController::class, 'printInvoice'])->name('pos.print');