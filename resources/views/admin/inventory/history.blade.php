@extends('layouts.admin')

@section('title', 'Stock History')
@section('page-title', 'Stock History')
@section('page-subtitle', 'All stock movements')

@push('styles')
<style>
    .badge-type { display:inline-block;font-size:10px;font-weight:700;text-transform:uppercase;padding:2px 8px; }
    .badge-in { background:#ECFDF5; color:#059669; }
    .badge-out { background:#FEF2F2; color:#DC2626; }
</style>
@endpush

@section('content')
<div style="display:flex;gap:8px;margin-bottom:16px;">
    <a href="{{ route('admin.inventory.index') }}" style="padding:8px 14px;background:#FFF;border:1px solid #E2E8F0;color:#475569;font-size:11px;font-weight:600;text-decoration:none;">← Back</a>
    <a href="{{ route('admin.inventory.stock-in') }}" style="padding:8px 14px;background:#ECFDF5;border:1px solid #10B981;color:#059669;font-size:11px;font-weight:600;text-decoration:none;">+ Stock In</a>
    <a href="{{ route('admin.inventory.stock-out') }}" style="padding:8px 14px;background:#FEF2F2;border:1px solid #EF4444;color:#DC2626;font-size:11px;font-weight:600;text-decoration:none;">- Stock Out</a>
</div>

<div class="card" style="padding:0;">
    <div style="overflow-x:auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Product</th>
                    <th>Type</th>
                    <th>Qty</th>
                    <th>Before</th>
                    <th>After</th>
                    <th>Notes</th>
                    <th>User</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $t)
                    <tr>
                        <td style="font-size:11px;color:#64748B;">{{ $t->created_at->format('d M, h:i A') }}</td>
                        <td><strong>{{ $t->product->name ?? 'N/A' }}</strong></td>
                        <td><span class="badge-type badge-{{ $t->type == 'stock_in' ? 'in' : 'out' }}">{{ $t->type }}</span></td>
                        <td style="font-weight:700;">{{ $t->quantity }}</td>
                        <td>{{ $t->before_quantity }}</td>
                        <td>{{ $t->after_quantity }}</td>
                        <td>{{ $t->notes ?? '-' }}</td>
                        <td>{{ $t->user->name ?? 'System' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="8" style="text-align:center;padding:40px;color:#94A3B8;">No transactions</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($transactions->hasPages())
        <div style="padding:14px 20px;border-top:1px solid #E2E8F0;">{{ $transactions->links() }}</div>
    @endif
</div>
@endsection