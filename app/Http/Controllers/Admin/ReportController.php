<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'today');

        switch ($period) {
            case 'today':
                $start = Carbon::today();
                $end = Carbon::now();
                break;
            case 'yesterday':
                $start = Carbon::yesterday();
                $end = Carbon::yesterday()->endOfDay();
                break;
            case 'this_week':
                $start = Carbon::now()->startOfWeek();
                $end = Carbon::now()->endOfWeek();
                break;
            case 'this_month':
                $start = Carbon::now()->startOfMonth();
                $end = Carbon::now()->endOfMonth();
                break;
            case 'last_month':
                $start = Carbon::now()->subMonth()->startOfMonth();
                $end = Carbon::now()->subMonth()->endOfMonth();
                break;
            case 'this_year':
                $start = Carbon::now()->startOfYear();
                $end = Carbon::now()->endOfYear();
                break;
            default:
                $start = Carbon::today();
                $end = Carbon::now();
        }

        // Sales Stats
        $totalSales = Sale::whereBetween('created_at', [$start, $end])->count();
        $totalSalesAmount = Sale::whereBetween('created_at', [$start, $end])->sum('total');
        $totalSalesPaid = Sale::whereBetween('created_at', [$start, $end])->sum('paid');
        $totalSalesDue = Sale::whereBetween('created_at', [$start, $end])->sum('due');

        // Purchase Stats
        $totalPurchases = Purchase::whereBetween('created_at', [$start, $end])->count();
        $totalPurchaseAmount = Purchase::whereBetween('created_at', [$start, $end])->sum('total');

        // Product Stats
        $totalProducts = Product::count();
        $lowStockProducts = Product::whereColumn('stock_quantity', '<=', 'min_stock_quantity')->count();
        $outOfStockProducts = Product::where('stock_quantity', 0)->count();

        // Customer & Supplier
        $totalCustomers = Customer::count();
        $totalSuppliers = Supplier::count();

        // Top Selling Products (Fixed)
        $topProducts = Product::withCount(['saleItems as total_sold' => function ($q) use ($start, $end) {
            $q->whereBetween('created_at', [$start, $end]);
        }])->orderByDesc('total_sold')->take(5)->get();

        // Recent Sales
        $recentSales = Sale::with('customer')->whereBetween('created_at', [$start, $end])
            ->latest()->take(5)->get();

        // Recent Purchases
        $recentPurchases = Purchase::with('supplier')->whereBetween('created_at', [$start, $end])
            ->latest()->take(5)->get();

        // Profit
        $profit = $totalSalesAmount - $totalPurchaseAmount;

        return view('admin.reports.index', compact(
            'period', 'start', 'end',
            'totalSales', 'totalSalesAmount', 'totalSalesPaid', 'totalSalesDue',
            'totalPurchases', 'totalPurchaseAmount',
            'totalProducts', 'lowStockProducts', 'outOfStockProducts',
            'totalCustomers', 'totalSuppliers',
            'topProducts', 'recentSales', 'recentPurchases', 'profit'
        ));
    }
}