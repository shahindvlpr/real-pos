@extends('layouts.admin')

@section('title', 'Sales Returns')
@section('page-title', 'Sales Returns')
@section('page-subtitle', 'Manage returned items')

@push('styles')
<style>
    .btn-add { display: inline-flex; align-items: center; gap: 6px; background: #EF4444; color: #FFF; border: 1px solid #EF4444; padding: 9px 18px; font-size: 11px; font-weight: 700; text-transform: uppercase; text-decoration: none; }
    .btn-add:hover { background: #DC2626; }
    .card-header-row { padding: 16px 20px; border-bottom: 1px solid #E2E8F0; display: flex; justify-content: space-between; align-items: center; }
</style>
@endpush

@section('content')
<div class="card" style="padding:0;">
    <div class="card-header-row">
        <span style="font-size:12px;color:#64748B;">Total: <strong>{{ $returns->total() }}</strong> returns</span>
        <a href="{{ route('admin.sales.returns.create') }}" class="btn-add">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
            Process Return
        </a>
    </div>

    <div style="overflow-x:auto;">
        <table class="table">
            <thead>
                <tr><th>Return No</th><th>Invoice</th><th>Customer</th><th>Amount</th><th>Date</th><th>Action</th></tr>
            </thead>
            <tbody>
                @forelse($returns as $ret)
                    <tr>
                        <td><a href="{{ route('admin.sales.returns.show', $ret) }}" style="color:#EF4444;font-weight:700;">{{ $ret->return_no }}</a></td>
                        <td>{{ $ret->sale->invoice_no ?? 'N/A' }}</td>
                        <td>{{ $ret->customer->name ?? 'Walk-in' }}</td>
                        <td style="font-weight:700;">৳ {{ number_format($ret->refund_amount, 2) }}</td>
                        <td style="font-size:11px;color:#64748B;">{{ $ret->created_at->format('d M, h:i A') }}</td>
                        <td><a href="{{ route('admin.sales.returns.show', $ret) }}" style="color:#3B82F6;font-size:12px;font-weight:600;">View</a></td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center;padding:40px;color:#94A3B8;">No returns found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($returns->hasPages())
        <div style="padding:14px 20px;border-top:1px solid #E2E8F0;">{{ $returns->links() }}</div>
    @endif
</div>
@endsection