@extends('layouts.admin')

@section('title', 'Edit Brand')
@section('page-title', 'Edit Brand')
@section('page-subtitle', 'Update brand information')

@push('styles')
<style>
    .form-wrapper {
        margin: 0 auto;
        width: 100%;
    }
    
    .form-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
    }
    
    .form-header {
        padding: 20px 28px;
        border-bottom: 1px solid #E2E8F0;
        display: flex;
        align-items: center;
        gap: 14px;
    }
    
    .form-header-icon {
        width: 42px;
        height: 42px;
        background: #FEF3C7;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .form-header-icon svg {
        width: 20px;
        height: 20px;
        stroke: #F59E0B;
    }
    
    .form-header-title {
        font-size: 15px;
        font-weight: 700;
        color: #0F172A;
        line-height: 1.2;
    }
    
    .form-header-subtitle {
        font-size: 11px;
        color: #94A3B8;
        font-weight: 500;
        margin-top: 1px;
    }
    
    .form-body {
        padding: 28px;
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    
    .form-grid .full-width {
        grid-column: 1 / -1;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    
    .form-label {
        font-size: 11px;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }
    
    .form-label .required {
        color: #EF4444;
    }
    
    .form-input,
    .form-select,
    .form-textarea {
        padding: 10px 14px;
        border: 1px solid #E2E8F0;
        background: #FFFFFF;
        font-size: 13px;
        color: #0F172A;
        font-family: 'Inter', sans-serif;
        transition: all 0.15s;
        width: 100%;
    }
    
    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #3B82F6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.08);
    }
    
    .form-textarea {
        resize: vertical;
        min-height: 90px;
    }
    
    .form-hint {
        font-size: 10px;
        color: #94A3B8;
        font-weight: 500;
    }
    
    /* Info Alert */
    .info-alert {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        background: #EFF6FF;
        border: 1px solid #BFDBFE;
        margin-bottom: 24px;
    }
    
    .info-alert-icon {
        width: 32px;
        height: 32px;
        background: #DBEAFE;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .info-alert-icon svg {
        width: 16px;
        height: 16px;
        stroke: #3B82F6;
    }
    
    .info-alert-text {
        font-size: 12px;
        color: #1E40AF;
        font-weight: 500;
    }
    
    .info-alert-text strong {
        color: #1E3A8A;
        font-weight: 700;
    }
    
    /* Current Logo */
    .current-logo-box {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 18px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
    }
    
    .current-logo-img {
        width: 52px;
        height: 52px;
        border: 1px solid #E2E8F0;
        object-fit: cover;
        flex-shrink: 0;
        background: #FFFFFF;
    }
    
    .current-logo-info {
        flex: 1;
    }
    
    .current-logo-name {
        font-size: 12px;
        font-weight: 600;
        color: #0F172A;
        margin-bottom: 2px;
    }
    
    .current-logo-hint {
        font-size: 10px;
        color: #94A3B8;
        font-weight: 500;
    }
    
    /* File Upload */
    .file-upload-box {
        border: 2px dashed #E2E8F0;
        padding: 36px 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.15s;
        background: #FAFBFC;
    }
    
    .file-upload-box:hover {
        border-color: #3B82F6;
        background: #EFF6FF;
    }
    
    .file-upload-icon {
        width: 44px;
        height: 44px;
        background: #F1F5F9;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 12px;
        transition: all 0.15s;
    }
    
    .file-upload-box:hover .file-upload-icon {
        background: #DBEAFE;
    }
    
    .file-upload-icon svg {
        width: 20px;
        height: 20px;
        stroke: #64748B;
    }
    
    .file-upload-text {
        font-size: 13px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 4px;
    }
    
    .file-upload-hint {
        font-size: 10px;
        color: #94A3B8;
        font-weight: 500;
    }
    
    /* Status Toggle */
    .status-toggle {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 18px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
    }
    
    .toggle-switch {
        position: relative;
        width: 40px;
        height: 22px;
        flex-shrink: 0;
    }
    
    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    
    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: #CBD5E1;
        transition: 0.2s;
    }
    
    .toggle-switch input:checked + .toggle-slider {
        background: #10B981;
    }
    
    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 3px;
        bottom: 3px;
        background: white;
        transition: 0.2s;
    }
    
    .toggle-switch input:checked + .toggle-slider:before {
        transform: translateX(18px);
    }
    
    .toggle-label {
        font-size: 13px;
        font-weight: 600;
        color: #334155;
    }
    
    /* Actions */
    .form-actions {
        padding: 18px 28px;
        border-top: 1px solid #E2E8F0;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        background: #FAFBFC;
    }
    
    .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 20px;
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
        gap: 8px;
        padding: 10px 24px;
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
        width: 15px;
        height: 15px;
    }
    
    /* Error */
    .error-alert {
        background: #FEF2F2;
        border: 1px solid #FECACA;
        padding: 12px 16px;
    }
    
    .error-alert ul {
        margin: 0;
        padding-left: 18px;
        color: #DC2626;
        font-size: 12px;
        font-weight: 500;
    }
    
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        .form-header {
            padding: 16px 20px;
        }
        .form-body {
            padding: 20px;
        }
        .form-actions {
            padding: 14px 20px;
            flex-direction: column-reverse;
        }
        .btn-cancel, .btn-update {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="form-wrapper">
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
                <div class="form-header-title">Edit: {{ $brand->name }}</div>
                <div class="form-header-subtitle">Update the brand information</div>
            </div>
        </div>

        <!-- Info Alert -->
        <div style="padding: 0 28px; margin-top: 24px;">
            <div class="info-alert">
                <div class="info-alert-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="16" x2="12" y2="12"/>
                        <line x1="12" y1="8" x2="12.01" y2="8"/>
                    </svg>
                </div>
                <div class="info-alert-text">
                    Editing brand: <strong>{{ $brand->name }}</strong> ({{ $brand->products_count ?? 0 }} products)
                </div>
            </div>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div style="padding: 0 28px; margin-top: 16px;">
                <div class="error-alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('brands.update', $brand) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            
            <div class="form-body">
                <div class="form-grid">
                    <!-- Brand Name -->
                    <div class="form-group full-width">
                        <label class="form-label">Brand Name <span class="required">*</span></label>
                        <input type="text" 
                               name="name" 
                               value="{{ old('name', $brand->name) }}" 
                               class="form-input"
                               placeholder="e.g. Apple, Samsung, Nike..."
                               required>
                    </div>

                    <!-- Description -->
                    <div class="form-group full-width">
                        <label class="form-label">Description</label>
                        <textarea name="description" 
                                  class="form-textarea" 
                                  placeholder="Brief description about this brand...">{{ old('description', $brand->description) }}</textarea>
                        <span class="form-hint">Optional. A short description for internal use.</span>
                    </div>

                    <!-- Current Logo -->
                    @if($brand->logo)
                        <div class="form-group full-width">
                            <label class="form-label">Current Logo</label>
                            <div class="current-logo-box">
                                <img src="{{ asset($brand->logo) }}" alt="{{ $brand->name }}" class="current-logo-img">
                                <div class="current-logo-info">
                                    <div class="current-logo-name">Current logo</div>
                                    <div class="current-logo-hint">Upload a new logo to replace this one</div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- New Logo Upload -->
                    <div class="form-group full-width">
                        <label class="form-label">New Logo (Optional)</label>
                        <div class="file-upload-box" onclick="document.getElementById('logoInput').click()">
                            <div class="file-upload-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                                    <polyline points="17 8 12 3 7 8"/>
                                    <line x1="12" y1="3" x2="12" y2="15"/>
                                </svg>
                            </div>
                            <div class="file-upload-text">Click to upload new logo</div>
                            <div class="file-upload-hint">Leave empty to keep current logo. JPG, PNG, GIF, WebP (Max 2MB)</div>
                        </div>
                        <input type="file" id="logoInput" name="logo" accept="image/*" style="display: none;">
                    </div>

                    <!-- Status -->
                    <div class="form-group full-width">
                        <label class="form-label">Status</label>
                        <div class="status-toggle">
                            <label class="toggle-switch">
                                <input type="checkbox" name="status" value="1" {{ old('status', $brand->status) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                            <span class="toggle-label">Active - Brand will be visible in the system</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <a href="{{ route('brands.index') }}" class="btn-cancel">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                    Cancel
                </a>
                <button type="submit" class="btn-update">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Update Brand
                </button>
            </div>
        </form>
    </div>
</div>
@endsection