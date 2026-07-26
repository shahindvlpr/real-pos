@extends('layouts.admin')

@section('title', 'Create User')
@section('page-title', 'New User')
@section('page-subtitle', 'Add a new system user')

@push('styles')
<style>
    .form-wrapper { margin: 0 auto; width: 100%; }
    .form-card { background: #FFF; border: 1px solid #E2E8F0; }
    .form-header { padding: 20px 28px; border-bottom: 1px solid #E2E8F0; display: flex; align-items: center; gap: 14px; }
    .form-header-icon { width: 42px; height: 42px; background: #EFF6FF; display: flex; align-items: center; justify-content: center; }
    .form-header-icon svg { width: 20px; height: 20px; stroke: #3B82F6; }
    .form-body { padding: 28px; }
    .form-group { display: flex; flex-direction: column; gap: 5px; margin-bottom: 16px; }
    .form-label { font-size: 11px; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; }
    .form-label .required { color: #EF4444; }
    .form-input, .form-select { padding: 10px 14px; border: 1px solid #E2E8F0; font-size: 13px; font-family: 'Inter', sans-serif; width: 100%; }
    .form-input:focus, .form-select:focus { outline: none; border-color: #3B82F6; }
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .form-actions { padding: 18px 28px; border-top: 1px solid #E2E8F0; display: flex; justify-content: flex-end; gap: 12px; background: #FAFBFC; }
    .btn-cancel { padding: 10px 20px; background: #FFF; border: 1px solid #E2E8F0; color: #475569; font-size: 12px; font-weight: 600; text-transform: uppercase; text-decoration: none; }
    .btn-save { padding: 10px 24px; background: #3B82F6; border: 1px solid #3B82F6; color: #FFF; font-size: 12px; font-weight: 700; text-transform: uppercase; cursor: pointer; }
    @media (max-width: 768px) { .grid-2 { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="form-wrapper">
    <div class="form-card">
        <div class="form-header">
            <div class="form-header-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
            </div>
            <div><div style="font-size:14px;font-weight:700;color:#0F172A;">Create New User</div><div style="font-size:11px;color:#94A3B8;">Add a new system user</div></div>
        </div>

        @if($errors->any())
            <div style="padding:0 28px;margin-top:20px;"><div style="background:#FEF2F2;border:1px solid #FECACA;padding:12px;color:#DC2626;font-size:12px;"><ul style="margin:0;padding-left:18px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div></div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="form-body">
                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label">Name <span class="required">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email <span class="required">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Role <span class="required">*</span></label>
                        <select name="role" class="form-select" required>
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                            <option value="cashier" selected>Cashier</option>
                            <option value="store_keeper">Store Keeper</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password <span class="required">*</span></label>
                        <input type="password" name="password" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm Password <span class="required">*</span></label>
                        <input type="password" name="password_confirmation" class="form-input" required>
                    </div>
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                        <input type="checkbox" name="is_active" value="1" checked style="width:16px;height:16px;">
                        <span style="font-size:13px;font-weight:500;color:#334155;">Active</span>
                    </label>
                </div>
            </div>
            <div class="form-actions">
                <a href="{{ route('admin.users.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-save">Save User</button>
            </div>
        </form>
    </div>
</div>
@endsection