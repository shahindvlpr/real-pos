@extends('layouts.admin')

@section('title', 'Sales History')
@section('page-title', 'Sales History')
@section('page-subtitle', 'View all sales transactions')

@push('styles')
<style>
    .stat-mini {
        background: #FFF;
        border: 1px solid #E2E8F0;
        padding: 16px 20px;
        text-align: center;
    }
    .stat-mini-value {
        font-size: 20px;
        font-weight: 800;
        color: #0F172A;
    }
    .stat-mini-label {
        font-size: 10px;
        color: #94A3B8;
        text-transform: uppercase;
        font-weight: 600;
        margin-top: 2px;
    }
    .invoice-link {
        color: #3B82F6;
        font-weight: 700;
        text-decoration: none;
    }
    .invoice-link:hover { text-decoration: underline; }
    .status-paid { color: #10B981; font-weight: 700; }
    .status-due { color: #EF4444; font-weight: 700; }
    .status-partial { color: #F59E0B; font-weight: 700; }
    .filter-row {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }
    .filter-input {
        padding: 8px 12px;
        border: 1px solid #E2E8F0;
        font-size: 12px;
        font-family: 'Inter', sans-serif;
    }
</style>
@endpush

@section('content')
<!-- Stats -->
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:16px;">
    <div class="stat-mini">
        <div class="stat-mini-value">{{ $totalSales }}</div>
        <div class="stat-mini-label">Total Sales</div>
    </div>
    <div class="stat-mini">
        <div class="stat-mini-value">৳ {{ number_format($totalAmount, 2) }}</div>
        <div class="stat-mini-label">Total Amount</div>
    </div>
    <div class="stat-mini">
        <div class="stat-mini-value">৳ {{ number_format($totalPaid, 2) }}</div>
        <div class="stat-mini-label">Total Paid</div>
    </div>
    <div class="stat-mini">
        <div class="stat-mini-value">৳ {{ number_format($totalDue, 2) }}</div>
        <div class="stat-mini-label">Total Due</div>
    </div>
</div>

<!-- Filters -->
<div class="card" style="padding:16px 20px;margin-bottom:16px;">
    <form method="GET" class="filter-row">
        <span style="font-size:11px;font-weight:700;color:#64748B;">Date:</span>
        <input type="date" name="date_from" value="{{ request('date_from') }}" class="filter-input">
        <span style="color:#94A3B8;">to</span>
        <input type="date" name="date_to" value="{{ request('date_to') }}" class="filter-input">
        <button type="submit" style="padding:8px 16px;background:#3B82F6;color:#FFF;border:none;font-size:11px;font-weight:700;text-transform:uppercase;cursor:pointer;">Filter</button>
        <a href="{{ route('admin.sales.index') }}" style="font-size:11px;color:#EF4444;text-decoration:none;font-weight:600;">Clear</a>
    </form>
</div>

<!-- Sales Table -->
<div class="card" style="padding:0;">
    <div style="overflow-x:auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Customer</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Paid</th>
                    <th>Due</th>
                    <th>Payment</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $sale)
                    <tr>
                        <td>
                            <a href="{{ route('admin.sales.show', $sale) }}" class="invoice-link">
                                {{ $sale->invoice_no }}
                            </a>
                        </td>
                        <td>{{ $sale->customer->name ?? 'Walk-in' }}</td>
                        <td>{{ $sale->items->count() }}</td>
                        <td style="font-weight:700;">৳ {{ number_format($sale->total, 2) }}</td>
                        <td>৳ {{ number_format($sale->paid, 2) }}</td>
                        <td class="status-{{ $sale->payment_status }}">
                            ৳ {{ number_format($sale->due, 2) }}
                        </td>
                        <td><span style="font-size:10px;text-transform:uppercase;font-weight:600;background:#F1F5F9;padding:2px 8px;">{{ $sale->payment_method }}</span></td>
                        <td style="font-size:11px;color:#64748B;">{{ $sale->created_at->format('d M, h:i A') }}</td>
                        <td>
                            <a href="{{ route('admin.sales.show', $sale) }}" style="color:#3B82F6;font-size:12px;font-weight:600;">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align:center;padding:40px;color:#94A3B8;">
                            No sales found for this period
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($sales->hasPages())
        <div style="padding:14px 20px;border-top:1px solid #E2E8F0;">
            {{ $sales->links() }}
        </div>
    @endif
</div>
@endsection