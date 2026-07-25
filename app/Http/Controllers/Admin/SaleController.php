<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::with(['customer', 'user', 'items'])
            ->latest();

        // Date filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Today by default
        if (!$request->filled('date_from') && !$request->filled('date_to')) {
            $query->whereDate('created_at', today());
        }

        $sales = $query->paginate(15);

        // Calculate totals
        $totalSales = $query->count();
        $totalAmount = $query->sum('total');
        $totalPaid = $query->sum('paid');
        $totalDue = $query->sum('due');

        return view('admin.sales.index', compact(
            'sales', 'totalSales', 'totalAmount', 'totalPaid', 'totalDue'
        ));
    }

    public function show(Sale $sale)
    {
        $sale->load(['customer', 'user', 'items.product']);
        return view('admin.sales.show', compact('sale'));
    }
}