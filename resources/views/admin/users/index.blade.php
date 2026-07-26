@extends('layouts.admin')

@section('title', 'Users')
@section('page-title', 'Users')
@section('page-subtitle', 'Manage system users')

@push('styles')
<style>
    .user-avatar {
        width: 42px; height: 42px;
        background: #EFF6FF; color: #3B82F6;
        display: flex; align-items: center; justify-content: center;
        font-size: 16px; font-weight: 800; flex-shrink: 0;
    }
    .user-name { font-size: 13px; font-weight: 600; color: #0F172A; }
    .user-email { font-size: 11px; color: #64748B; }
    .role-badge {
        display: inline-block; font-size: 10px; font-weight: 700; text-transform: uppercase;
        padding: 3px 10px; letter-spacing: 0.5px;
    }
    .role-admin { background: #FEF2F2; color: #DC2626; }
    .role-manager { background: #FEF3C7; color: #D97706; }
    .role-cashier { background: #ECFDF5; color: #059669; }
    .role-store { background: #EFF6FF; color: #3B82F6; }
    .status-badge {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 10px; font-weight: 700; text-transform: uppercase; padding: 3px 10px;
    }
    .status-badge.active { background: #ECFDF5; color: #059669; }
    .status-badge.inactive { background: #F1F5F9; color: #94A3B8; }
    .action-btn {
        width: 30px; height: 30px; display: inline-flex; align-items: center; justify-content: center;
        border: 1px solid #E2E8F0; background: #FFF; cursor: pointer; transition: all 0.15s;
    }
    .action-btn.edit { color: #F59E0B; }
    .action-btn.edit:hover { background: #FFFBEB; border-color: #F59E0B; }
    .action-btn.delete { color: #EF4444; }
    .action-btn.delete:hover { background: #FEF2F2; border-color: #EF4444; }
    .action-btn svg { width: 14px; height: 14px; }
    .btn-add {
        display: inline-flex; align-items: center; gap: 6px;
        background: #3B82F6; color: #FFF; border: 1px solid #3B82F6;
        padding: 9px 18px; font-size: 11px; font-weight: 700;
        text-transform: uppercase; text-decoration: none;
    }
    .btn-add:hover { background: #2563EB; }
    .card-header-row { padding: 16px 20px; border-bottom: 1px solid #E2E8F0; display: flex; justify-content: space-between; align-items: center; }
</style>
@endpush

@section('content')
<div class="card" style="padding:0;">
    <div class="card-header-row">
        <span style="font-size:12px;color:#64748B;">Total: <strong>{{ $users->total() }}</strong> users</span>
        <a href="{{ route('admin.users.create') }}" class="btn-add">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
            Add User
        </a>
    </div>

    <div style="overflow-x:auto;">
        <table class="table">
            <thead>
                <tr><th>#</th><th>User</th><th>Role</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td><span style="font-size:11px;color:#94A3B8;">#{{ $user->id }}</span></td>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div class="user-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                <div>
                                    <div class="user-name">{{ $user->name }}</div>
                                    <div class="user-email">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="role-badge role-{{ $user->role }}">
                                {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                            </span>
                        </td>
                        <td>
                            <span class="status-badge {{ $user->is_active ? 'active' : 'inactive' }}">
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div style="display:flex;gap:4px;">
                                <a href="{{ route('admin.users.edit', $user) }}" class="action-btn edit" title="Edit">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <button onclick="confirmDelete('del-{{ $user->id }}')" class="action-btn delete">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                                </button>
                            </div>
                            <form id="del-{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:none;">@csrf @method('DELETE')</form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center;padding:40px;color:#94A3B8;">No users found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
        <div style="padding:14px 20px;border-top:1px solid #E2E8F0;">{{ $users->links() }}</div>
    @endif
</div>
@endsection