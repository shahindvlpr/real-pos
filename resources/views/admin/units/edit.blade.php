@extends('layouts.admin')

@section('title', 'Edit Unit')
@section('page-title', 'Edit Unit')
@section('page-subtitle', 'Update measurement unit')

@push('styles')
<style>
    .form-wrapper {margin: 0 auto; width: 100%; }
    .form-card { background: #FFFFFF; border: 1px solid #E2E8F0; }
    .form-header { padding: 20px 28px; border-bottom: 1px solid #E2E8F0; display: flex; align-items: center; gap: 14px; }
    .form-header-icon { width: 42px; height: 42px; background: #FEF3C7; display: flex; align-items: center; justify-content: center; }
    .form-header-icon svg { width: 20px; height: 20px; stroke: #F59E0B; }
    .form-header-title { font-size: 15px; font-weight: 700; color: #0F172A; }
    .form-header-subtitle { font-size: 11px; color: #94A3B8; font-weight: 500; margin-top: 1px; }
    .form-body { padding: 28px; }
    .form-group { display: flex; flex-direction: column; gap: 5px; margin-bottom: 20px; }
    .form-group:last-child { margin-bottom: 0; }
    .form-label { font-size: 11px; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; }
    .form-label .required { color: #EF4444; }
    .form-input, .form-textarea { padding: 10px 14px; border: 1px solid #E2E8F0; background: #FFFFFF; font-size: 13px; color: #0F172A; font-family: 'Inter', sans-serif; width: 100%; }
    .form-input:focus, .form-textarea:focus { outline: none; border-color: #3B82F6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.08); }
    .form-textarea { resize: vertical; min-height: 80px; }
    .form-hint { font-size: 10px; color: #94A3B8; font-weight: 500; }
    .inline-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .status-toggle { display: flex; align-items: center; gap: 12px; padding: 14px 18px; background: #F8FAFC; border: 1px solid #E2E8F0; }
    .toggle-switch { position: relative; width: 40px; height: 22px; }
    .toggle-switch input { opacity: 0; width: 0; height: 0; }
    .toggle-slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #CBD5E1; transition: 0.2s; }
    .toggle-switch input:checked + .toggle-slider { background: #10B981; }
    .toggle-slider:before { position: absolute; content: ""; height: 16px; width: 16px; left: 3px; bottom: 3px; background: white; transition: 0.2s; }
    .toggle-switch input:checked + .toggle-slider:before { transform: translateX(18px); }
    .toggle-label { font-size: 13px; font-weight: 600; color: #334155; }
    .form-actions { padding: 18px 28px; border-top: 1px solid #E2E8F0; display: flex; justify-content: flex-end; gap: 12px; background: #FAFBFC; }
    .btn-cancel { padding: 10px 20px; background: #FFFFFF; border: 1px solid #E2E8F0; color: #475569; font-size: 12px; font-weight: 600; text-transform: uppercase; text-decoration: none; }
    .btn-update { padding: 10px 24px; background: #F59E0B; border: 1px solid #F59E0B; color: #FFFFFF; font-size: 12px; font-weight: 700; text-transform: uppercase; cursor: pointer; }
    .btn-cancel:hover { background: #F1F5F9; }
    .btn-update:hover { background: #D97706; }
    @media (max-width: 600px) { .inline-row { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="form-wrapper">
    <div class="form-card">
        <div class="form-header">
            <div class="form-header-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
            </div>
            <div>
                <div class="form-header-title">Edit: {{ $unit->name }} ({{ $unit->code }})</div>
                <div class="form-header-subtitle">Update the unit information</div>
            </div>
        </div>

        @if($errors->any())
            <div style="padding: 0 28px; margin-top: 20px;">
                <div style="background: #FEF2F2; border: 1px solid #FECACA; padding: 12px 16px;">
                    <ul style="margin: 0; padding-left: 18px; color: #DC2626; font-size: 12px;">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('units.update', $unit) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-body">
                <div class="inline-row">
                    <div class="form-group">
                        <label class="form-label">Unit Name <span class="required">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $unit->name) }}" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Unit Code <span class="required">*</span></label>
                        <input type="text" name="code" value="{{ old('code', $unit->code) }}" class="form-input" style="text-transform: uppercase;" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-textarea">{{ old('description', $unit->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <div class="status-toggle">
                        <label class="toggle-switch">
                            <input type="checkbox" name="status" value="1" {{ old('status', $unit->status) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                        <span class="toggle-label">Active</span>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <a href="{{ route('units.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-update">Update Unit</button>
            </div>
        </form>
    </div>
</div>
@endsection