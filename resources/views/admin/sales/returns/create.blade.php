@extends('layouts.admin')

@section('title', 'Process Return')
@section('page-title', 'Process Return')
@section('page-subtitle', 'Find sale invoice to return')

@section('content')
<div style="max-width:550px;margin:0 auto;width:100%;">
    <div class="card" style="padding:0;">
        <div style="padding:18px 24px;border-bottom:1px solid #E2E8F0;font-weight:700;color:#0F172A;">Find Sale Invoice</div>
        <div style="padding:24px;">
            @if(session('error'))
                <div style="background:#FEF2F2;border:1px solid #FECACA;padding:12px;margin-bottom:16px;color:#DC2626;font-size:12px;">{{ session('error') }}</div>
            @endif
            <form action="{{ route('admin.sales.returns.find') }}" method="POST">
                @csrf
                <div style="margin-bottom:14px;">
                    <label style="display:block;font-size:11px;font-weight:700;color:#475569;text-transform:uppercase;margin-bottom:4px;">Invoice Number</label>
                    <input type="text" name="invoice_no" class="form-input" placeholder="e.g. INV-10001" required
                           style="width:100%;padding:10px 14px;border:1px solid #E2E8F0;font-size:14px;font-weight:600;font-family:'Inter',sans-serif;">
                </div>
                <button type="submit" style="width:100%;padding:12px;background:#EF4444;border:1px solid #EF4444;color:#FFF;font-size:13px;font-weight:700;text-transform:uppercase;cursor:pointer;">Find & Process Return</button>
            </form>
        </div>
    </div>
</div>
@endsection