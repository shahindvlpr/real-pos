@extends('layouts.admin')

@section('title', 'Edit User')
@section('page-title', 'Edit User')
@section('page-subtitle', 'Update user information')

@push('styles')
<style>
    .form-wrapper {margin: 0 auto; width: 100%; }
    .form-card { background: #FFF; border: 1px solid #E2E8F0; }
    .form-header { padding: 20px 28px; border-bottom: 1px solid #E2E8F0; display: flex; align-items: center; gap: 14px; }
    .form-header-icon { width: 42px; height: 42px; background: #FEF3C7; display: flex; align-items: center; justify-content: center; }
    .form-header-icon svg { width: 20px; height: 20px; stroke: #F59E0B; }
    .form-body { padding: 28px; }
    .form-group { display: flex; flex-direction: column; gap: 5px; margin-bottom: 16px; }
    .form-label { font-size: 11px; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.8px; }
    .form-label .required { color: #EF4444; }
    .form-input, .form-select { padding: 10px 14px; border: 1px solid #E2E8F0; font-size: 13px; font-family: 'Inter', sans-serif; width: 100%; }
    .form-input:focus, .form-select:focus { outline: none; border-color: #3B82F6; }
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .form-actions { padding: 18px 28px; border-top: 1px solid #E2E8F0; display: flex; justify-content: flex-end; gap: 12px; background: #FAFBFC; }
    .btn-cancel { padding: 10px 20px; background: #FFF; border: 1px solid #E2E8F0; color: #475569; font-size: 12px; font-weight: 600; text-transform: uppercase; text-decoration: none; }
    .btn-update { padding: 10px 24px; background: #F59E0B; border: 1px solid #F59E0B; color: #FFF; font-size: 12px; font-weight: 700; text-transform: uppercase; cursor: pointer; }
    @media (max-width: 768px) { .grid-2 { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="form-wrapper">
    <div class="form-card">
        <div class="form-header">
            <div class="form-header-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </div>
            <div><div style="font-size:14px;font-weight:700;color:#0F172A;">Edit: {{ $user->name }}</div><div style="font-size:11px;color:#94A3B8;">Update user details</div></div>
        </div>

        @if($errors->any())
            <div style="padding:0 28px;margin-top:20px;"><div style="background:#FEF2F2;border:1px solid #FECACA;padding:12px;color:#DC2626;font-size:12px;"><ul style="margin:0;padding-left:18px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div></div>
        @endif

        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-body">
                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label">Name <span class="required">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email <span class="required">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Role <span class="required">*</span></label>
                        <select name="role" class="form-select" required>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
                            <option value="cashier" {{ $user->role == 'cashier' ? 'selected' : '' }}>Cashier</option>
                            <option value="store_keeper" {{ $user->role == 'store_keeper' ? 'selected' : '' }}>Store Keeper</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">New Password (leave blank)</label>
                        <input type="password" name="password" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-input">
                    </div>
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                        <input type="checkbox" name="is_active" value="1" {{ $user->is_active ? 'checked' : '' }} style="width:16px;height:16px;">
                        <span style="font-size:13px;font-weight:500;color:#334155;">Active</span>
                    </label>
                </div>
            </div>
            <div class="form-actions">
                <a href="{{ route('admin.users.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-update">Update User</button>
            </div>
        </form>
    </div>
</div>
@endsection