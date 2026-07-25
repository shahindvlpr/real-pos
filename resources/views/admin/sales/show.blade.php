@extends('layouts.admin')

@section('title', 'Sale Detail')
@section('page-title', 'Sale Detail')
@section('page-subtitle', $sale->invoice_no)

@push('styles')
<style>
    .detail-card { background:#FFF; border:1px solid #E2E8F0; margin-bottom:16px; }
    .detail-header { padding:16px 20px; border-bottom:1px solid #E2E8F0; display:flex; justify-content:space-between; align-items:center; }
    .detail-body { padding:20px; }
    .detail-row { display:flex; margin-bottom:8px; }
    .detail-label { width:130px; font-size:12px; color:#64748B; font-weight:600; }
    .detail-value { font-size:13px; color:#0F172A; font-weight:500; }
    @media print {
        .sidebar, .top-bar, .btn { display:none !important; }
        .main-content { margin:0 !important; padding:0 !important; }
    }
    .col-lg-8 {
    width: 100%;
    margin: 0 auto;
}
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-8">
        <!-- Items -->
        <div class="detail-card">
            <div class="detail-header">
                <span style="font-weight:700;color:#0F172A;">Items</span>
                <span style="font-size:12px;color:#64748B;">{{ $sale->items->count() }} items</span>
            </div>
            <div class="detail-body" style="padding:0;">
                <table class="table">
                    <thead>
                        <tr><th>Product</th><th>Price</th><th>Qty</th><th style="text-align:right;">Total</th></tr>
                    </thead>
                    <tbody>
                        @foreach($sale->items as $item)
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
        <!-- Summary -->
        <div class="detail-card">
            <div class="detail-header"><span style="font-weight:700;">Summary</span></div>
            <div class="detail-body">
                <div class="detail-row"><span class="detail-label">Invoice No</span><span class="detail-value">{{ $sale->invoice_no }}</span></div>
                <div class="detail-row"><span class="detail-label">Date</span><span class="detail-value">{{ $sale->created_at->format('d M, Y h:i A') }}</span></div>
                <div class="detail-row"><span class="detail-label">Customer</span><span class="detail-value">{{ $sale->customer->name ?? 'Walk-in' }}</span></div>
                <div class="detail-row"><span class="detail-label">Payment</span><span class="detail-value">{{ strtoupper($sale->payment_method) }}</span></div>
                <hr>
                <div class="detail-row"><span class="detail-label">Subtotal</span><span class="detail-value">৳ {{ number_format($sale->subtotal, 2) }}</span></div>
                <div class="detail-row"><span class="detail-label">Discount</span><span class="detail-value" style="color:#EF4444;">− ৳ {{ number_format($sale->discount, 2) }}</span></div>
                <div class="detail-row" style="font-size:16px;font-weight:800;padding-top:8px;border-top:2px solid #0F172A;margin-top:8px;"><span class="detail-label">Total</span><span class="detail-value">৳ {{ number_format($sale->total, 2) }}</span></div>
                <div class="detail-row"><span class="detail-label">Paid</span><span class="detail-value" style="color:#10B981;">৳ {{ number_format($sale->paid, 2) }}</span></div>
                <div class="detail-row"><span class="detail-label">Due</span><span class="detail-value" style="color:#EF4444;">৳ {{ number_format($sale->due, 2) }}</span></div>
            </div>
        </div>

        <!-- Actions -->
        <button onclick="window.print()" style="width:100%;padding:12px;background:#3B82F6;color:#FFF;border:none;font-size:13px;font-weight:700;text-transform:uppercase;cursor:pointer;margin-bottom:8px;">🖨️ Print Invoice</button>
        <a href="{{ route('pos.index') }}" style="display:block;text-align:center;padding:12px;background:#FFF;border:1px solid #E2E8F0;color:#475569;font-size:13px;font-weight:600;text-decoration: none;">New Sale</a>
    </div>
</div>
@endsection