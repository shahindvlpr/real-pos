@extends('layouts.admin')

@section('title', 'Units')
@section('page-title', 'Units')
@section('page-subtitle', 'Manage product measurement units')

@push('styles')
<style>
    .unit-code {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 44px;
        height: 28px;
        background: #EFF6FF;
        color: #1D4ED8;
        font-size: 12px;
        font-weight: 700;
        padding: 0 10px;
        letter-spacing: 0.5px;
    }
    .unit-name {
        font-size: 13px;
        font-weight: 600;
        color: #0F172A;
        line-height: 1.2;
    }
    .unit-desc {
        font-size: 11px;
        color: #64748B;
        margin-top: 1px;
    }
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
    .status-badge.active { background: #ECFDF5; color: #059669; }
    .status-badge.inactive { background: #F1F5F9; color: #94A3B8; }
    .status-dot { width: 6px; height: 6px; }
    .status-dot.active { background: #10B981; }
    .status-dot.inactive { background: #CBD5E1; }
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
    .action-btn {
        width: 30px; height: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #E2E8F0;
        background: #FFFFFF;
        cursor: pointer;
        transition: all 0.15s;
    }
    .action-btn:hover { background: #F8FAFC; border-color: #CBD5E1; }
    .action-btn.edit { color: #F59E0B; }
    .action-btn.edit:hover { background: #FFFBEB; border-color: #F59E0B; }
    .action-btn.delete { color: #EF4444; }
    .action-btn.delete:hover { background: #FEF2F2; border-color: #EF4444; }
    .action-btn svg { width: 14px; height: 14px; }
    .empty-wrap { text-align: center; padding: 64px 20px; }
    .empty-icon-box {
        width: 72px; height: 72px;
        background: #F1F5F9;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }
    .empty-icon-box svg { width: 30px; height: 30px; color: #94A3B8; }
    .empty-heading { font-size: 15px; font-weight: 700; color: #0F172A; margin-bottom: 4px; }
    .empty-text { font-size: 12px; color: #94A3B8; margin-bottom: 20px; }
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
        text-decoration: none;
    }
    .btn-add:hover { background: #2563EB; border-color: #2563EB; color: #FFFFFF; }
    .btn-add svg { width: 14px; height: 14px; }
    .card-header-row {
        padding: 16px 20px;
        border-bottom: 1px solid #E2E8F0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .header-count { font-size: 12px; color: #64748B; font-weight: 500; }
    .header-count strong { color: #0F172A; font-weight: 700; }
    .pagination-footer {
        padding: 14px 20px;
        border-top: 1px solid #E2E8F0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .pagination-info { font-size: 11px; color: #94A3B8; font-weight: 500; }
    .table tbody tr { transition: background 0.1s; }
    .table tbody tr:hover { background: #F8FAFC; }
    .row-num { font-size: 11px; color: #94A3B8; font-weight: 600; }
</style>
@endpush

@section('content')
<div class="card" style="padding: 0;">
    <div class="card-header-row">
        <span class="header-count">Total: <strong>{{ $units->total() }}</strong> units</span>
        <a href="{{ route('units.create') }}" class="btn-add">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Add Unit
        </a>
    </div>

    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 40px;">#</th>
                    <th>Unit</th>
                    <th style="width: 100px; text-align: center;">Products</th>
                    <th style="width: 110px;">Status</th>
                    <th style="width: 80px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($units as $unit)
                    <tr>
                        <td><span class="row-num">{{ $loop->iteration + ($units->currentPage() - 1) * $units->perPage() }}</span></td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <span class="unit-code">{{ $unit->code }}</span>
                                <div>
                                    <div class="unit-name">{{ $unit->name }}</div>
                                    @if($unit->description)
                                        <div class="unit-desc">{{ Str::limit($unit->description, 40) }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td style="text-align: center;">
                            <span class="count-badge">{{ $unit->products_count ?? 0 }}</span>
                        </td>
                        <td>
                            <span class="status-badge {{ $unit->status ? 'active' : 'inactive' }}">
                                <span class="status-dot {{ $unit->status ? 'active' : 'inactive' }}"></span>
                                {{ $unit->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 4px;">
                                <a href="{{ route('units.edit', $unit) }}" class="action-btn edit" title="Edit">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </a>
                                <button onclick="confirmDelete('delete-unit-{{ $unit->id }}')" class="action-btn delete" title="Delete">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/>
                                    </svg>
                                </button>
                            </div>
                            <form id="delete-unit-{{ $unit->id }}" action="{{ route('units.destroy', $unit) }}" method="POST" style="display: none;">
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
                                        <path d="M3 7h18v4H3zM5 11v11h14V11"/>
                                    </svg>
                                </div>
                                <div class="empty-heading">No Units Found</div>
                                <div class="empty-text">Add measurement units like Piece, Kg, Box etc.</div>
                                <a href="{{ route('units.create') }}" class="btn-add">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <path d="M12 5v14M5 12h14"/>
                                    </svg>
                                    Add First Unit
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($units->hasPages())
        <div class="pagination-footer">
            <span class="pagination-info">Showing {{ $units->firstItem() }} - {{ $units->lastItem() }} of {{ $units->total() }} units</span>
            {{ $units->links() }}
        </div>
    @endif
</div>
@endsection