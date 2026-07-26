@extends('layouts.admin')

@section('title', 'Stock Out')
@section('page-title', 'Stock Out')
@section('page-subtitle', 'Remove stock from inventory')

@section('content')
<div style="margin:0 auto;width:100%;">
    <div class="card" style="padding:0;">
        <div style="padding:18px 24px;border-bottom:1px solid #E2E8F0;font-weight:700;color:#0F172A;">Stock Out Form</div>
        <div style="padding:24px;">
            @if($errors->any())
                <div style="background:#FEF2F2;border:1px solid #FECACA;padding:12px;margin-bottom:16px;color:#DC2626;font-size:12px;">
                    <ul style="margin:0;padding-left:18px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif
            <form action="{{ route('admin.inventory.stock-out-store') }}" method="POST">
                @csrf
                <div style="display:grid;gap:14px;">
                    <div>
                        <label style="display:block;font-size:11px;font-weight:700;color:#475569;text-transform:uppercase;margin-bottom:4px;">Product</label>
                        <select name="product_id" style="width:100%;padding:9px 12px;border:1px solid #E2E8F0;font-size:13px;" required>
                            <option value="">Select Product</option>
                            @foreach($products as $p)<option value="{{ $p->id }}">{{ $p->name }} ({{ $p->sku }}) - Stock: {{ $p->stock_quantity }}</option>@endforeach
                        </select>
                    </div>
                    <div>
                        <label style="display:block;font-size:11px;font-weight:700;color:#475569;text-transform:uppercase;margin-bottom:4px;">Quantity</label>
                        <input type="number" name="quantity" value="1" min="1" style="width:100%;padding:9px 12px;border:1px solid #E2E8F0;font-size:13px;" required>
                    </div>
                    <div>
                        <label style="display:block;font-size:11px;font-weight:700;color:#475569;text-transform:uppercase;margin-bottom:4px;">Notes</label>
                        <textarea name="notes" rows="2" style="width:100%;padding:9px 12px;border:1px solid #E2E8F0;font-size:13px;" placeholder="Reason for removal..."></textarea>
                    </div>
                    <div style="display:flex;justify-content:flex-end;gap:10px;padding-top:12px;border-top:1px solid #E2E8F0;">
                        <a href="{{ route('admin.inventory.index') }}" style="padding:9px 18px;background:#FFF;border:1px solid #E2E8F0;color:#475569;font-size:12px;font-weight:600;text-transform:uppercase;text-decoration:none;">Cancel</a>
                        <button type="submit" style="padding:9px 18px;background:#EF4444;border:1px solid #EF4444;color:#FFF;font-size:12px;font-weight:700;text-transform:uppercase;cursor:pointer;">Remove Stock</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection