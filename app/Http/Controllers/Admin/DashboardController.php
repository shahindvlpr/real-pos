<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Sales Stats
        $todaySales = Sale::whereDate('created_at', today())->sum('total');
        $todayOrders = Sale::whereDate('created_at', today())->count();
        $monthlySales = Sale::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('total');
        $totalSalesAmount = Sale::sum('total');
        
        // Purchase Stats
        $todayPurchases = Purchase::whereDate('created_at', today())->sum('total');
        $monthlyPurchases = Purchase::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('total');
        $totalPurchaseAmount = Purchase::sum('total');
        
        // Counts
        $totalProducts = Product::count();
        $activeProducts = Product::active()->count();
        $totalCategories = Category::count();
        $totalBrands = Brand::count();
        $totalUnits = Unit::count();
        $totalCustomers = Customer::count();
        $totalSuppliers = Supplier::count();
        $totalUsers = User::count();
        
        // Stock
        $lowStockCount = Product::active()->whereColumn('stock_quantity', '<=', 'min_stock_quantity')->where('stock_quantity', '>', 0)->count();
        $outOfStock = Product::where('stock_quantity', 0)->count();
        
        // Recent
        $recentSales = Sale::with('customer')->latest()->take(5)->get();
        $recentPurchases = Purchase::with('supplier')->latest()->take(5)->get();
        
        // Profit
        $profit = $totalSalesAmount - $totalPurchaseAmount;

        return view('admin.dashboard', compact(
            'todaySales', 'todayOrders', 'monthlySales', 'totalSalesAmount',
            'todayPurchases', 'monthlyPurchases', 'totalPurchaseAmount',
            'totalProducts', 'activeProducts',
            'totalCategories', 'totalBrands', 'totalUnits',
            'totalCustomers', 'totalSuppliers', 'totalUsers',
            'lowStockCount', 'outOfStock',
            'recentSales', 'recentPurchases', 'profit'
        ));
    }
}