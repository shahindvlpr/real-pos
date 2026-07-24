@extends('layouts.admin')

@section('title', 'Products')
@section('page-title', 'Products')
@section('page-subtitle', 'Manage your product inventory')

@push('styles')
<style>
    .product-img { width: 44px; height: 44px; border: 1px solid #E2E8F0; display: flex; align-items: center; justify-content: center; overflow: hidden; background: #FAFBFC; }
    .product-img img { width: 100%; height: 100%; object-fit: cover; }
    .product-name { font-size: 13px; font-weight: 600; color: #0F172A; }
    .product-sku { font-size: 10px; color: #3B82F6; font-weight: 600; }
    .product-meta { font-size: 10px; color: #94A3B8; }
    .price { font-size: 13px; font-weight: 700; color: #0F172A; }
    .cost-price { font-size: 11px; color: #94A3B8; text-decoration: line-through; }
    .stock-badge { display: inline-flex; align-items: center; gap: 4px; font-size: 11px; font-weight: 700; padding: 2px 8px; }
    .stock-badge.in-stock { background: #ECFDF5; color: #059669; }
    .stock-badge.low-stock { background: #FEF3C7; color: #D97706; }
    .stock-badge.out-stock { background: #FEF2F2; color: #DC2626; }
    .status-badge { display: inline-flex; align-items: center; gap: 4px; font-size: 10px; font-weight: 700; text-transform: uppercase; padding: 2px 8px; }
    .status-badge.active { background: #ECFDF5; color: #059669; }
    .status-badge.inactive { background: #F1F5F9; color: #94A3B8; }
    .action-btn { width: 30px; height: 30px; display: inline-flex; align-items: center; justify-content: center; border: 1px solid #E2E8F0; background: #FFFFFF; cursor: pointer; transition: all 0.15s; }
    .action-btn:hover { background: #F8FAFC; border-color: #CBD5E1; }
    .action-btn.edit { color: #F59E0B; } .action-btn.edit:hover { background: #FFFBEB; border-color: #F59E0B; }
    .action-btn.delete { color: #EF4444; } .action-btn.delete:hover { background: #FEF2F2; border-color: #EF4444; }
    .action-btn svg { width: 14px; height: 14px; }
    .btn-add { display: inline-flex; align-items: center; gap: 6px; background: #3B82F6; color: #FFF; border: 1px solid #3B82F6; padding: 8px 16px; font-size: 11px; font-weight: 700; text-transform: uppercase; text-decoration: none; }
    .btn-add:hover { background: #2563EB; }
    .btn-add svg { width: 14px; height: 14px; }
    .card-header-row { padding: 16px 20px; border-bottom: 1px solid #E2E8F0; display: flex; justify-content: space-between; align-items: center; }
    .header-count { font-size: 12px; color: #64748B; }
    .header-count strong { color: #0F172A; font-weight: 700; }
    .empty-wrap { text-align: center; padding: 64px 20px; }
    .empty-icon-box { width: 72px; height: 72px; background: #F1F5F9; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px; }
    .empty-icon-box svg { width: 30px; height: 30px; color: #94A3B8; }
    .pagination-footer { padding: 14px 20px; border-top: 1px solid #E2E8F0; display: flex; justify-content: space-between; align-items: center; }
    .pagination-info { font-size: 11px; color: #94A3B8; }
    .table tbody tr:hover { background: #F8FAFC; }
    .tag { display: inline-block; font-size: 10px; font-weight: 600; padding: 2px 8px; background: #F1F5F9; color: #475569; }
</style>
@endpush

@section('content')
<div class="card" style="padding: 0;">
    <div class="card-header-row">
        <span class="header-count">Total: <strong>{{ $products->total() }}</strong> products</span>
        <a href="{{ route('products.create') }}" class="btn-add">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
            Add Product
        </a>
    </div>

    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td style="width: 40px;"><span style="font-size: 11px; color: #94A3B8;">#{{ $product->id }}</span></td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div class="product-img">
                                    @if($product->image)
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                    @else
                                        <span style="font-size: 16px;">📦</span>
                                    @endif
                                </div>
                                <div>
                                    <div class="product-name">{{ $product->name }}</div>
                                    <div class="product-sku">{{ $product->sku }}</div>
                                    @if($product->barcode)
                                        <div class="product-meta">Barcode: {{ $product->barcode }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($product->category)
                                <span class="tag">{{ $product->category->name }}</span>
                            @else
                                <span style="color: #94A3B8; font-size: 11px;">-</span>
                            @endif
                        </td>
                        <td>
                            <div class="price">৳ {{ number_format($product->selling_price, 2) }}</div>
                            @if($product->cost_price > 0)
                                <div class="cost-price">৳ {{ number_format($product->cost_price, 2) }}</div>
                            @endif
                        </td>
                        <td>
                            @php
                                $stockClass = 'in-stock';
                                if ($product->stock_quantity == 0) $stockClass = 'out-stock';
                                elseif ($product->stock_quantity <= $product->min_stock_quantity) $stockClass = 'low-stock';
                            @endphp
                            <span class="stock-badge {{ $stockClass }}">
                                {{ $product->stock_quantity }} {{ $product->unit?->code ?? 'PCS' }}
                            </span>
                        </td>
                        <td>
                            <span class="status-badge {{ $product->is_active ? 'active' : 'inactive' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 4px;">
                                <a href="{{ route('products.edit', $product) }}" class="action-btn edit" title="Edit">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <button onclick="confirmDelete('del-{{ $product->id }}')" class="action-btn delete">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                                </button>
                            </div>
                            <form id="del-{{ $product->id }}" action="{{ route('products.destroy', $product) }}" method="POST" style="display: none;">@csrf @method('DELETE')</form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-wrap">
                                <div class="empty-icon-box">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="12 2 22 8 12 14 2 8 12 2"/><polyline points="2 8 12 14 22 8"/></svg>
                                </div>
                                <div style="font-size: 15px; font-weight: 700; color: #0F172A; margin-bottom: 4px;">No Products Found</div>
                                <div style="font-size: 12px; color: #94A3B8; margin-bottom: 20px;">Start adding products to your inventory</div>
                                <a href="{{ route('products.create') }}" class="btn-add">Add First Product</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
        <div class="pagination-footer">
            <span class="pagination-info">Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }}</span>
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection