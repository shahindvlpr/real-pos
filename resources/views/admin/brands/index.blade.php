@extends('layouts.admin')

@section('title', 'Brands')
@section('page-title', 'Brands')
@section('page-subtitle', 'Manage your product brands')

@push('styles')
<style>
    .brand-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .brand-logo {
        width: 40px;
        height: 40px;
        border: 1px solid #E2E8F0;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        overflow: hidden;
        background: #FAFBFC;
    }
    
    .brand-logo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .brand-logo .logo-letter {
        font-size: 15px;
        font-weight: 800;
        color: #3B82F6;
        text-transform: uppercase;
    }
    
    .brand-info {
        min-width: 0;
    }
    
    .brand-info-name {
        font-size: 13px;
        font-weight: 600;
        color: #0F172A;
        line-height: 1.2;
    }
    
    .brand-info-slug {
        font-size: 10px;
        color: #94A3B8;
        font-weight: 500;
        margin-top: 1px;
    }
    
    .brand-info-desc {
        font-size: 11px;
        color: #64748B;
        margin-top: 2px;
        line-height: 1.3;
    }
    
    /* Status */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 3px 10px;
    }
    
    .status-badge.active {
        background: #ECFDF5;
        color: #059669;
    }
    
    .status-badge.inactive {
        background: #F1F5F9;
        color: #94A3B8;
    }
    
    .status-dot {
        width: 6px;
        height: 6px;
        flex-shrink: 0;
    }
    
    .status-dot.active { background: #10B981; }
    .status-dot.inactive { background: #CBD5E1; }
    
    /* Count */
    .count-cell {
        text-align: center;
    }
    
    .count-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 26px;
        height: 22px;
        background: #F1F5F9;
        color: #475569;
        font-size: 11px;
        font-weight: 700;
        padding: 0 8px;
    }
    
    /* Actions */
    .action-group {
        display: flex;
        gap: 4px;
    }
    
    .action-btn {
        width: 30px;
        height: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #E2E8F0;
        background: #FFFFFF;
        cursor: pointer;
        transition: all 0.15s;
    }
    
    .action-btn:hover {
        background: #F8FAFC;
        border-color: #CBD5E1;
    }
    
    .action-btn.edit {
        color: #F59E0B;
    }
    
    .action-btn.edit:hover {
        background: #FFFBEB;
        border-color: #F59E0B;
    }
    
    .action-btn.delete {
        color: #EF4444;
    }
    
    .action-btn.delete:hover {
        background: #FEF2F2;
        border-color: #EF4444;
    }
    
    .action-btn svg {
        width: 14px;
        height: 14px;
    }
    
    /* Row number */
    .row-num {
        font-size: 11px;
        color: #94A3B8;
        font-weight: 600;
        text-align: center;
        width: 32px;
    }
    
    /* Empty State */
    .empty-wrap {
        text-align: center;
        padding: 64px 20px;
    }
    
    .empty-icon-box {
        width: 72px;
        height: 72px;
        background: #F1F5F9;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }
    
    .empty-icon-box svg {
        width: 30px;
        height: 30px;
        color: #94A3B8;
    }
    
    .empty-heading {
        font-size: 15px;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 4px;
    }
    
    .empty-text {
        font-size: 12px;
        color: #94A3B8;
        margin-bottom: 20px;
        font-weight: 500;
    }
    
    /* Header */
    .card-header-row {
        padding: 16px 20px;
        border-bottom: 1px solid #E2E8F0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .header-count {
        font-size: 12px;
        color: #64748B;
        font-weight: 500;
    }
    
    .header-count strong {
        color: #0F172A;
        font-weight: 700;
    }
    
    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #3B82F6;
        color: #FFFFFF;
        border: 1px solid #3B82F6;
        padding: 8px 16px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.15s;
    }
    
    .btn-add:hover {
        background: #2563EB;
        border-color: #2563EB;
        color: #FFFFFF;
    }
    
    .btn-add svg {
        width: 14px;
        height: 14px;
    }
    
    /* Table tweaks */
    .table tbody tr {
        transition: background 0.1s;
    }
    
    .table tbody tr:hover {
        background: #F8FAFC;
    }
    
    /* Pagination footer */
    .pagination-footer {
        padding: 14px 20px;
        border-top: 1px solid #E2E8F0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .pagination-info {
        font-size: 11px;
        color: #94A3B8;
        font-weight: 500;
    }
    
    @media (max-width: 768px) {
        .pagination-footer {
            flex-direction: column;
            gap: 10px;
        }
    }
</style>
@endpush

@section('content')
<div class="card" style="padding: 0;">
    <!-- Header -->
    <div class="card-header-row">
        <div class="header-count">
            Total: <strong>{{ $brands->total() }}</strong> brands
        </div>
        <a href="{{ route('brands.create') }}" class="btn-add">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Add Brand
        </a>
    </div>

    <!-- Table -->
    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 40px;">#</th>
                    <th>Brand</th>
                    <th style="width: 80px; text-align: center;">Products</th>
                    <th style="width: 110px;">Status</th>
                    <th style="width: 80px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($brands as $brand)
                    <tr>
                        <!-- Row Number -->
                        <td>
                            <div class="row-num">{{ $loop->iteration + ($brands->currentPage() - 1) * $brands->perPage() }}</div>
                        </td>
                        
                        <!-- Brand Name + Logo -->
                        <td>
                            <div class="brand-cell">
                                <div class="brand-logo">
                                    @if($brand->logo)
                                        <img src="{{ asset($brand->logo) }}" alt="{{ $brand->name }}">
                                    @else
                                        <span class="logo-letter">{{ strtoupper(substr($brand->name, 0, 1)) }}</span>
                                    @endif
                                </div>
                                <div class="brand-info">
                                    <div class="brand-info-name">{{ $brand->name }}</div>
                                    <div class="brand-info-slug">{{ $brand->slug }}</div>
                                    @if($brand->description)
                                        <div class="brand-info-desc">{{ Str::limit($brand->description, 40) }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        
                        <!-- Product Count -->
                        <td class="count-cell">
                            <span class="count-badge">{{ $brand->products_count ?? 0 }}</span>
                        </td>
                        
                        <!-- Status -->
                        <td>
                            <span class="status-badge {{ $brand->status ? 'active' : 'inactive' }}">
                                <span class="status-dot {{ $brand->status ? 'active' : 'inactive' }}"></span>
                                {{ $brand->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        
                        <!-- Actions -->
                        <td>
                            <div class="action-group">
                                <a href="{{ route('brands.edit', $brand) }}" class="action-btn edit" title="Edit">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </a>
                                <button onclick="confirmDelete('delete-brand-{{ $brand->id }}')" class="action-btn delete" title="Delete">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/>
                                    </svg>
                                </button>
                            </div>
                            <form id="delete-brand-{{ $brand->id }}" action="{{ route('brands.destroy', $brand) }}" method="POST" style="display: none;">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-wrap">
                                <div class="empty-icon-box">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <circle cx="7" cy="7" r="3"/>
                                        <circle cx="17" cy="7" r="3"/>
                                        <path d="M5 12l2 10h10l2-10"/>
                                    </svg>
                                </div>
                                <div class="empty-heading">No Brands Found</div>
                                <div class="empty-text">Add your first brand to get started</div>
                                <a href="{{ route('brands.create') }}" class="btn-add">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <path d="M12 5v14M5 12h14"/>
                                    </svg>
                                    Add First Brand
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($brands->hasPages())
        <div class="pagination-footer">
            <span class="pagination-info">
                Showing {{ $brands->firstItem() }} - {{ $brands->lastItem() }} of {{ $brands->total() }} brands
            </span>
            {{ $brands->links() }}
        </div>
    @endif
</div>
@endsection