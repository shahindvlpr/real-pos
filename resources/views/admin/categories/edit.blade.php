@extends('layouts.admin')

@section('title', 'Edit Category')
@section('page-title', 'Edit Category')
@section('page-subtitle', 'Update category information')

@push('styles')
<style>
    .form-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
    }

    .form-header {
        padding: 18px 24px;
        border-bottom: 1px solid #E2E8F0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-header-icon {
        width: 36px;
        height: 36px;
        background: #FEF3C7;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #F59E0B;
    }

    .form-header-icon svg {
        width: 18px;
        height: 18px;
    }

    .form-header-title {
        font-size: 14px;
        font-weight: 700;
        color: #0F172A;
    }

    .form-header-desc {
        font-size: 11px;
        color: #94A3B8;
        font-weight: 500;
    }

    .form-body {
        padding: 24px;
    }

    .form-section {
        margin-bottom: 20px;
    }

    .form-section:last-child {
        margin-bottom: 0;
    }

    .form-section-title {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: #64748B;
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 1px solid #F1F5F9;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .form-grid.full {
        grid-template-columns: 1fr;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-label {
        font-size: 12px;
        font-weight: 600;
        color: #334155;
    }

    .form-label .required {
        color: #EF4444;
        margin-left: 2px;
    }

    .form-input,
    .form-select,
    .form-textarea {
        padding: 9px 12px;
        border: 1px solid #E2E8F0;
        background: #FFFFFF;
        font-size: 13px;
        color: #0F172A;
        font-family: 'Inter', sans-serif;
        transition: all 0.15s;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #3B82F6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.08);
    }

    .form-input.error,
    .form-select.error,
    .form-textarea.error {
        border-color: #EF4444;
    }

    .form-textarea {
        resize: vertical;
        min-height: 80px;
    }

    .form-error {
        font-size: 11px;
        color: #EF4444;
        font-weight: 500;
    }

    .form-hint {
        font-size: 10px;
        color: #94A3B8;
        font-weight: 500;
    }

    /* Current Image */
    .current-image-section {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 14px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
    }

    .current-image-preview {
        width: 70px;
        height: 70px;
        border: 1px solid #E2E8F0;
        object-fit: cover;
        flex-shrink: 0;
    }

    .current-image-info {
        flex: 1;
    }

    .current-image-name {
        font-size: 12px;
        font-weight: 600;
        color: #0F172A;
        margin-bottom: 2px;
    }

    .current-image-meta {
        font-size: 10px;
        color: #94A3B8;
    }

    /* File Upload */
    .file-upload-area {
        border: 2px dashed #E2E8F0;
        padding: 32px;
        text-align: center;
        cursor: pointer;
        transition: all 0.15s;
        background: #F8FAFC;
        margin-top: 12px;
    }

    .file-upload-area:hover {
        border-color: #3B82F6;
        background: #EFF6FF;
    }

    .file-upload-area.has-file {
        border-color: #10B981;
        background: #F0FDF4;
    }

    .file-upload-icon {
        width: 40px;
        height: 40px;
        background: #F1F5F9;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }

    .file-upload-area:hover .file-upload-icon {
        background: #DBEAFE;
        color: #3B82F6;
    }

    .file-upload-icon svg {
        width: 18px;
        height: 18px;
        color: #64748B;
    }

    .file-upload-text {
        font-size: 12px;
        font-weight: 600;
        color: #475569;
    }

    .file-upload-hint {
        font-size: 10px;
        color: #94A3B8;
        margin-top: 4px;
    }

    .file-preview {
        margin-top: 12px;
        display: flex;
        gap: 8px;
    }

    .file-preview-item {
        width: 80px;
        height: 80px;
        border: 1px solid #E2E8F0;
        object-fit: cover;
    }

    /* Checkbox */
    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
    }

    .checkbox-input {
        width: 16px;
        height: 16px;
        accent-color: #3B82F6;
        cursor: pointer;
    }

    .checkbox-label {
        font-size: 12px;
        font-weight: 600;
        color: #334155;
        cursor: pointer;
    }

    /* Info Row */
    .info-row {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 10px 14px;
        background: #F0F9FF;
        border: 1px solid #BAE6FD;
    }

    .info-row-icon {
        width: 32px;
        height: 32px;
        background: #DBEAFE;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .info-row-icon svg {
        width: 16px;
        height: 16px;
        color: #3B82F6;
    }

    .info-row-text {
        font-size: 11px;
        color: #1E40AF;
        font-weight: 500;
    }

    .info-row-text strong {
        color: #1E3A8A;
    }

    /* Form Actions */
    .form-actions {
        padding: 16px 24px;
        border-top: 1px solid #E2E8F0;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        background: #F8FAFC;
    }

    .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 18px;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        color: #475569;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.15s;
    }

    .btn-cancel:hover {
        background: #F1F5F9;
        border-color: #CBD5E1;
    }

    .btn-update {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 18px;
        background: #F59E0B;
        border: 1px solid #F59E0B;
        color: #FFFFFF;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.15s;
    }

    .btn-update:hover {
        background: #D97706;
        border-color: #D97706;
    }

    .btn-cancel svg,
    .btn-update svg {
        width: 14px;
        height: 14px;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        .current-image-section {
            flex-direction: column;
            text-align: center;
        }
    }
    .col-lg-8 {
    width: 100%;
    padding: 0 10px;
}
</style>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="form-card">
                <!-- Header -->
                <div class="form-header">
                    <div class="form-header-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="form-header-title">Edit: {{ $category->name }}</div>
                        <div class="form-header-desc">Update the category information</div>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-body">
                        <!-- Category Info Alert -->
                        <div class="info-row" style="margin-bottom: 20px;">
                            <div class="info-row-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <line x1="12" y1="16" x2="12" y2="12"/>
                                    <line x1="12" y1="8" x2="12.01" y2="8"/>
                                </svg>
                            </div>
                            <div class="info-row-text">
                                Editing category: <strong>{{ $category->name }}</strong> ({{ $category->products_count ?? 0 }} products)
                            </div>
                        </div>

                        <!-- Basic Info Section -->
                        <div class="form-section">
                            <div class="form-section-title">Basic Information</div>
                            <div class="form-grid">
                                <div class="form-group full">
                                    <label class="form-label">
                                        Category Name <span class="required">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-input {{ $errors->has('name') ? 'error' : '' }}" 
                                           name="name" 
                                           value="{{ old('name', $category->name) }}" 
                                           placeholder="e.g. Electronics"
                                           required>
                                    @error('name')
                                        <span class="form-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group full">
                                    <label class="form-label">Parent Category</label>
                                    <select class="form-select {{ $errors->has('parent_id') ? 'error' : '' }}" name="parent_id">
                                        <option value="">None (Main Category)</option>
                                        @foreach($parentCategories as $parent)
                                            <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                                {{ $parent->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="form-hint">Cannot be the category itself</span>
                                    @error('parent_id')
                                        <span class="form-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group full">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-textarea {{ $errors->has('description') ? 'error' : '' }}" 
                                              name="description" 
                                              placeholder="Brief description of this category..."
                                              rows="3">{{ old('description', $category->description) }}</textarea>
                                    @error('description')
                                        <span class="form-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Current Image -->
                        @if($category->image)
                            <div class="form-section">
                                <div class="form-section-title">Current Image</div>
                                <div class="current-image-section">
                                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="current-image-preview">
                                    <div class="current-image-info">
                                        <div class="current-image-name">{{ basename($category->image) }}</div>
                                        <div class="current-image-meta">Upload a new image to replace this one</div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- New Image Section -->
                        <div class="form-section">
                            <div class="form-section-title">New Image (Optional)</div>
                            <div class="file-upload-area" id="fileUploadArea" onclick="document.getElementById('image').click()">
                                <div class="file-upload-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                                        <polyline points="17 8 12 3 7 8"/>
                                        <line x1="12" y1="3" x2="12" y2="15"/>
                                    </svg>
                                </div>
                                <div class="file-upload-text">Click to upload new image</div>
                                <div class="file-upload-hint">Leave empty to keep current image</div>
                            </div>
                            <input type="file" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*" 
                                   style="display: none;"
                                   onchange="handleFileSelect(event)">
                            <div class="file-preview" id="filePreview"></div>
                            @error('image')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Status Section -->
                        <div class="form-section">
                            <div class="form-section-title">Status</div>
                            <div class="checkbox-group">
                                <input type="checkbox" 
                                       class="checkbox-input" 
                                       id="status" 
                                       name="status" 
                                       {{ old('status', $category->status) ? 'checked' : '' }}>
                                <label class="checkbox-label" for="status">
                                    Active - Category will be visible in the system
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="form-actions">
                        <a href="{{ route('categories.index') }}" class="btn-cancel">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="18" y1="6" x2="6" y2="18"/>
                                <line x1="6" y1="6" x2="18" y2="18"/>
                            </svg>
                            Cancel
                        </a>
                        <button type="submit" class="btn-update">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            Update Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function handleFileSelect(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('filePreview');
        const uploadArea = document.getElementById('fileUploadArea');
        
        preview.innerHTML = '';
        
        if (file) {
            uploadArea.classList.add('has-file');
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
                    <div class="file-preview-item">
                        <img src="${e.target.result}" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                `;
            }
            reader.readAsDataURL(file);
        } else {
            uploadArea.classList.remove('has-file');
        }
    }
</script>
@endpush