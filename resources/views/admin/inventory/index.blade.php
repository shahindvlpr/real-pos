@extends('layouts.admin')

@section('title', 'Inventory')
@section('page-title', 'Inventory Management')
@section('page-subtitle', 'Stock overview & management')

@push('styles')
<style>
    .stat-card {
        background: #FFF;
        border: 1px solid #E2E8F0;
        padding: 20px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .stat-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 3px;
        height: 100%;
    }
    .stat-card.blue::after { background: #3B82F6; }
    .stat-card.green::after { background: #10B981; }
    .stat-card.red::after { background: #EF4444; }
    .stat-card.amber::after { background: #F59E0B; }
    
    .stat-value { font-size: 28px; font-weight: 800; color: #0F172A; line-height: 1; }
    .stat-label { font-size: 10px; color: #94A3B8; text-transform: uppercase; font-weight: 700; letter-spacing: 0.8px; margin-top: 4px; }
    .stat-sub { font-size: 10px; color: #64748B; margin-top: 2px; }
    
    .stock-status { display: inline-flex; align-items: center; gap: 6px; font-size: 11px; font-weight: 700; padding: 3px 10px; }
    .stock-status.in-stock { background: #ECFDF5; color: #059669; }
    .stock-status.low-stock { background: #FEF3C7; color: #D97706; }
    .stock-status.out-stock { background: #FEF2F2; color: #DC2626; }
    .stock-dot { width: 6px; height: 6px; }
    .stock-dot.in-stock { background: #10B981; }
    .stock-dot.low-stock { background: #F59E0B; }
    .stock-dot.out-stock { background: #EF4444; }
    
    .btn-action {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 8px 16px; font-size: 10px; font-weight: 700; text-transform: uppercase;
        text-decoration: none; border: 1px solid; transition: all 0.15s;
    }
    .btn-stock-in { background: #ECFDF5; color: #059669; border-color: #10B981; }
    .btn-stock-in:hover { background: #10B981; color: #FFF; }
    .btn-stock-out { background: #FEF2F2; color: #DC2626; border-color: #EF4444; }
    .btn-stock-out:hover { background: #EF4444; color: #FFF; }
    .btn-history { background: #EFF6FF; color: #3B82F6; border-color: #3B82F6; }
    .btn-history:hover { background: #3B82F6; color: #FFF; }
    .btn-report { background: #F5F3FF; color: #7C3AED; border-color: #8B5CF6; }
    .btn-report:hover { background: #8B5CF6; color: #FFF; }
    
    .product-row:hover { background: #F8FAFC; }
    
    .progress-bar {
        height: 4px;
        background: #E2E8F0;
        margin-top: 6px;
    }
    .progress-fill {
        height: 100%;
        transition: width 0.3s;
    }
    .progress-fill.green { background: #10B981; }
    .progress-fill.amber { background: #F59E0B; }
    .progress-fill.red { background: #EF4444; }
</style>
@endpush

@section('content')
<!-- Stats Row - Compact Premium -->
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin-bottom:14px;">
    <!-- Total Stock -->
    <div style="background:#FFF;border:1px solid #E2E8F0;padding:14px 18px;display:flex;align-items:center;gap:12px;transition:all 0.2s;position:relative;overflow:hidden;">
        <div style="width:3px;height:40px;background:#3B82F6;position:absolute;left:0;"></div>
        <div style="width:38px;height:38px;background:#EFF6FF;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-left:4px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2"><polygon points="12 2 22 8 12 14 2 8 12 2"/></svg>
        </div>
        <div>
            <div style="font-size:20px;font-weight:800;color:#0F172A;line-height:1;">{{ $totalStock }}</div>
            <div style="font-size:9px;color:#94A3B8;text-transform:uppercase;font-weight:700;letter-spacing:0.5px;">Total Stock</div>
        </div>
    </div>

    <!-- In Stock -->
    <div style="background:#FFF;border:1px solid #E2E8F0;padding:14px 18px;display:flex;align-items:center;gap:12px;transition:all 0.2s;position:relative;overflow:hidden;">
        <div style="width:3px;height:40px;background:#10B981;position:absolute;left:0;"></div>
        <div style="width:38px;height:38px;background:#ECFDF5;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-left:4px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <div>
            <div style="font-size:20px;font-weight:800;color:#0F172A;line-height:1;">{{ $products->total() - $lowStock - $outOfStock }}</div>
            <div style="font-size:9px;color:#94A3B8;text-transform:uppercase;font-weight:700;letter-spacing:0.5px;">In Stock</div>
        </div>
    </div>

    <!-- Low Stock -->
    <div style="background:#FFF;border:1px solid #E2E8F0;padding:14px 18px;display:flex;align-items:center;gap:12px;transition:all 0.2s;position:relative;overflow:hidden;">
        <div style="width:3px;height:40px;background:#F59E0B;position:absolute;left:0;"></div>
        <div style="width:38px;height:38px;background:#FFFBEB;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-left:4px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        </div>
        <div>
            <div style="font-size:20px;font-weight:800;color:#0F172A;line-height:1;">{{ $lowStock }}</div>
            <div style="font-size:9px;color:#94A3B8;text-transform:uppercase;font-weight:700;letter-spacing:0.5px;">Low Stock</div>
        </div>
    </div>

    <!-- Out of Stock -->
    <div style="background:#FFF;border:1px solid #E2E8F0;padding:14px 18px;display:flex;align-items:center;gap:12px;transition:all 0.2s;position:relative;overflow:hidden;">
        <div style="width:3px;height:40px;background:#EF4444;position:absolute;left:0;"></div>
        <div style="width:38px;height:38px;background:#FEF2F2;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-left:4px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#EF4444" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </div>
        <div>
            <div style="font-size:20px;font-weight:800;color:#0F172A;line-height:1;">{{ $outOfStock }}</div>
            <div style="font-size:9px;color:#94A3B8;text-transform:uppercase;font-weight:700;letter-spacing:0.5px;">Out of Stock</div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div style="display:flex;gap:8px;margin-bottom:16px;flex-wrap:wrap;">
    <a href="{{ route('admin.inventory.stock-in') }}" class="btn-action btn-stock-in">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
        Stock In
    </a>
    <a href="{{ route('admin.inventory.stock-out') }}" class="btn-action btn-stock-out">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/></svg>
        Stock Out
    </a>
    <a href="{{ route('admin.inventory.history') }}" class="btn-action btn-history">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        History
    </a>
</div>

<!-- Filter Info -->
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
    <div style="display:flex;gap:16px;font-size:11px;">
        <span style="display:flex;align-items:center;gap:5px;"><span style="width:8px;height:8px;background:#10B981;"></span> In Stock</span>
        <span style="display:flex;align-items:center;gap:5px;"><span style="width:8px;height:8px;background:#F59E0B;"></span> Low Stock</span>
        <span style="display:flex;align-items:center;gap:5px;"><span style="width:8px;height:8px;background:#EF4444;"></span> Out of Stock</span>
    </div>
</div>

<!-- Products Table -->
<div class="card" style="padding:0;">
    <div style="overflow-x:auto;">
        <table class="table">
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th style="width:100px;">Stock</th>
                    <th style="width:120px;">Progress</th>
                    <th style="width:120px;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    @php
                        $maxStock = $product->max_stock_quantity ?: 100;
                        $stockPercent = min(($product->stock_quantity / max($maxStock, 1)) * 100, 100);
                        
                        if ($product->stock_quantity == 0) {
                            $statusClass = 'out-stock';
                            $barClass = 'red';
                        } elseif ($product->stock_quantity <= $product->min_stock_quantity) {
                            $statusClass = 'low-stock';
                            $barClass = 'amber';
                        } else {
                            $statusClass = 'in-stock';
                            $barClass = 'green';
                        }
                    @endphp
                    <tr class="product-row">
                        <td><span style="font-size:11px;color:#94A3B8;">#{{ $product->id }}</span></td>
                        <td>
                            <div style="font-size:13px;font-weight:600;color:#0F172A;">{{ $product->name }}</div>
                            <div style="font-size:10px;color:#94A3B8;">SKU: {{ $product->sku ?? 'N/A' }}</div>
                        </td>
                        <td><span style="font-size:11px;color:#64748B;">{{ $product->category->name ?? '-' }}</span></td>
                        <td>
                            <div style="font-weight:700;font-size:14px;">{{ $product->stock_quantity }}</div>
                            <div style="font-size:10px;color:#94A3B8;">{{ $product->unit->code ?? 'PCS' }}</div>
                        </td>
                        <td>
                            <div style="font-size:10px;color:#64748B;margin-bottom:2px;">Min: {{ $product->min_stock_quantity }}</div>
                            <div class="progress-bar">
                                <div class="progress-fill {{ $barClass }}" style="width:{{ $stockPercent }}%;"></div>
                            </div>
                        </td>
                        <td>
                            <span class="stock-status {{ $statusClass }}">
                                <span class="stock-dot {{ $statusClass }}"></span>
                                {{ $product->stock_quantity == 0 ? 'Out of Stock' : ($product->stock_quantity <= $product->min_stock_quantity ? 'Low Stock' : 'In Stock') }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;padding:60px 20px;">
                            <div style="font-size:40px;margin-bottom:8px;">📦</div>
                            <div style="font-weight:600;color:#0F172A;">No Products Found</div>
                            <div style="font-size:11px;color:#94A3B8;">Add products to see inventory status</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($products->hasPages())
        <div style="padding:14px 20px;border-top:1px solid #E2E8F0;">{{ $products->links() }}</div>
    @endif
</div>
@endsection