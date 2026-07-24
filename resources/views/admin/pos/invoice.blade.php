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
        padding: 24px 32px;
        border-bottom: 2px solid #0F172A;
        display: flex;
        justify-content: space-between;
        align-items: start;
    }
    .invoice-logo {
        font-size: 20px;
        font-weight: 800;
        color: #0F172A;
        letter-spacing: 1px;
    }
    .invoice-title {
        text-align: right;
    }
    .invoice-title h3 {
        font-size: 24px;
        font-weight: 800;
        color: #0F172A;
        margin: 0;
    }
    .invoice-title span {
        font-size: 13px;
        color: #64748B;
        font-weight: 500;
    }
    .invoice-body {
        padding: 24px 32px;
    }
    .invoice-table {
        width: 100%;
        border-collapse: collapse;
    }
    .invoice-table th {
        background: #F8FAFC;
        padding: 10px 12px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748B;
        border-bottom: 2px solid #E2E8F0;
        text-align: left;
    }
    .invoice-table td {
        padding: 10px 12px;
        font-size: 13px;
        border-bottom: 1px solid #F1F5F9;
    }
    .invoice-summary {
        margin-top: 20px;
        text-align: right;
    }
    .invoice-footer {
        padding: 20px 32px;
        border-top: 1px solid #E2E8F0;
        text-align: center;
        font-size: 11px;
        color: #94A3B8;
    }
    .btn-print {
        padding: 10px 24px;
        background: #3B82F6;
        color: #FFF;
        border: none;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        cursor: pointer;
    }
    @media print {
        .sidebar, .top-bar, .btn-print { display: none !important; }
        .main-content { margin: 0 !important; padding: 0 !important; }
    }
</style>
@endpush

@section('content')
@php
    $sale = \App\Models\Sale::with('items')->find(request()->segment(3));
@endphp

@if($sale)
<div class="invoice-wrapper">
    <div class="invoice-header">
        <div>
            <div class="invoice-logo">🏪 REAL POS</div>
            <div style="font-size:11px;color:#64748B;margin-top:4px;">123, Dhaka, Bangladesh</div>
            <div style="font-size:11px;color:#64748B;">Phone: +8801700-000000</div>
        </div>
        <div class="invoice-title">
            <h3>INVOICE</h3>
            <span>{{ $sale->invoice_no }}</span>
            <br>
            <span>{{ $sale->created_at->format('d M, Y h:i A') }}</span>
        </div>
    </div>

    <div class="invoice-body">
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th style="text-align:right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale->items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $item->product_name }}</strong>
                            <br><small style="color:#94A3B8;">{{ $item->product_sku }}</small>
                        </td>
                        <td>৳ {{ number_format($item->unit_price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td style="text-align:right;font-weight:700;">৳ {{ number_format($item->total_price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="invoice-summary">
            <div style="display:flex;justify-content:flex-end;gap:20px;margin-top:8px;">
                <span>Subtotal:</span>
                <span style="font-weight:600;">৳ {{ number_format($sale->subtotal, 2) }}</span>
            </div>
            <div style="display:flex;justify-content:flex-end;gap:20px;color:#EF4444;">
                <span>Discount:</span>
                <span style="font-weight:600;">− ৳ {{ number_format($sale->discount, 2) }}</span>
            </div>
            <div style="display:flex;justify-content:flex-end;gap:20px;font-size:18px;font-weight:800;margin-top:8px;padding-top:8px;border-top:2px solid #0F172A;">
                <span>Total:</span>
                <span>৳ {{ number_format($sale->total, 2) }}</span>
            </div>
            <div style="margin-top:8px;font-size:12px;color:#64748B;">
                Payment: {{ strtoupper($sale->payment_method) }} | Paid: ৳ {{ number_format($sale->paid, 2) }}
                @if($sale->due > 0) | Due: ৳ {{ number_format($sale->due, 2) }} @endif
            </div>
        </div>
    </div>

    <div class="invoice-footer">
        Thank you for your purchase! | Goods once sold will not be returned.
    </div>
</div>

<div style="text-align:center;margin-top:20px;">
    <button class="btn-print" onclick="window.print()">🖨️ Print Invoice</button>
    <a href="{{ route('pos.index') }}" style="padding:10px 24px;background:#FFF;border:1px solid #E2E8F0;color:#475569;font-size:12px;font-weight:600;text-transform:uppercase;text-decoration:none;margin-left:8px;">New Sale</a>
</div>
@else
    <div style="text-align:center;padding:60px;">
        <div style="font-size:48px;margin-bottom:12px;">📄</div>
        <div style="font-weight:600;">Invoice not found</div>
    </div>
@endif
@endsection