@extends('layouts.admin')

@section('title', 'Process Return')
@section('page-title', 'Process Return')
@section('page-subtitle', 'Invoice: ' . $sale->invoice_no)

@section('content')
<div style="max-width:700px;margin:0 auto;width:100%;">
    <div class="card" style="padding:0;">
        <div style="padding:16px 20px;border-bottom:1px solid #E2E8F0;">
            <div style="font-weight:700;">{{ $sale->invoice_no }}</div>
            <div style="font-size:11px;color:#64748B;">{{ $sale->customer->name ?? 'Walk-in' }} | {{ $sale->created_at->format('d M, Y') }}</div>
        </div>
        <div style="padding:20px;">
            <form action="{{ route('admin.sales.returns.store') }}" method="POST">
                @csrf
                <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                
                @foreach($sale->items as $item)
                    <div style="display:flex;align-items:center;gap:12px;padding:12px;border:1px solid #E2E8F0;margin-bottom:8px;">
                        <input type="checkbox" name="items[]" value="{{ $item->id }}" style="width:16px;height:16px;">
                        <div style="flex:1;">
                            <div style="font-weight:600;">{{ $item->product_name }}</div>
                            <div style="font-size:11px;color:#64748B;">Sold: {{ $item->quantity }} x ৳ {{ number_format($item->unit_price, 2) }}</div>
                        </div>
                        <div>
                            <input type="number" name="quantity[{{ $item->id }}]" value="1" min="1" max="{{ $item->quantity }}"
                                   style="width:60px;padding:6px;border:1px solid #E2E8F0;text-align:center;font-size:13px;">
                        </div>
                    </div>
                @endforeach

                <div style="margin-top:14px;">
                    <label style="display:block;font-size:11px;font-weight:700;color:#475569;text-transform:uppercase;margin-bottom:4px;">Reason</label>
                    <textarea name="reason" rows="2" style="width:100%;padding:9px 12px;border:1px solid #E2E8F0;font-size:13px;"></textarea>
                </div>

                <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:16px;padding-top:16px;border-top:1px solid #E2E8F0;">
                    <a href="{{ route('admin.sales.returns.create') }}" style="padding:9px 18px;background:#FFF;border:1px solid #E2E8F0;color:#475569;font-size:12px;font-weight:600;text-decoration:none;">Cancel</a>
                    <button type="submit" style="padding:9px 18px;background:#EF4444;border:1px solid #EF4444;color:#FFF;font-size:12px;font-weight:700;text-transform:uppercase;cursor:pointer;">Process Return</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection