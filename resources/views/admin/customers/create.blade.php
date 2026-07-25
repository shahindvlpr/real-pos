@extends('layouts.admin')

@section('title', 'Create Customer')
@section('page-title', 'New Customer')
@section('page-subtitle', 'Add a new customer')

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
        background: #EFF6FF;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .form-header-icon svg {
        width: 20px;
        height: 20px;
        stroke: #3B82F6;
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
    
    .form-input.error,
    .form-textarea.error {
        border-color: #EF4444;
    }
    
    .form-error {
        font-size: 11px;
        color: #EF4444;
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
    
    .btn-save {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 24px;
        background: #3B82F6;
        border: 1px solid #3B82F6;
        color: #FFFFFF;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.15s;
    }
    
    .btn-save:hover {
        background: #2563EB;
        border-color: #2563EB;
    }
    
    .btn-cancel svg,
    .btn-save svg {
        width: 15px;
        height: 15px;
    }
    
    /* Error Alert */
    .error-alert {
        background: #FEF2F2;
        border: 1px solid #FECACA;
        padding: 12px 16px;
        margin-bottom: 20px;
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
        .btn-cancel, .btn-save {
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
                    <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                    <circle cx="8.5" cy="7" r="4"/>
                    <line x1="20" y1="8" x2="20" y2="14"/>
                    <line x1="23" y1="11" x2="17" y2="11"/>
                </svg>
            </div>
            <div>
                <div class="form-header-title">Create New Customer</div>
                <div class="form-header-subtitle">Add a new customer to your system</div>
            </div>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div style="padding: 0 28px; margin-top: 20px;">
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
        <form action="{{ route('customers.store') }}" method="POST">
            @csrf
            
            <div class="form-body">
                <div class="form-grid">
                    <!-- Name -->
                    <div class="form-group full-width">
                        <label class="form-label">Full Name <span class="required">*</span></label>
                        <input type="text" 
                               name="name" 
                               value="{{ old('name') }}" 
                               class="form-input {{ $errors->has('name') ? 'error' : '' }}"
                               placeholder="Enter customer full name"
                               required>
                        @error('name')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                               placeholder="customer@email.com">
                        @error('email')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" 
                               name="phone" 
                               value="{{ old('phone') }}" 
                               class="form-input {{ $errors->has('phone') ? 'error' : '' }}"
                               placeholder="01XXXXXXXXX">
                        @error('phone')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="form-group full-width">
                        <label class="form-label">Address</label>
                        <textarea name="address" 
                                  class="form-textarea {{ $errors->has('address') ? 'error' : '' }}"
                                  placeholder="Enter customer address...">{{ old('address') }}</textarea>
                        @error('address')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="form-group full-width">
                        <label class="form-label">Account Status</label>
                        <div class="status-toggle">
                            <label class="toggle-switch">
                                <input type="checkbox" name="status" value="1" checked>
                                <span class="toggle-slider"></span>
                            </label>
                            <span class="toggle-label">Active - Customer can be used in POS</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <a href="{{ route('customers.index') }}" class="btn-cancel">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                    Cancel
                </a>
                <button type="submit" class="btn-save">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Save Customer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection