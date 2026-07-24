@extends('layouts.admin')

@section('title', 'Create Unit')
@section('page-title', 'New Unit')
@section('page-subtitle', 'Create a new measurement unit')

@push('styles')
<style>
    .form-wrapper { margin: 0 auto; width: 100%; }
    .form-card { background: #FFFFFF; border: 1px solid #E2E8F0; }
    .form-header { padding: 20px 28px; border-bottom: 1px solid #E2E8F0; display: flex; align-items: center; gap: 14px; }
    .form-header-icon { width: 42px; height: 42px; background: #EFF6FF; display: flex; align-items: center; justify-content: center; }
    .form-header-icon svg { width: 20px; height: 20px; stroke: #3B82F6; }
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
    .btn-save { padding: 10px 24px; background: #3B82F6; border: 1px solid #3B82F6; color: #FFFFFF; font-size: 12px; font-weight: 700; text-transform: uppercase; cursor: pointer; }
    .btn-cancel:hover { background: #F1F5F9; }
    .btn-save:hover { background: #2563EB; }
    @media (max-width: 600px) { .inline-row { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="form-wrapper">
    <div class="form-card">
        <div class="form-header">
            <div class="form-header-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
            </div>
            <div>
                <div class="form-header-title">Create New Unit</div>
                <div class="form-header-subtitle">Add a measurement unit for your products</div>
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

        <form action="{{ route('units.store') }}" method="POST">
            @csrf
            <div class="form-body">
                <div class="inline-row">
                    <div class="form-group">
                        <label class="form-label">Unit Name <span class="required">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-input" placeholder="e.g. Piece" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Unit Code <span class="required">*</span></label>
                        <input type="text" name="code" value="{{ old('code') }}" class="form-input" placeholder="e.g. PCS, KG, BOX" style="text-transform: uppercase;" required>
                        <span class="form-hint">Short code, max 20 characters</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-textarea" placeholder="e.g. Pieces for counting individual items">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <div class="status-toggle">
                        <label class="toggle-switch">
                            <input type="checkbox" name="status" value="1" checked>
                            <span class="toggle-slider"></span>
                        </label>
                        <span class="toggle-label">Active</span>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <a href="{{ route('units.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-save">Save Unit</button>
            </div>
        </form>
    </div>
</div>
@endsection