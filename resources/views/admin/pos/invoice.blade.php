@extends('layouts.admin')

@section('title', 'Invoice')
@section('page-title', 'Invoice')
@section('page-subtitle', 'Sale Invoice')

@push('styles')
<style>
    .invoice-wrapper {
        max-width: 800px;
        margin: 0 auto;
        background: #FFF;
        border: 1px solid #E2E8F0;
    }
    .invoice-header {
        padding: 20px 28px;
        border-bottom: 2px solid #0F172A;
        display: flex;
        justify-content: space-between;
        align-items: start;
    }
    .invoice-logo {
        font-size: 18px;
        font-weight: 800;
        color: #0F172A;
        letter-spacing: 1px;
    }
    .invoice-title {
        text-align: right;
    }
    .invoice-title h3 {
        font-size: 22px;
        font-weight: 800;
        color: #0F172A;
        margin: 0;
    }
    .invoice-title span {
        font-size: 12px;
        color: #64748B;
        font-weight: 500;
    }
    .invoice-body {
        padding: 20px 28px;
    }
    .invoice-table {
        width: 100%;
        border-collapse: collapse;
    }
    .invoice-table th {
        background: #F8FAFC;
        padding: 9px 10px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748B;
        border-bottom: 2px solid #E2E8F0;
        text-align: left;
    }
    .invoice-table td {
        padding: 9px 10px;
        font-size: 12px;
        border-bottom: 1px solid #F1F5F9;
        color: #334155;
    }
    .invoice-summary {
        margin-top: 16px;
        text-align: right;
    }
    .summary-row {
        display: flex;
        justify-content: flex-end;
        gap: 16px;
        margin-top: 4px;
        font-size: 12px;
    }
    .summary-total {
        display: flex;
        justify-content: flex-end;
        gap: 16px;
        font-size: 18px;
        font-weight: 800;
        margin-top: 8px;
        padding-top: 8px;
        border-top: 2px solid #0F172A;
    }
    .invoice-footer {
        padding: 16px 28px;
        border-top: 1px solid #E2E8F0;
        text-align: center;
        font-size: 10px;
        color: #94A3B8;
        line-height: 1.6;
    }
    
    /* Action Buttons */
    .action-bar {
        text-align: center;
        margin-top: 20px;
        display: flex;
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .btn-print {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 24px;
        background: #3B82F6;
        color: #FFF;
        border: 1px solid #3B82F6;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.15s;
    }
    .btn-print:hover {
        background: #2563EB;
        color: #FFF;
    }
    .btn-thermal {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 24px;
        background: #10B981;
        color: #FFF;
        border: 1px solid #10B981;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.15s;
    }
    .btn-thermal:hover {
        background: #059669;
        color: #FFF;
    }
    .btn-new-sale {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 24px;
        background: #FFF;
        color: #475569;
        border: 1px solid #E2E8F0;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.15s;
    }
    .btn-new-sale:hover {
        background: #F1F5F9;
        border-color: #CBD5E1;
    }
    
    /* Status Badge */
    .status-badge {
        display: inline-block;
        padding: 3px 10px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
    }
    .status-paid { background: #ECFDF5; color: #059669; }
    .status-partial { background: #FEF3C7; color: #D97706; }
    
    @media print {
        .sidebar, .top-bar, .action-bar, .page-content { display: none !important; }
        .main-content { margin: 0 !important; padding: 0 !important; }
        .invoice-wrapper { border: none !important; max-width: 100% !important; }
    }
</style>
@endpush

@section('content')
@if(isset($sale) && $sale)
<div class="invoice-wrapper">
    <!-- Header -->
    <div class="invoice-header">
        <div>
            <div class="invoice-logo">{{ \App\Models\Setting::get('company_name', 'REAL POS') }}</div>
            <div style="font-size:10px;color:#64748B;margin-top:2px;">{{ \App\Models\Setting::get('company_address', 'Dhaka, Bangladesh') }}</div>
            <div style="font-size:10px;color:#64748B;">Phone: {{ \App\Models\Setting::get('company_phone', 'N/A') }}</div>
        </div>
        <div class="invoice-title">
            <h3>INVOICE</h3>
            <span>{{ $sale->invoice_no }}</span>
            <br>
            <span>{{ $sale->created_at->format('d M, Y h:i A') }}</span>
            <br>
            <span class="status-badge {{ $sale->payment_status == 'paid' ? 'status-paid' : 'status-partial' }}">
                {{ $sale->payment_status }}
            </span>
        </div>
    </div>

    <!-- Customer Info -->
    <div style="padding:12px 28px;background:#FAFBFC;border-bottom:1px solid #E2E8F0;display:flex;gap:24px;font-size:11px;">
        <span><strong>Customer:</strong> {{ $sale->customer->name ?? 'Walk-in' }}</span>
        @if($sale->customer?->phone)
            <span><strong>Phone:</strong> {{ $sale->customer->phone }}</span>
        @endif
        <span><strong>Payment:</strong> {{ strtoupper($sale->payment_method) }}</span>
    </div>

    <!-- Items Table -->
    <div class="invoice-body">
        <table class="invoice-table">
            <thead>
                <tr>
                    <th style="width:40px;">#</th>
                    <th>Product</th>
                    <th style="width:80px;">Price</th>
                    <th style="width:50px;">Qty</th>
                    <th style="width:90px;text-align:right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale->items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $item->product_name }}</strong>
                            <br><small style="color:#94A3B8;">SKU: {{ $item->product_sku }}</small>
                        </td>
                        <td>৳ {{ number_format($item->unit_price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td style="text-align:right;font-weight:700;">৳ {{ number_format($item->total_price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Summary -->
        <div class="invoice-summary">
            <div class="summary-row">
                <span>Subtotal:</span>
                <span style="font-weight:600;">৳ {{ number_format($sale->subtotal, 2) }}</span>
            </div>
            @if($sale->discount > 0)
                <div class="summary-row" style="color:#EF4444;">
                    <span>Discount:</span>
                    <span style="font-weight:600;">− ৳ {{ number_format($sale->discount, 2) }}</span>
                </div>
            @endif
            <div class="summary-total">
                <span>Total:</span>
                <span>৳ {{ number_format($sale->total, 2) }}</span>
            </div>
            <div class="summary-row" style="margin-top:6px;">
                <span>Paid:</span>
                <span style="color:#10B981;font-weight:600;">৳ {{ number_format($sale->paid, 2) }}</span>
            </div>
            @if($sale->due > 0)
                <div class="summary-row" style="color:#EF4444;">
                    <span>Due:</span>
                    <span style="font-weight:600;">৳ {{ number_format($sale->due, 2) }}</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <div class="invoice-footer">
        {{ \App\Models\Setting::get('invoice_footer', 'Thank you for your purchase!') }}
        <br>
        {{ \App\Models\Setting::get('invoice_terms', 'Goods once sold will not be returned.') }}
    </div>
</div>

<!-- Action Buttons -->
<div class="action-bar">
    <button class="btn-print" onclick="window.print()">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 12H4a2 2 0 00-2 2v4a2 2 0 002 2h16a2 2 0 002-2v-4a2 2 0 00-2-2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
        Print Invoice
    </button>
    <a href="{{ route('pos.print', $sale->id) }}" target="_blank" class="btn-thermal">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="6" width="20" height="12"/><circle cx="12" cy="12" r="2"/></svg>
        Thermal Print
    </a>
    <a href="{{ route('pos.index') }}" class="btn-new-sale">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
        New Sale
    </a>
</div>
@else
    <div style="text-align:center;padding:80px 20px;">
        <div style="font-size:56px;margin-bottom:16px;">📄</div>
        <div style="font-size:16px;font-weight:700;color:#0F172A;">Invoice Not Found</div>
        <div style="font-size:12px;color:#94A3B8;margin-top:4px;">The invoice you're looking for doesn't exist.</div>
        <a href="{{ route('pos.index') }}" class="btn-new-sale" style="margin-top:20px;display:inline-flex;">Back to POS</a>
    </div>
@endif
@endsection