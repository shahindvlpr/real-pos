@extends('layouts.admin')

@section('title', 'Purchases')
@section('page-title', 'Purchase Orders')
@section('page-subtitle', 'Manage purchase history')

@push('styles')
<style>
    .status-paid { color: #10B981; font-weight: 700; }
    .status-partial { color: #F59E0B; font-weight: 700; }
    .status-due { color: #EF4444; font-weight: 700; }
    .btn-add { display: inline-flex; align-items: center; gap: 6px; background: #3B82F6; color: #FFF; border: 1px solid #3B82F6; padding: 9px 18px; font-size: 11px; font-weight: 700; text-transform: uppercase; text-decoration: none; }
    .btn-add:hover { background: #2563EB; }
    .card-header-row { padding: 16px 20px; border-bottom: 1px solid #E2E8F0; display: flex; justify-content: space-between; align-items: center; }
</style>
@endpush

@section('content')
<div class="card" style="padding:0;">
    <div class="card-header-row">
        <span style="font-size:12px;color:#64748B;">Total: <strong>{{ $purchases->total() }}</strong> purchases</span>
        <a href="{{ route('purchases.create') }}" class="btn-add">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
            New Purchase
        </a>
    </div>

    <div style="overflow-x:auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Supplier</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Paid</th>
                    <th>Due</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($purchases as $purchase)
                    <tr>
                        <td><a href="{{ route('purchases.show', $purchase) }}" style="color:#3B82F6;font-weight:700;">{{ $purchase->invoice_no }}</a></td>
                        <td>{{ $purchase->supplier->name ?? 'N/A' }}</td>
                        <td>{{ $purchase->items->count() }}</td>
                        <td style="font-weight:700;">৳ {{ number_format($purchase->total, 2) }}</td>
                        <td>৳ {{ number_format($purchase->paid, 2) }}</td>
                        <td class="status-{{ $purchase->payment_status }}">৳ {{ number_format($purchase->due, 2) }}</td>
                        <td style="font-size:11px;color:#64748B;">{{ $purchase->created_at->format('d M, h:i A') }}</td>
                        <td>
                            <a href="{{ route('purchases.show', $purchase) }}" style="color:#3B82F6;font-size:12px;font-weight:600;">View</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" style="text-align:center;padding:40px;color:#94A3B8;">No purchases found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($purchases->hasPages())
        <div style="padding:14px 20px;border-top:1px solid #E2E8F0;">{{ $purchases->links() }}</div>
    @endif
</div>
@endsection