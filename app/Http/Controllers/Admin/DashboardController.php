<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Customer;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $todaySales = Sale::whereDate('created_at', today())->sum('total');
        $todayOrders = Sale::whereDate('created_at', today())->count();
        $monthlySales = Sale::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('total');
        $totalProducts = Product::count();
        $activeProducts = Product::active()->count();
        $totalCategories = Category::count();
        $totalBrands = Brand::count();
        $totalUnits = Unit::count();
        $totalCustomers = Customer::count();
        $totalUsers = User::count();
        $lowStockCount = Product::active()->whereColumn('stock_quantity', '<=', 'min_stock_quantity')->count();
        $recentSales = Sale::with('customer')->latest()->take(5)->get();
        $totalSalesAmount = Sale::sum('total');

        return view('admin.dashboard', compact(
            'todaySales', 'todayOrders', 'monthlySales',
            'totalProducts', 'activeProducts',
            'totalCategories', 'totalBrands', 'totalUnits',
            'totalCustomers', 'totalUsers',
            'lowStockCount', 'recentSales', 'totalSalesAmount'
        ));
    }
}