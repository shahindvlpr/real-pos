@extends('layouts.admin')

@section('title', 'View Category')
@section('page-title', $category->name)
@section('page-subtitle', 'Category Details')

@push('styles')
<style>
    /* ========== DETAIL CARD ========== */
    .detail-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        margin-bottom: 16px;
    }

    .detail-header {
        padding: 16px 20px;
        border-bottom: 1px solid #E2E8F0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .detail-header-title {
        font-size: 13px;
        font-weight: 700;
        color: #0F172A;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .detail-header-badge {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 3px 10px;
    }

    .detail-body {
        padding: 0;
    }

    .detail-row {
        display: flex;
        border-bottom: 1px solid #F1F5F9;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        width: 160px;
        padding: 12px 20px;
        background: #F8FAFC;
        font-size: 11px;
        font-weight: 600;
        color: #64748B;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        flex-shrink: 0;
        border-right: 1px solid #E2E8F0;
    }

    .detail-value {
        flex: 1;
        padding: 12px 20px;
        font-size: 13px;
        color: #0F172A;
        font-weight: 500;
    }

    .detail-image {
        width: 200px;
        border: 1px solid #E2E8F0;
        object-fit: cover;
    }

    /* Tags */
    .tag {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 3px 10px;
    }

    .tag-blue {
        background: #EFF6FF;
        color: #1D4ED8;
    }

    .tag-slate {
        background: #F1F5F9;
        color: #475569;
    }

    .tag-green {
        background: #F0FDF4;
        color: #166534;
    }

    .tag-red {
        background: #FEF2F2;
        color: #991B1B;
    }

    .tag svg {
        width: 10px;
        height: 10px;
    }

    /* ========== SIDEBAR CARDS ========== */
    .side-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        margin-bottom: 16px;
    }

    .side-card-header {
        padding: 14px 18px;
        border-bottom: 1px solid #E2E8F0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .side-card-title {
        font-size: 11px;
        font-weight: 700;
        color: #0F172A;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .side-card-count {
        font-size: 11px;
        font-weight: 700;
        color: #64748B;
        background: #F1F5F9;
        padding: 2px 10px;
    }

    .side-card-body {
        padding: 0;
    }

    .side-list-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 18px;
        border-bottom: 1px solid #F8FAFC;
        transition: background 0.1s;
    }

    .side-list-item:last-child {
        border-bottom: none;
    }

    .side-list-item:hover {
        background: #F8FAFC;
    }

    .side-list-name {
        font-size: 12px;
        font-weight: 500;
        color: #334155;
    }

    .side-list-meta {
        font-size: 10px;
        color: #94A3B8;
        margin-top: 1px;
    }

    .side-list-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border: 1px solid #E2E8F0;
        color: #0EA5E9;
        transition: all 0.15s;
        flex-shrink: 0;
    }

    .side-list-link:hover {
        background: #F0F9FF;
        border-color: #0EA5E9;
    }

    .side-list-link svg {
        width: 13px;
        height: 13px;
    }

    .side-empty {
        padding: 24px 18px;
        text-align: center;
        font-size: 12px;
        color: #94A3B8;
        font-weight: 500;
    }

    /* ========== ACTION BUTTONS ========== */
    .btn-edit {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 16px;
        background: #F59E0B;
        border: 1px solid #F59E0B;
        color: #FFFFFF;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.15s;
    }

    .btn-edit:hover {
        background: #D97706;
        border-color: #D97706;
        color: #FFFFFF;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 16px;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        color: #475569;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.15s;
    }

    .btn-back:hover {
        background: #F1F5F9;
        border-color: #CBD5E1;
    }

    .btn-edit svg,
    .btn-back svg {
        width: 13px;
        height: 13px;
    }

    @media (max-width: 768px) {
        .detail-row {
            flex-direction: column;
        }
        .detail-label {
            width: 100%;
            border-right: none;
            border-bottom: 1px solid #E2E8F0;
        }
    }
</style>
@endpush

@section('content')
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Category Info -->
            <div class="detail-card">
                <div class="detail-header">
                    <span class="detail-header-title">Category Information</span>
                    <div style="display: flex; gap: 8px;">
                        <a href="{{ route('categories.index') }}" class="btn-back">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="19" y1="12" x2="5" y2="12"/>
                                <polyline points="12 19 5 12 12 5"/>
                            </svg>
                            Back
                        </a>
                        <a href="{{ route('categories.edit', $category) }}" class="btn-edit">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                            Edit
                        </a>
                    </div>
                </div>
                <div class="detail-body">
                    <div class="detail-row">
                        <div class="detail-label">Name</div>
                        <div class="detail-value" style="font-weight: 700;">{{ $category->name }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Slug</div>
                        <div class="detail-value" style="font-family: monospace; font-size: 12px; color: #64748B;">{{ $category->slug }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Parent</div>
                        <div class="detail-value">
                            @if($category->parent)
                                <span class="tag tag-blue">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <polyline points="15 18 9 12 15 6"/>
                                    </svg>
                                    {{ $category->parent->name }}
                                </span>
                            @else
                                <span class="tag tag-slate">Main Category</span>
                            @endif
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Description</div>
                        <div class="detail-value">{{ $category->description ?: 'No description provided' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Status</div>
                        <div class="detail-value">
                            @if($category->status)
                                <span class="tag tag-green">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                    Active
                                </span>
                            @else
                                <span class="tag tag-red">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <line x1="18" y1="6" x2="6" y2="18"/>
                                        <line x1="6" y1="6" x2="18" y2="18"/>
                                    </svg>
                                    Inactive
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Image</div>
                        <div class="detail-value">
                            @if($category->image)
                                <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="detail-image">
                            @else
                                <div style="width: 120px; height: 80px; background: #F8FAFC; border: 1px solid #E2E8F0; display: flex; align-items: center; justify-content: center;">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="1.5">
                                        <rect x="3" y="3" width="18" height="18" rx="0"/>
                                        <circle cx="8.5" cy="8.5" r="1.5"/>
                                        <polyline points="21 15 16 10 5 21"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Created</div>
                        <div class="detail-value">{{ $category->created_at->format('d M, Y - h:i A') }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Updated</div>
                        <div class="detail-value">{{ $category->updated_at->format('d M, Y - h:i A') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Subcategories -->
            <div class="side-card">
                <div class="side-card-header">
                    <span class="side-card-title">Subcategories</span>
                    <span class="side-card-count">{{ $category->children->count() }}</span>
                </div>
                <div class="side-card-body">
                    @forelse($category->children as $child)
                        <div class="side-list-item">
                            <div>
                                <div class="side-list-name">{{ $child->name }}</div>
                                <div class="side-list-meta">{{ $child->products_count ?? 0 }} products</div>
                            </div>
                            <a href="{{ route('categories.show', $child) }}" class="side-list-link" title="View">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </a>
                        </div>
                    @empty
                        <div class="side-empty">No subcategories</div>
                    @endforelse
                </div>
            </div>

            <!-- Products -->
            <div class="side-card">
                <div class="side-card-header">
                    <span class="side-card-title">Products</span>
                    <span class="side-card-count">{{ $category->products->count() }}</span>
                </div>
                <div class="side-card-body">
                    @forelse($category->products->take(5) as $product)
                        <div class="side-list-item">
                            <div>
                                <div class="side-list-name">{{ $product->name }}</div>
                                <div class="side-list-meta">SKU: {{ $product->sku ?: 'N/A' }}</div>
                            </div>
                            <span class="side-list-link" style="border-color: transparent; cursor: default;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2">
                                    <polygon points="12 2 22 8 12 14 2 8 12 2"/>
                                </svg>
                            </span>
                        </div>
                    @empty
                        <div class="side-empty">No products in this category</div>
                    @endforelse
                </div>
            </div>

            <!-- Quick Info -->
            <div class="side-card">
                <div class="side-card-header">
                    <span class="side-card-title">Quick Info</span>
                </div>
                <div class="side-card-body">
                    <div class="side-list-item">
                        <span class="side-list-name">Total Items</span>
                        <span style="font-size: 12px; font-weight: 700; color: #0F172A;">{{ $category->products_count ?? 0 }}</span>
                    </div>
                    <div class="side-list-item">
                        <span class="side-list-name">Subcategories</span>
                        <span style="font-size: 12px; font-weight: 700; color: #0F172A;">{{ $category->children->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection