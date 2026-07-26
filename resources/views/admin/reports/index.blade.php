@extends('layouts.admin')

@section('title', 'Reports')
@section('page-title', 'Reports')
@section('page-subtitle', 'Business analytics & insights')

@push('styles')
<style>
    .stat-mini {
        background: #FFF; border: 1px solid #E2E8F0; padding: 16px 18px; text-align: center;
    }
    .stat-mini-value { font-size: 20px; font-weight: 800; color: #0F172A; }
    .stat-mini-label { font-size: 10px; color: #94A3B8; text-transform: uppercase; font-weight: 600; margin-top: 2px; }
    
    .period-btn {
        padding: 7px 14px; border: 1px solid #E2E8F0; background: #FFF;
        font-size: 11px; font-weight: 600; cursor: pointer; transition: all 0.15s;
        text-decoration: none; color: #475569; display: inline-block;
    }
    .period-btn.active { background: #3B82F6; color: #FFF; border-color: #3B82F6; }
    .period-btn:hover:not(.active) { background: #F1F5F9; }
    
    .report-card {
        background: #FFF; border: 1px solid #E2E8F0; margin-bottom: 16px;
    }
    .report-card-header {
        padding: 14px 20px; border-bottom: 1px solid #E2E8F0;
        font-size: 13px; font-weight: 700; color: #0F172A;
        display: flex; justify-content: space-between; align-items: center;
    }
    .report-card-body { padding: 16px 20px; }
    
    .progress-bar {
        height: 6px; background: #E2E8F0; margin-top: 4px;
    }
    .progress-fill { height: 100%; background: #3B82F6; }
    
    .text-green { color: #10B981; }
    .text-red { color: #EF4444; }
    .text-amber { color: #F59E0B; }
    .text-blue { color: #3B82F6; }
</style>
@endpush

@section('content')
<!-- Period Filter -->
<div style="display:flex;gap:6px;margin-bottom:16px;flex-wrap:wrap;">
    <a href="?period=today" class="period-btn {{ $period == 'today' ? 'active' : '' }}">Today</a>
    <a href="?period=yesterday" class="period-btn {{ $period == 'yesterday' ? 'active' : '' }}">Yesterday</a>
    <a href="?period=this_week" class="period-btn {{ $period == 'this_week' ? 'active' : '' }}">This Week</a>
    <a href="?period=this_month" class="period-btn {{ $period == 'this_month' ? 'active' : '' }}">This Month</a>
    <a href="?period=last_month" class="period-btn {{ $period == 'last_month' ? 'active' : '' }}">Last Month</a>
    <a href="?period=this_year" class="period-btn {{ $period == 'this_year' ? 'active' : '' }}">This Year</a>
</div>

<!-- Summary Stats -->
<div style="display:grid;grid-template-columns:repeat(5,1fr);gap:10px;margin-bottom:16px;">
    <div class="stat-mini">
        <div class="stat-mini-value text-blue">৳ {{ number_format($totalSalesAmount, 0) }}</div>
        <div class="stat-mini-label">Sales</div>
    </div>
    <div class="stat-mini">
        <div class="stat-mini-value text-green">৳ {{ number_format($totalSalesPaid, 0) }}</div>
        <div class="stat-mini-label">Paid</div>
    </div>
    <div class="stat-mini">
        <div class="stat-mini-value text-red">৳ {{ number_format($totalSalesDue, 0) }}</div>
        <div class="stat-mini-label">Due</div>
    </div>
    <div class="stat-mini">
        <div class="stat-mini-value text-amber">৳ {{ number_format($totalPurchaseAmount, 0) }}</div>
        <div class="stat-mini-label">Purchases</div>
    </div>
    <div class="stat-mini">
        <div class="stat-mini-value {{ $profit >= 0 ? 'text-green' : 'text-red' }}">৳ {{ number_format($profit, 0) }}</div>
        <div class="stat-mini-label">Profit</div>
    </div>
</div>

<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin-bottom:16px;">
    <div class="stat-mini">
        <div class="stat-mini-value">{{ $totalSales }}</div>
        <div class="stat-mini-label">Orders</div>
    </div>
    <div class="stat-mini">
        <div class="stat-mini-value">{{ $totalPurchases }}</div>
        <div class="stat-mini-label">Purchases</div>
    </div>
    <div class="stat-mini">
        <div class="stat-mini-value">{{ $totalProducts }}</div>
        <div class="stat-mini-label">Products</div>
    </div>
    <div class="stat-mini">
        <div class="stat-mini-value">{{ $lowStockProducts }}</div>
        <div class="stat-mini-label">Low Stock</div>
    </div>
</div>

<!-- Recent Sales & Purchases -->
<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
    <!-- Recent Sales -->
    <div class="report-card">
        <div class="report-card-header">Recent Sales</div>
        <div class="report-card-body" style="padding:0;">
            <table class="table">
                <thead><tr><th>Invoice</th><th>Customer</th><th>Amount</th></tr></thead>
                <tbody>
                    @forelse($recentSales as $sale)
                        <tr>
                            <td style="font-weight:600;">{{ $sale->invoice_no }}</td>
                            <td>{{ $sale->customer->name ?? 'Walk-in' }}</td>
                            <td style="font-weight:700;">৳ {{ number_format($sale->total, 0) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" style="text-align:center;color:#94A3B8;">No sales</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Purchases -->
    <div class="report-card">
        <div class="report-card-header">Recent Purchases</div>
        <div class="report-card-body" style="padding:0;">
            <table class="table">
                <thead><tr><th>Invoice</th><th>Supplier</th><th>Amount</th></tr></thead>
                <tbody>
                    @forelse($recentPurchases as $purchase)
                        <tr>
                            <td style="font-weight:600;">{{ $purchase->invoice_no }}</td>
                            <td>{{ $purchase->supplier->name ?? 'N/A' }}</td>
                            <td style="font-weight:700;">৳ {{ number_format($purchase->total, 0) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" style="text-align:center;color:#94A3B8;">No purchases</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Top Products -->
<div class="report-card" style="margin-top:16px;">
    <div class="report-card-header">Top Selling Products</div>
    <div class="report-card-body" style="padding:0;">
        <table class="table">
            <thead><tr><th>#</th><th>Product</th><th>Total Sold</th></tr></thead>
                <tbody>
                    @forelse($topProducts as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $product->name }}</strong></td>
                            <td style="font-weight:700;color:#10B981;">{{ $product->total_sold ?? 0 }} sold</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" style="text-align:center;color:#94A3B8;">No sales data</td></tr>
                    @endforelse
                </tbody>
        </table>
    </div>
</div>
@endsection