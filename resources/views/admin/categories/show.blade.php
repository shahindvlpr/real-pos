@extends('layouts.admin')

@section('title', 'View Category')
@section('page-title', $category->name)
@section('page-subtitle', 'Category Details')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="table-card mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>Category Information</h5>
                    <div>
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-custom">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                    </div>
                </div>

                <table class="table table-bordered">
                    <tr>
                        <th width="150">Name</th>
                        <td>{{ $category->name }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $category->slug }}</td>
                    </tr>
                    <tr>
                        <th>Parent Category</th>
                        <td>
                            @if($category->parent)
                                <span class="badge bg-primary">{{ $category->parent->name }}</span>
                            @else
                                <span class="badge bg-secondary">None (Main Category)</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $category->description ?? 'No description' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge bg-{{ $category->status ? 'success' : 'danger' }}">
                                {{ $category->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td>
                            @if($category->image)
                                <img src="{{ asset($category->image) }}" 
                                     alt="{{ $category->name }}" 
                                     style="width: 200px; border-radius: 10px;">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $category->created_at->format('d M, Y h:i A') }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $category->updated_at->format('d M, Y h:i A') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Subcategories -->
            @if($category->children->count() > 0)
                <div class="table-card mb-4">
                    <h5>Subcategories ({{ $category->children->count() }})</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($category->children as $child)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $child->name }}
                                <a href="{{ route('categories.show', $child) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Products in this category -->
            <div class="table-card">
                <h5>Products ({{ $category->products->count() }})</h5>
                @if($category->products->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($category->products->take(5) as $product)
                            <li class="list-group-item">
                                {{ $product->name }}
                                <br>
                                <small class="text-muted">SKU: {{ $product->sku }}</small>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No products in this category</p>
                @endif
            </div>
        </div>
    </div>
@endsection