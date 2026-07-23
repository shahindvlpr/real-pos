@extends('layouts.admin')

@section('title', 'Create Category')
@section('page-title', 'Add New Category')
@section('page-subtitle', 'Create a new product category')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="table-card">
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <!-- Category Name -->
                        <div class="col-md-12">
                            <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   placeholder="Enter category name"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Parent Category -->
                        <div class="col-md-12">
                            <label for="parent_id" class="form-label">Parent Category</label>
                            <select class="form-select @error('parent_id') is-invalid @enderror" 
                                    id="parent_id" 
                                    name="parent_id">
                                <option value="">None (Main Category)</option>
                                @foreach($parentCategories as $parent)
                                    <option value="{{ $parent->id }}" 
                                            {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3" 
                                      placeholder="Enter category description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category Image -->
                        <div class="col-md-12">
                            <label for="image" class="form-label">Category Image</label>
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*">
                            <small class="text-muted">Allowed: JPG, JPEG, PNG, GIF, WebP (Max: 2MB)</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <!-- Image Preview -->
                            <div class="mt-2" id="imagePreview"></div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="status" 
                                       name="status" 
                                       {{ old('status', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">
                                    Active
                                </label>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="col-md-12">
                            <hr>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('categories.index') }}" class="btn btn-light btn-custom">
                                    <i class="bi bi-x-circle"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary btn-custom">
                                    <i class="bi bi-check-circle"></i> Save Category
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Image preview
    document.getElementById('image').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = '';
        
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
                    <img src="${e.target.result}" 
                         alt="Preview" 
                         style="width: 150px; height: 150px; object-fit: cover; border-radius: 10px;">
                `;
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endpush