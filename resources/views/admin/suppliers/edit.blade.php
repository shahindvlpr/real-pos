@extends('layouts.admin')

@section('title', 'Edit Supplier')
@section('page-title', 'Edit Supplier')
@section('page-subtitle', 'Update supplier information')

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
        padding: 22px 28px;
        border-bottom: 1px solid #E2E8F0;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .form-header-icon {
        width: 44px;
        height: 44px;
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
        margin-top: 2px;
    }

    .form-body {
        padding: 28px;
    }

    .form-section {
        margin-bottom: 24px;
    }

    .form-section:last-child {
        margin-bottom: 0;
    }

    .section-title {
        font-size: 10px;
        font-weight: 700;
        color: #64748B;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        margin-bottom: 14px;
        padding-bottom: 10px;
        border-bottom: 1px solid #F1F5F9;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
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
        letter-spacing: 0.7px;
    }

    .form-label .required {
        color: #EF4444;
        margin-left: 1px;
    }

    .form-input,
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
    .form-textarea:focus {
        outline: none;
        border-color: #3B82F6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.08);
    }

    .form-input.error,
    .form-textarea.error {
        border-color: #EF4444;
    }

    .form-textarea {
        resize: vertical;
        min-height: 80px;
    }

    .form-hint {
        font-size: 10px;
        color: #94A3B8;
        font-weight: 500;
    }

    .form-error {
        font-size: 11px;
        color: #EF4444;
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

    .toggle-switch input:checked+.toggle-slider {
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

    .toggle-switch input:checked+.toggle-slider:before {
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
        gap: 7px;
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
        font-family: 'Inter', sans-serif;
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

    /* Error Alert */
    .error-alert {
        background: #FEF2F2;
        border: 1px solid #FECACA;
        padding: 12px 16px;
        display: flex;
        align-items: flex-start;
        gap: 8px;
    }

    .error-alert ul {
        margin: 0;
        padding-left: 16px;
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
            gap: 8px;
        }

        .btn-cancel,
        .btn-update {
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
                <div class="form-header-title">Edit: {{ $supplier->name }}</div>
                <div class="form-header-subtitle">Update supplier details</div>
            </div>
        </div>

        <!-- Info Alert -->
        <div style="padding: 0 28px; margin-top: 20px;">
            <div class="info-alert">
                <div class="info-alert-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="16" x2="12" y2="12"/>
                        <line x1="12" y1="8" x2="12.01" y2="8"/>
                    </svg>
                </div>
                <div class="info-alert-text">
                    Editing supplier: <strong>{{ $supplier->name }}</strong>
                    @if($supplier->company_name) | {{ $supplier->company_name }}@endif
                    @if($supplier->tax_number) | Tax: {{ $supplier->tax_number }}@endif
                </div>
            </div>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div style="padding: 0 28px; margin-top: 16px;">
                <div class="error-alert">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2" style="flex-shrink:0;margin-top:1px;">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('suppliers.update', $supplier) }}" method="POST">
            @csrf @method('PUT')

            <div class="form-body">
                <!-- Basic Info -->
                <div class="form-section">
                    <div class="section-title">Basic Information</div>
                    <div class="form-grid">
                        <div class="form-group full-width">
                            <label class="form-label">Contact Person <span class="required">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $supplier->name) }}" 
                                   class="form-input {{ $errors->has('name') ? 'error' : '' }}" required>
                            @error('name')<span class="form-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Company Name</label>
                            <input type="text" name="company_name" value="{{ old('company_name', $supplier->company_name) }}" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" value="{{ old('phone', $supplier->phone) }}" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" value="{{ old('email', $supplier->email) }}" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tax Number</label>
                            <input type="text" name="tax_number" value="{{ old('tax_number', $supplier->tax_number) }}" class="form-input">
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div class="form-section">
                    <div class="section-title">Address</div>
                    <div class="form-grid">
                        <div class="form-group full-width">
                            <label class="form-label">Street Address</label>
                            <textarea name="address" class="form-textarea">{{ old('address', $supplier->address) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">City</label>
                            <input type="text" name="city" value="{{ old('city', $supplier->city) }}" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">State / Province</label>
                            <input type="text" name="state" value="{{ old('state', $supplier->state) }}" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Postal Code</label>
                            <input type="text" name="postal_code" value="{{ old('postal_code', $supplier->postal_code) }}" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Country</label>
                            <input type="text" name="country" value="{{ old('country', $supplier->country) }}" class="form-input">
                        </div>
                    </div>
                </div>

                <!-- Additional -->
                <div class="form-section">
                    <div class="section-title">Additional Information</div>
                    <div class="form-grid">
                        <div class="form-group full-width">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" class="form-textarea">{{ old('notes', $supplier->notes) }}</textarea>
                            <span class="form-hint">Optional internal notes for reference</span>
                        </div>
                        <div class="form-group full-width">
                            <label class="form-label">Account Status</label>
                            <div class="status-toggle">
                                <label class="toggle-switch">
                                    <input type="checkbox" name="status" value="1" {{ old('status', $supplier->status) ? 'checked' : '' }}>
                                    <span class="toggle-slider"></span>
                                </label>
                                <span class="toggle-label">Active - Supplier available for purchases</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <a href="{{ route('suppliers.index') }}" class="btn-cancel">
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
                    Update Supplier
                </button>
            </div>
        </form>
    </div>
</div>
@endsection