@extends('layouts.admin')

@section('title', 'Suppliers')
@section('page-title', 'Suppliers')
@section('page-subtitle', 'Manage your suppliers')

@push('styles')
<style>
    /* Header */
    .page-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }
    
    .page-stats {
        display: flex;
        gap: 16px;
        font-size: 12px;
        color: #64748B;
    }
    
    .page-stats strong {
        color: #0F172A;
        font-weight: 700;
    }
    
    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #3B82F6;
        color: #FFF;
        border: 1px solid #3B82F6;
        padding: 10px 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .btn-add:hover {
        background: #2563EB;
        border-color: #2563EB;
        color: #FFF;
    }
    
    .btn-add svg {
        width: 14px;
        height: 14px;
    }

    /* Supplier Card */
    .supplier-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        padding: 20px 24px;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: all 0.2s ease;
        margin-bottom: 8px;
        position: relative;
        overflow: hidden;
    }

    .supplier-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 3px;
        height: 100%;
        background: #E2E8F0;
        transition: all 0.2s;
    }

    .supplier-card:hover {
        border-color: #3B82F6;
        box-shadow: 0 4px 16px rgba(59, 130, 246, 0.06);
        transform: translateX(2px);
    }

    .supplier-card:hover::before {
        background: #3B82F6;
    }

    /* Avatar */
    .supplier-avatar {
        width: 48px;
        height: 48px;
        background: #FFFBEB;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 800;
        color: #F59E0B;
        flex-shrink: 0;
        position: relative;
    }
    
    .supplier-avatar.active-avatar {
        background: #ECFDF5;
        color: #10B981;
    }

    /* Info */
    .supplier-info {
        flex: 1;
        min-width: 0;
    }

    .supplier-name {
        font-size: 14px;
        font-weight: 700;
        color: #0F172A;
        line-height: 1.2;
    }

    .supplier-company {
        font-size: 11px;
        color: #64748B;
        font-weight: 600;
        letter-spacing: 0.2px;
    }

    .supplier-meta {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
        margin-top: 6px;
    }

    .meta-item {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        color: #64748B;
        font-weight: 500;
        transition: color 0.15s;
    }

    .meta-item:hover {
        color: #3B82F6;
    }

    .meta-icon {
        width: 13px;
        height: 13px;
        stroke: currentColor;
        flex-shrink: 0;
    }

    .meta-divider {
        width: 3px;
        height: 3px;
        background: #CBD5E1;
    }

    /* Tax Badge */
    .tax-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 10px;
        font-weight: 600;
        background: #F1F5F9;
        color: #475569;
        padding: 2px 8px;
    }

    /* Right Section */
    .supplier-right {
        text-align: right;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 10px;
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
        padding: 4px 12px;
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
    }

    .status-dot.active {
        background: #10B981;
        box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
    }

    .status-dot.inactive {
        background: #CBD5E1;
    }

    /* Actions */
    .action-group {
        display: flex;
        gap: 6px;
    }

    .action-btn {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #E2E8F0;
        background: #FFFFFF;
        cursor: pointer;
        transition: all 0.15s;
    }

    .action-btn:hover {
        transform: translateY(-1px);
    }

    .action-btn.edit {
        color: #F59E0B;
    }

    .action-btn.edit:hover {
        background: #FFFBEB;
        border-color: #F59E0B;
        box-shadow: 0 2px 8px rgba(245, 158, 11, 0.1);
    }

    .action-btn.delete {
        color: #EF4444;
    }

    .action-btn.delete:hover {
        background: #FEF2F2;
        border-color: #EF4444;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.1);
    }

    .action-btn svg {
        width: 14px;
        height: 14px;
    }

    /* Location Badge */
    .location-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 10px;
        color: #64748B;
        font-weight: 500;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: #FFF;
        border: 1px solid #E2E8F0;
    }

    .empty-icon-box {
        width: 80px;
        height: 80px;
        background: #F8FAFC;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .empty-icon-box svg {
        width: 36px;
        height: 36px;
        color: #94A3B8;
    }

    .empty-title {
        font-size: 16px;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 6px;
    }

    .empty-desc {
        font-size: 12px;
        color: #94A3B8;
        margin-bottom: 24px;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .supplier-card {
            flex-direction: column;
            text-align: center;
        }
        .supplier-right {
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .supplier-meta {
            justify-content: center;
        }
        .supplier-card::before {
            width: 100%;
            height: 3px;
        }
    }
</style>
@endpush

@section('content')
<!-- Toolbar -->
<div class="page-toolbar">
    <div class="page-stats">
        <span>Total: <strong>{{ $suppliers->total() }}</strong></span>
        <span>|</span>
        <span>Active: <strong>{{ \App\Models\Supplier::active()->count() }}</strong></span>
    </div>
    <a href="{{ route('suppliers.create') }}" class="btn-add">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <path d="M12 5v14M5 12h14"/>
        </svg>
        Add Supplier
    </a>
</div>

<!-- Supplier Cards -->
@forelse($suppliers as $supplier)
    <div class="supplier-card">
        <!-- Avatar -->
        <div class="supplier-avatar {{ $supplier->status ? 'active-avatar' : '' }}">
            {{ strtoupper(substr($supplier->name, 0, 1)) }}
        </div>

        <!-- Info -->
        <div class="supplier-info">
            <div class="supplier-name">{{ $supplier->name }}</div>
            @if($supplier->company_name)
                <div class="supplier-company">{{ $supplier->company_name }}</div>
            @endif
            <div class="supplier-meta">
                @if($supplier->email)
                    <span class="meta-item">
                        <svg class="meta-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                        {{ $supplier->email }}
                    </span>
                @endif
                @if($supplier->phone)
                    <span class="meta-item">
                        <svg class="meta-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
                        </svg>
                        {{ $supplier->phone }}
                    </span>
                @endif
                @if($supplier->tax_number)
                    <span class="tax-badge">{{ $supplier->tax_number }}</span>
                @endif
            </div>
            @if($supplier->city)
                <div style="margin-top:6px;">
                    <span class="location-badge">
                        <svg class="meta-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        {{ $supplier->city }}{{ $supplier->country ? ', ' . $supplier->country : '' }}
                    </span>
                </div>
            @endif
        </div>

        <!-- Status & Actions -->
        <div class="supplier-right">
            <span class="status-badge {{ $supplier->status ? 'active' : 'inactive' }}">
                <span class="status-dot {{ $supplier->status ? 'active' : 'inactive' }}"></span>
                {{ $supplier->status ? 'Active' : 'Inactive' }}
            </span>
            <div class="action-group">
                <a href="{{ route('suppliers.edit', $supplier) }}" class="action-btn edit" title="Edit">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                </a>
                <button onclick="confirmDelete('del-{{ $supplier->id }}')" class="action-btn delete" title="Delete">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="3 6 5 6 21 6"/>
                        <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/>
                    </svg>
                </button>
            </div>
            <form id="del-{{ $supplier->id }}" action="{{ route('suppliers.destroy', $supplier) }}" method="POST" style="display:none;">
                @csrf @method('DELETE')
            </form>
        </div>
    </div>
@empty
    <div class="empty-state">
        <div class="empty-icon-box">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <rect x="1" y="3" width="15" height="13"/>
                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                <circle cx="5.5" cy="18.5" r="2.5"/>
                <circle cx="18.5" cy="18.5" r="2.5"/>
            </svg>
        </div>
        <div class="empty-title">No Suppliers Found</div>
        <div class="empty-desc">Start building your supply chain by adding your first supplier</div>
        <a href="{{ route('suppliers.create') }}" class="btn-add">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Add First Supplier
        </a>
    </div>
@endforelse

<!-- Pagination -->
@if($suppliers->hasPages())
    <div style="margin-top: 16px; padding: 8px 0;">
        {{ $suppliers->links() }}
    </div>
@endif
@endsection