@extends('layouts.admin')

@section('title', 'Categories')
@section('page-title', 'Categories')
@section('page-subtitle', 'Manage your product categories')

@push('styles')
<style>
    .category-icon {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        object-fit: cover;
    }
    .status-badge {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
    }
    .status-active {
        background: #10b981;
    }
    .status-inactive {
        background: #ef4444;
    }
    .parent-badge {
        background: #e0e7ff;
        color: #4338ca;
        padding: 2px 8px;
        border-radius: 5px;
        font-size: 0.75rem;
    }
    .child-badge {
        background: #fce7f3;
        color: #be185d;
        padding: 2px 8px;
        border-radius: 5px;
        font-size: 0.75rem;
    }
</style>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="table-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="mb-0">All Categories</h5>
                        <small class="text-muted">Total: {{ $categories->total() }} categories</small>
                    </div>
                    <a href="{{ route('categories.create') }}" class="btn btn-primary btn-custom">
                        <i class="bi bi-plus-lg"></i> Add New Category
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover datatable" id="categoriesTable">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="15%">Image</th>
                                <th>Name</th>
                                <th>Parent</th>
                                <th>Products</th>
                                <th>Status</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($category->image)
                                            <img src="{{ asset($category->image) }}" 
                                                 alt="{{ $category->name }}" 
                                                 class="category-icon">
                                        @else
                                            <div class="category-icon bg-light d-flex align-items-center justify-content-center">
                                                <i class="bi bi-folder text-muted" style="font-size: 1.5rem;"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $category->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $category->slug }}</small>
                                        @if($category->description)
                                            <br>
                                            <small class="text-muted">{{ Str::limit($category->description, 50) }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($category->parent)
                                            <span class="parent-badge">
                                                <i class="bi bi-arrow-up-circle"></i> {{ $category->parent->name }}
                                            </span>
                                        @else
                                            <span class="child-badge">
                                                <i class="bi bi-diagram-3"></i> Parent
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $category->products_count ?? 0 }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="status-badge {{ $category->status ? 'status-active' : 'status-inactive' }}"></span>
                                        {{ $category->status ? 'Active' : 'Inactive' }}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('categories.show', $category) }}" 
                                               class="btn btn-sm btn-info" 
                                               title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('categories.edit', $category) }}" 
                                               class="btn btn-sm btn-warning" 
                                               title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-danger" 
                                                    onclick="confirmDelete('delete-form-{{ $category->id }}')"
                                                    title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                        <form id="delete-form-{{ $category->id }}" 
                                              action="{{ route('categories.destroy', $category) }}" 
                                              method="POST" 
                                              class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                        <h5 class="mt-3 text-muted">No Categories Found</h5>
                                        <a href="{{ route('categories.create') }}" class="btn btn-primary mt-2">
                                            <i class="bi bi-plus-circle"></i> Add First Category
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection