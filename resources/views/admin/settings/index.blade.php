@extends('layouts.admin')

@section('title', 'Settings')
@section('page-title', 'Settings')
@section('page-subtitle', 'Configure system preferences')

@push('styles')
<style>
    .settings-wrapper {
        margin: 0 auto;
        width: 100%;
    }

    .settings-card {
        background: #FFF;
        border: 1px solid #E2E8F0;
        margin-bottom: 14px;
    }

    .card-header {
        padding: 14px 20px;
        border-bottom: 1px solid #E2E8F0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-icon {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-icon.blue { background: #EFF6FF; color: #3B82F6; }
    .card-icon.green { background: #ECFDF5; color: #10B981; }
    .card-icon.amber { background: #FFFBEB; color: #F59E0B; }
    .card-icon.purple { background: #F5F3FF; color: #8B5CF6; }

    .card-icon svg { width: 16px; height: 16px; }

    .card-title {
        font-size: 12px;
        font-weight: 700;
        color: #0F172A;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .card-subtitle {
        font-size: 10px;
        color: #94A3B8;
        font-weight: 500;
    }

    .card-body {
        padding: 20px;
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
        font-size: 10px;
        font-weight: 700;
        color: #64748B;
        text-transform: uppercase;
        letter-spacing: 0.6px;
    }

    .form-input,
    .form-textarea,
    .form-select {
        padding: 9px 12px;
        border: 1px solid #E2E8F0;
        background: #FFF;
        font-size: 13px;
        color: #0F172A;
        font-family: 'Inter', sans-serif;
        transition: all 0.15s;
        width: 100%;
    }

    .form-input:focus,
    .form-textarea:focus,
    .form-select:focus {
        outline: none;
        border-color: #3B82F6;
        box-shadow: 0 0 0 3px rgba(59,130,246,0.06);
    }

    .form-textarea {
        resize: vertical;
        min-height: 70px;
    }

    .form-hint {
        font-size: 10px;
        color: #94A3B8;
        font-weight: 500;
    }

    .input-icon-wrap {
        position: relative;
    }

    .input-icon-wrap .input-prefix {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 13px;
        color: #64748B;
        font-weight: 600;
    }

    .input-icon-wrap .form-input {
        padding-left: 28px;
    }

    /* Toggle Switch */
    .toggle-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #F1F5F9;
    }

    .toggle-row:last-child {
        border-bottom: none;
    }

    .toggle-info {
        flex: 1;
    }

    .toggle-title {
        font-size: 12px;
        font-weight: 600;
        color: #0F172A;
    }

    .toggle-desc {
        font-size: 10px;
        color: #94A3B8;
        margin-top: 1px;
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

    /* Save Bar */
    .save-bar {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding: 14px 0;
    }

    .btn-reset {
        padding: 10px 20px;
        background: #FFF;
        border: 1px solid #E2E8F0;
        color: #64748B;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        cursor: pointer;
        letter-spacing: 0.5px;
    }

    .btn-save {
        padding: 10px 28px;
        background: #3B82F6;
        border: 1px solid #3B82F6;
        color: #FFF;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        cursor: pointer;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-save:hover {
        background: #2563EB;
    }

    .btn-save svg {
        width: 13px;
        height: 13px;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="settings-wrapper">

    @if(session('success'))
        <div style="background:#F0FDF4;border:1px solid #BBF7D0;color:#166534;padding:12px 16px;margin-bottom:14px;font-size:12px;font-weight:600;">
            ✅ {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- General Settings -->
        <div class="settings-card">
            <div class="card-header">
                <div class="card-icon blue">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
                </div>
                <div>
                    <div class="card-title">Company Information</div>
                    <div class="card-subtitle">Business details for invoices</div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Company Name</label>
                        <input type="text" name="settings[company_name]" value="{{ \App\Models\Setting::get('company_name') }}" class="form-input" placeholder="Your company name">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="settings[company_phone]" value="{{ \App\Models\Setting::get('company_phone') }}" class="form-input" placeholder="+8801700-000000">
                    </div>
                    <div class="form-group full">
                        <label class="form-label">Address</label>
                        <input type="text" name="settings[company_address]" value="{{ \App\Models\Setting::get('company_address') }}" class="form-input" placeholder="123, Dhaka, Bangladesh">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="settings[company_email]" value="{{ \App\Models\Setting::get('company_email') }}" class="form-input" placeholder="info@company.com">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Currency Symbol</label>
                        <input type="text" name="settings[currency_symbol]" value="{{ \App\Models\Setting::get('currency_symbol') }}" class="form-input" style="max-width:100px;" placeholder="৳">
                        <span class="form-hint">Used in POS and invoices</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Invoice Settings -->
        <div class="settings-card">
            <div class="card-header">
                <div class="card-icon green">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <div>
                    <div class="card-title">Invoice Configuration</div>
                    <div class="card-subtitle">Customize your invoice format</div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Invoice Prefix</label>
                        <input type="text" name="settings[invoice_prefix]" value="{{ \App\Models\Setting::get('invoice_prefix') }}" class="form-input" placeholder="INV-" style="max-width:120px;">
                        <span class="form-hint">e.g. INV-, BILL-, SALE-</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Default Tax (%)</label>
                        <input type="number" name="settings[default_tax]" value="{{ \App\Models\Setting::get('default_tax') }}" class="form-input" style="max-width:100px;" placeholder="0" min="0" max="100">
                    </div>
                    <div class="form-group full">
                        <label class="form-label">Invoice Footer Text</label>
                        <input type="text" name="settings[invoice_footer]" value="{{ \App\Models\Setting::get('invoice_footer') }}" class="form-input" placeholder="Thank you for your purchase!">
                    </div>
                    <div class="form-group full">
                        <label class="form-label">Terms & Conditions</label>
                        <textarea name="settings[invoice_terms]" class="form-textarea" placeholder="Terms printed on invoice...">{{ \App\Models\Setting::get('invoice_terms') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inventory Alerts -->
        <div class="settings-card">
            <div class="card-header">
                <div class="card-icon amber">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                </div>
                <div>
                    <div class="card-title">Inventory Alerts</div>
                    <div class="card-subtitle">Stock notification settings</div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Low Stock Alert Quantity</label>
                    <input type="number" name="settings[low_stock_alert]" value="{{ \App\Models\Setting::get('low_stock_alert') }}" class="form-input" style="max-width:120px;" min="1" placeholder="10">
                    <span class="form-hint">Products below this quantity will trigger alerts</span>
                </div>
            </div>
        </div>

        <!-- Save Bar -->
        <div class="save-bar">
            <button type="button" class="btn-reset" onclick="location.reload()">Reset</button>
            <button type="submit" class="btn-save">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                Save All Settings
            </button>
        </div>
    </form>
</div>
@endsection