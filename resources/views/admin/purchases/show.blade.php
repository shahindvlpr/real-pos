@extends('layouts.admin')

@section('title', 'Purchase Detail')
@section('page-title', 'Purchase Detail')
@section('page-subtitle', $purchase->invoice_no)

@push('styles')
<style>
    .detail-card { background:#FFF; border:1px solid #E2E8F0; margin-bottom:16px; }
    .detail-header { padding:16px 20px; border-bottom:1px solid #E2E8F0; font-weight:700; }
    .detail-body { padding:20px; }
    .detail-row { display:flex; margin-bottom:6px; }
    .detail-label { width:120px; font-size:12px; color:#64748B; font-weight:600; }
    .detail-value { font-size:13px; color:#0F172A; font-weight:500; }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="detail-card">
            <div class="detail-header">Items</div>
            <div class="detail-body" style="padding:0;">
                <table class="table">
                    <thead><tr><th>Product</th><th>Price</th><th>Qty</th><th style="text-align:right;">Total</th></tr></thead>
                    <tbody>
                        @foreach($purchase->items as $item)
                            <tr>
                                <td><strong>{{ $item->product_name }}</strong><br><small style="color:#94A3B8;">{{ $item->product_sku }}</small></td>
                                <td>৳ {{ number_format($item->unit_price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td style="text-align:right;font-weight:700;">৳ {{ number_format($item->total_price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="detail-card">
            <div class="detail-header">Summary</div>
            <div class="detail-body">
                <div class="detail-row"><span class="detail-label">Invoice</span><span class="detail-value">{{ $purchase->invoice_no }}</span></div>
                <div class="detail-row"><span class="detail-label">Supplier</span><span class="detail-value">{{ $purchase->supplier->name ?? 'N/A' }}</span></div>
                <div class="detail-row"><span class="detail-label">Date</span><span class="detail-value">{{ $purchase->created_at->format('d M, Y h:i A') }}</span></div>
                <hr>
                <div class="detail-row"><span class="detail-label">Total</span><span class="detail-value" style="font-size:18px;font-weight:800;">৳ {{ number_format($purchase->total, 2) }}</span></div>
                <div class="detail-row"><span class="detail-label">Paid</span><span class="detail-value" style="color:#10B981;">৳ {{ number_format($purchase->paid, 2) }}</span></div>
                <div class="detail-row"><span class="detail-label">Due</span><span class="detail-value" style="color:#EF4444;">৳ {{ number_format($purchase->due, 2) }}</span></div>
            </div>
        </div>
        <a href="{{ route('purchases.index') }}" style="display:block;text-align:center;padding:12px;background:#FFF;border:1px solid #E2E8F0;color:#475569;font-size:12px;font-weight:600;text-decoration:none;">← Back</a>
    </div>
</div>
@endsection