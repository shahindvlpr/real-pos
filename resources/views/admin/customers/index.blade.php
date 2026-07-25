@extends('layouts.admin')

@section('title', 'Customers')
@section('page-title', 'Customers')
@section('page-subtitle', 'Manage your customers')

@push('styles')
<style>
    .customer-card {
        background: #FFF;
        border: 1px solid #E2E8F0;
        padding: 20px 24px;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: all 0.15s;
        margin-bottom: 8px;
    }
    
    .customer-card:hover {
        border-color: #3B82F6;
        box-shadow: 0 2px 12px rgba(59,130,246,0.08);
    }
    
    .customer-avatar {
        width: 48px;
        height: 48px;
        background: #EFF6FF;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 800;
        color: #3B82F6;
        flex-shrink: 0;
    }
    
    .customer-info {
        flex: 1;
        min-width: 0;
    }
    
    .customer-name {
        font-size: 14px;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 2px;
    }
    
    .customer-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    
    .customer-email {
        font-size: 11px;
        color: #64748B;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    
    .customer-phone {
        font-size: 11px;
        color: #64748B;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    
    .meta-icon {
        width: 12px;
        height: 12px;
        stroke: #94A3B8;
    }
    
    .customer-stats {
        display: flex;
        gap: 16px;
        margin-top: 6px;
    }
    
    .stat-item {
        font-size: 11px;
        font-weight: 600;
    }
    
    .stat-purchases {
        color: #10B981;
        background: #ECFDF5;
        padding: 2px 8px;
    }
    
    .stat-spent {
        color: #3B82F6;
        background: #EFF6FF;
        padding: 2px 8px;
    }
    
    .customer-status {
        text-align: right;
        flex-shrink: 0;
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 4px 10px;
        margin-bottom: 8px;
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
    
    .status-dot.active { background: #10B981; }
    .status-dot.inactive { background: #CBD5E1; }
    
    .action-group {
        display: flex;
        gap: 4px;
    }
    
    .action-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #E2E8F0;
        background: #FFF;
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
    
    /* Header */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }
    
    .page-stats {
        display: flex;
        gap: 16px;
    }
    
    .page-stat {
        font-size: 12px;
        color: #64748B;
    }
    
    .page-stat strong {
        color: #0F172A;
        font-weight: 700;
    }
    
    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #3B82F6;
        color: #FFF;
        border: 1px solid #3B82F6;
        padding: 9px 18px;
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
        color: #FFF;
    }
    
    .btn-add svg {
        width: 14px;
        height: 14px;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: #FFF;
        border: 1px solid #E2E8F0;
    }
    
    .empty-icon {
        width: 72px;
        height: 72px;
        background: #F1F5F9;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }
    
    .empty-icon svg {
        width: 32px;
        height: 32px;
        color: #94A3B8;
    }
    
    .empty-title {
        font-size: 16px;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 4px;
    }
    
    .empty-desc {
        font-size: 12px;
        color: #94A3B8;
        margin-bottom: 20px;
    }
    
    @media (max-width: 768px) {
        .customer-card {
            flex-direction: column;
            text-align: center;
        }
        .customer-status {
            text-align: center;
        }
        .customer-meta {
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<!-- Header -->
<div class="page-header">
    <div class="page-stats">
        <span class="page-stat">Total: <strong>{{ $customers->total() }}</strong> customers</span>
        <span class="page-stat">Active: <strong>{{ \App\Models\Customer::active()->count() }}</strong></span>
    </div>
    <a href="{{ route('customers.create') }}" class="btn-add">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <path d="M12 5v14M5 12h14"/>
        </svg>
        Add Customer
    </a>
</div>

<!-- Customer Cards -->
@forelse($customers as $customer)
    <div class="customer-card">
        <!-- Avatar -->
        <div class="customer-avatar">
            {{ strtoupper(substr($customer->name, 0, 1)) }}
        </div>
        
        <!-- Info -->
        <div class="customer-info">
            <div class="customer-name">{{ $customer->name }}</div>
            <div class="customer-meta">
                @if($customer->email)
                    <span class="customer-email">
                        <svg class="meta-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                        {{ $customer->email }}
                    </span>
                @endif
                @if($customer->phone)
                    <span class="customer-phone">
                        <svg class="meta-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
                        </svg>
                        {{ $customer->phone }}
                    </span>
                @endif
            </div>
            <div class="customer-stats">
                <span class="stat-item stat-purchases">{{ $customer->totalPurchases() }} purchases</span>
                @if($customer->totalSpent() > 0)
                    <span class="stat-item stat-spent">৳ {{ number_format($customer->totalSpent(), 2) }}</span>
                @endif
            </div>
        </div>
        
        <!-- Status + Actions -->
        <div class="customer-status">
            <span class="status-badge {{ $customer->status ? 'active' : 'inactive' }}">
                <span class="status-dot {{ $customer->status ? 'active' : 'inactive' }}"></span>
                {{ $customer->status ? 'Active' : 'Inactive' }}
            </span>
            <div class="action-group">
                <a href="{{ route('customers.edit', $customer) }}" class="action-btn edit" title="Edit">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                </a>
                <button onclick="confirmDelete('del-{{ $customer->id }}')" class="action-btn delete" title="Delete">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="3 6 5 6 21 6"/>
                        <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/>
                    </svg>
                </button>
            </div>
            <form id="del-{{ $customer->id }}" action="{{ route('customers.destroy', $customer) }}" method="POST" style="display:none;">
                @csrf @method('DELETE')
            </form>
        </div>
    </div>
@empty
    <div class="empty-state">
        <div class="empty-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                <path d="M16 3.13a4 4 0 010 7.75"/>
            </svg>
        </div>
        <div class="empty-title">No Customers Found</div>
        <div class="empty-desc">Start adding your customers to manage them easily</div>
        <a href="{{ route('customers.create') }}" class="btn-add">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Add First Customer
        </a>
    </div>
@endforelse

<!-- Pagination -->
@if($customers->hasPages())
    <div style="margin-top:16px; padding:14px 0;">
        {{ $customers->links() }}
    </div>
@endif
@endsection