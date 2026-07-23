@extends('layouts.admin')

@section('title', 'Categories')
@section('page-title', 'Categories')
@section('page-subtitle', 'Manage your product categories')

@push('styles')
<style>
    /* ========== CATEGORY TABLE ========== */
    .category-image {
        width: 44px;
        height: 44px;
        object-fit: cover;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .category-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .category-name {
        font-size: 13px;
        font-weight: 600;
        color: #0F172A;
        line-height: 1.2;
    }

    .category-slug {
        font-size: 10px;
        color: #94A3B8;
        font-weight: 500;
        letter-spacing: 0.3px;
    }

    .category-desc {
        font-size: 11px;
        color: #64748B;
        margin-top: 2px;
        line-height: 1.4;
    }

    /* Status Indicator */
    .status-indicator {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        font-weight: 600;
    }

    .status-dot {
        width: 7px;
        height: 7px;
        flex-shrink: 0;
    }

    .status-dot.active { background: #10B981; }
    .status-dot.inactive { background: #CBD5E1; }

    .status-text {
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-text.active { color: #059669; }
    .status-text.inactive { color: #94A3B8; }

    /* Parent/Child Tag */
    .tag {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 10px;
        font-weight: 700;
        padding: 3px 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .tag-parent {
        background: #EFF6FF;
        color: #1D4ED8;
    }

    .tag-root {
        background: #FDF2F8;
        color: #BE185D;
    }

    .tag svg {
        width: 10px;
        height: 10px;
    }

    /* Product Count */
    .count-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 28px;
        height: 22px;
        background: #F1F5F9;
        color: #475569;
        font-size: 11px;
        font-weight: 700;
        padding: 0 8px;
    }

    /* Action Buttons */
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
        flex-shrink: 0;
    }

    .action-btn:hover {
        background: #F8FAFC;
        border-color: #CBD5E1;
    }

    .action-btn.view { color: #0EA5E9; }
    .action-btn.view:hover { background: #F0F9FF; border-color: #0EA5E9; }
    .action-btn.edit { color: #F59E0B; }
    .action-btn.edit:hover { background: #FFFBEB; border-color: #F59E0B; }
    .action-btn.delete { color: #EF4444; }
    .action-btn.delete:hover { background: #FEF2F2; border-color: #EF4444; }

    .action-btn svg {
        width: 14px;
        height: 14px;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-icon {
        width: 64px;
        height: 64px;
        background: #F1F5F9;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }

    .empty-icon svg {
        width: 28px;
        height: 28px;
        color: #94A3B8;
    }

    .empty-title {
        font-size: 15px;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 4px;
    }

    .empty-desc {
        font-size: 12px;
        color: #94A3B8;
        margin-bottom: 16px;
    }

    /* Table Hover */
    .table tbody tr {
        transition: background 0.1s;
    }

    .table tbody tr:hover {
        background: #F8FAFC;
    }

    /* Header Actions */
    .header-actions {
        display: flex;
        align-items: center;
        gap: 10px;
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
        transition: all 0.15s;
        text-decoration: none;
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

    .total-count {
        font-size: 11px;
        color: #94A3B8;
        font-weight: 500;
    }

    .total-count strong {
        color: #0F172A;
        font-weight: 700;
    }
    /* ========== PAGINATION ========== */
.pagination {
    display: flex;
    gap: 2px;
    list-style: none;
    padding: 0;
    margin: 0;
}

.pagination li {
    display: inline-flex;
}

.pagination li a,
.pagination li span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 32px;
    height: 32px;
    padding: 0 10px;
    border: 1px solid #E2E8F0;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    color: #475569;
    background: #FFFFFF;
    transition: all 0.1s;
}

.pagination li a:hover {
    background: #F1F5F9;
    border-color: #CBD5E1;
    color: #0F172A;
}

.pagination li.active span {
    background: #3B82F6;
    border-color: #3B82F6;
    color: #FFFFFF;
}

.pagination li.disabled span {
    color: #CBD5E1;
    background: #F8FAFC;
    cursor: not-allowed;
}

/* Arrow-specific: smaller width */
.pagination li:first-child a,
.pagination li:first-child span,
.pagination li:last-child a,
.pagination li:last-child span {
    min-width: 32px;
    padding: 0 8px;
    font-size: 14px;
    font-weight: 700;
}

/* SVG arrows inside pagination */
.pagination svg {
    width: 14px;
    height: 14px;
}

/* Hide default pagination images if any */
.pagination img {
    display: none;
}
</style>
@endpush

@section('content')
    <div class="card" style="padding: 0;">
        <!-- Card Header -->
        <div style="padding: 18px 20px; border-bottom: 1px solid #E2E8F0; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <span class="total-count">
                    Total: <strong>{{ $categories->total() }}</strong> categories
                </span>
            </div>
            <div class="header-actions">
                <a href="{{ route('categories.create') }}" class="btn-add">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Add Category
                </a>
            </div>
        </div>

        <!-- Table -->
        <div style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th style="width: 60px;">Image</th>
                        <th>Category</th>
                        <th>Parent</th>
                        <th style="width: 80px;">Items</th>
                        <th style="width: 100px;">Status</th>
                        <th style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>
                                <span style="font-size: 11px; color: #94A3B8; font-weight: 600;">
                                    {{ $loop->iteration }}
                                </span>
                            </td>
                            <td>
                                <div class="category-image">
                                    @if($category->image)
                                        <img src="{{ asset($category->image) }}" alt="{{ $category->name }}">
                                    @else
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="1.5">
                                            <path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                                        </svg>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="category-name">{{ $category->name }}</div>
                                <div class="category-slug">{{ $category->slug }}</div>
                                @if($category->description)
                                    <div class="category-desc">{{ Str::limit($category->description, 45) }}</div>
                                @endif
                            </td>
                            <td>
                                @if($category->parent)
                                    <span class="tag tag-parent">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <polyline points="15 18 9 12 15 6"/>
                                        </svg>
                                        {{ $category->parent->name }}
                                    </span>
                                @else
                                    <span class="tag tag-root">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <rect x="3" y="3" width="7" height="7"/>
                                            <rect x="14" y="3" width="7" height="7"/>
                                            <rect x="3" y="14" width="7" height="7"/>
                                            <rect x="14" y="14" width="7" height="7"/>
                                        </svg>
                                        Main
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="count-badge">
                                    {{ $category->products_count ?? 0 }}
                                </span>
                            </td>
                            <td>
                                <div class="status-indicator">
                                    <span class="status-dot {{ $category->status ? 'active' : 'inactive' }}"></span>
                                    <span class="status-text {{ $category->status ? 'active' : 'inactive' }}">
                                        {{ $category->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div style="display: flex; gap: 4px;">
                                    <a href="{{ route('categories.show', $category) }}" class="action-btn view" title="View">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('categories.edit', $category) }}" class="action-btn edit" title="Edit">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                            <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                        </svg>
                                    </a>
                                    <button onclick="confirmDelete('delete-form-{{ $category->id }}')" class="action-btn delete" title="Delete">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/>
                                        </svg>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                                        </svg>
                                    </div>
                                    <div class="empty-title">No Categories Found</div>
                                    <div class="empty-desc">Start by adding your first product category</div>
                                    <a href="{{ route('categories.create') }}" class="btn-add">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <path d="M12 5v14M5 12h14"/>
                                        </svg>
                                        Add First Category
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($categories->hasPages())
            <div style="padding: 14px 20px; border-top: 1px solid #E2E8F0; display: flex; justify-content: space-between; align-items: center;">
                <div style="font-size: 11px; color: #94A3B8; font-weight: 500;">
                    Showing {{ $categories->firstItem() }} - {{ $categories->lastItem() }} of {{ $categories->total() }}
                </div>
                <div>
                    {{ $categories->links() }}
                </div>
            </div>
        @endif
    </div>
@endsection