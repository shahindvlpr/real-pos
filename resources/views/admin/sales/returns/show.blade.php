@extends('layouts.admin')

@section('title', 'Return Detail')
@section('page-title', 'Return Detail')
@section('page-subtitle', $saleReturn->return_no)

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card" style="padding:0;">
            <div style="padding:14px 20px;border-bottom:1px solid #E2E8F0;font-weight:700;">Returned Items</div>
            <div style="padding:0;">
                <table class="table">
                    <thead><tr><th>Product</th><th>Price</th><th>Qty</th><th style="text-align:right;">Total</th></tr></thead>
                    <tbody>
                        @foreach($saleReturn->items as $item)
                            <tr>
                                <td><strong>{{ $item->product_name }}</strong></td>
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
        <div class="card" style="padding:0;">
            <div style="padding:14px 20px;border-bottom:1px solid #E2E8F0;font-weight:700;">Summary</div>
            <div style="padding:16px 20px;">
                <div style="display:flex;justify-content:space-between;margin-bottom:6px;"><span style="color:#64748B;">Return No</span><strong>{{ $saleReturn->return_no }}</strong></div>
                <div style="display:flex;justify-content:space-between;margin-bottom:6px;"><span style="color:#64748B;">Invoice</span><strong>{{ $saleReturn->sale->invoice_no ?? 'N/A' }}</strong></div>
                <div style="display:flex;justify-content:space-between;margin-bottom:6px;"><span style="color:#64748B;">Customer</span><strong>{{ $saleReturn->customer->name ?? 'Walk-in' }}</strong></div>
                <hr>
                <div style="display:flex;justify-content:space-between;font-size:18px;font-weight:800;">Total Refund <span style="color:#EF4444;">৳ {{ number_format($saleReturn->refund_amount, 2) }}</span></div>
            </div>
        </div>
        <a href="{{ route('admin.sales.returns.index') }}" style="display:block;text-align:center;padding:12px;margin-top:10px;background:#FFF;border:1px solid #E2E8F0;color:#475569;font-size:12px;font-weight:600;text-decoration:none;">← Back to Returns</a>
    </div>
</div>
@endsection