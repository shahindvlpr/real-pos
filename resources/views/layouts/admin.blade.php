<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Real POS') - Real POS System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <style>
        :root {
            --sidebar-width: 260px;
            --topbar-height: 64px;
            --primary: #3B82F6;
            --primary-dark: #2563EB;
            --primary-light: #DBEAFE;
            --primary-bg: #EFF6FF;
            --sidebar-bg: #0F172A;
            --sidebar-hover: #1E293B;
            --sidebar-active: #1E3A5F;
            --text-primary: #F8FAFC;
            --text-secondary: #94A3B8;
            --text-muted: #64748B;
            --border-color: #1E293B;
            --body-bg: #F1F5F9;
            --card-bg: #FFFFFF;
            --text-dark: #0F172A;
            --text-body: #334155;
            --text-light: #64748B;
            --border-light: #E2E8F0;
            --danger: #EF4444;
            --danger-dark: #DC2626;
            --warning: #F59E0B;
            --warning-dark: #D97706;
            --info: #06B6D4;
            --info-dark: #0891B2;
            --success: #10B981;
            --success-dark: #059669;
                --body-bg: #F1F5F9;
    --card-bg: #FFFFFF;
    --card-border: #E2E8F0;
    --text-primary: #0F172A;
    --text-secondary: #64748B;
    --text-muted: #94A3B8;
    --topbar-bg: #FFFFFF;
    --topbar-border: #E2E8F0;
    --sidebar-bg: #0F172A;
    --sidebar-text: #94A3B8;
    --sidebar-active: #1E3A5F;
    --input-bg: #FFFFFF;
    --input-border: #E2E8F0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--body-bg);
            color: var(--text-body);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            line-height: 1.5;
        }

        /* ========== SIDEBAR ========== */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            z-index: 1040;
            overflow-y: auto;
            overflow-x: hidden;
            transition: transform 0.25s ease;
            border-right: 1px solid var(--border-color);
        }

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #334155;
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-logo {
            flex-shrink: 0;
        }

        .brand-logo svg {
            display: block;
        }

        .brand-text h4 {
            font-size: 15px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: 0.5px;
            margin: 0;
            line-height: 1.2;
        }

        .brand-text span {
            font-size: 9px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
        }

        .sidebar-nav {
            padding: 8px 0;
        }

        .nav-section {
            margin-bottom: 2px;
        }

        .nav-section-title {
            padding: 16px 20px 6px 20px;
            font-size: 10px;
            font-weight: 700;
            color: var(--text-muted);
            letter-spacing: 1.5px;
        }

        .nav-item {
            margin: 1px 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.15s ease;
            border-left: 3px solid transparent;
            letter-spacing: 0.2px;
        }

        .nav-link:hover {
            background: var(--sidebar-hover);
            color: var(--text-primary);
            border-left-color: #334155;
        }

        .nav-link.active {
            background: var(--sidebar-active);
            color: #60A5FA;
            border-left-color: var(--primary);
            font-weight: 600;
        }

        .nav-link.active .nav-icon {
            color: var(--primary);
        }

        .nav-link.disabled {
            opacity: 0.45;
            cursor: not-allowed;
            pointer-events: none;
        }

        .nav-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .nav-text {
            flex: 1;
        }

        .badge-soon {
            background: #334155;
            color: #94A3B8;
            font-size: 9px;
            font-weight: 700;
            padding: 2px 8px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        /* Mobile Toggle */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 12px;
            left: 12px;
            z-index: 1050;
            width: 40px;
            height: 40px;
            background: var(--sidebar-bg);
            color: white;
            border: 1px solid var(--border-color);
            cursor: pointer;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .sidebar-toggle {
                display: flex;
            }
        }

        /* ========== MAIN CONTENT ========== */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin 0.25s ease;
        }

        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
            }
        }

        /* ========== TOP BAR ========== */
        .top-bar {
            background: #FFFFFF;
            height: var(--topbar-height);
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-light);
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .top-bar-left h4 {
            font-size: 17px;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
            line-height: 1.2;
        }

        .top-bar-left .subtitle {
            font-size: 11px;
            color: var(--text-light);
            font-weight: 500;
        }

        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .btn-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--body-bg);
            border: 1px solid var(--border-light);
            cursor: pointer;
            position: relative;
            transition: all 0.15s;
        }

        .btn-icon:hover {
            background: #E2E8F0;
        }

        .btn-icon svg {
            width: 18px;
            height: 18px;
            stroke: #64748B;
        }

        .notification-dot {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 8px;
            height: 8px;
            background: var(--danger);
            border: 2px solid white;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 12px;
            cursor: pointer;
            transition: all 0.15s;
            border: 1px solid transparent;
        }

        .user-dropdown:hover {
            background: var(--body-bg);
            border-color: var(--border-light);
        }

        .user-avatar {
            width: 34px;
            height: 34px;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
        }

        .user-info {
            text-align: left;
        }

        .user-info .user-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-dark);
            line-height: 1.2;
        }

        .user-info .user-role {
            font-size: 10px;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border: 1px solid var(--border-light);
            min-width: 200px;
            z-index: 1050;
            display: none;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            font-size: 13px;
            color: var(--text-body);
            text-decoration: none;
            transition: all 0.1s;
            font-weight: 500;
            border: none;
            background: none;
            width: 100%;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
        }

        .dropdown-item:hover {
            background: var(--body-bg);
        }

        .dropdown-item.text-danger {
            color: var(--danger);
        }

        .dropdown-divider {
            border: none;
            border-top: 1px solid var(--border-light);
            margin: 4px 0;
        }

        /* ========== PAGE CONTENT ========== */
        .page-content {
            padding: 24px;
        }

        /* ========== CARDS ========== */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--border-light);
            margin-bottom: 20px;
        }

        .card-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h5 {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
        }

        .card-body {
            padding: 24px;
        }

        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--border-light);
            padding: 24px;
            transition: all 0.2s;
        }

        .stat-card:hover {
            border-color: #CBD5E1;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        .stat-icon svg {
            width: 22px;
            height: 22px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 12px;
            color: var(--text-light);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ========== BUTTONS ========== */
        .btn {
            font-weight: 600;
            font-size: 12px;
            letter-spacing: 0.3px;
            padding: 9px 18px;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all 0.15s;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-family: 'Inter', sans-serif;
            line-height: 1;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-secondary {
            background: #64748B;
            color: white;
            border-color: #64748B;
        }
        .btn-secondary:hover {
            background: #475569;
        }

        .btn-success {
            background: var(--success);
            color: white;
            border-color: var(--success);
        }
        .btn-success:hover {
            background: var(--success-dark);
        }

        .btn-danger {
            background: var(--danger);
            color: white;
            border-color: var(--danger);
        }
        .btn-danger:hover {
            background: var(--danger-dark);
        }

        .btn-warning {
            background: var(--warning);
            color: white;
            border-color: var(--warning);
        }
        .btn-warning:hover {
            background: var(--warning-dark);
        }

        .btn-info {
            background: var(--info);
            color: white;
            border-color: var(--info);
        }
        .btn-info:hover {
            background: var(--info-dark);
        }

        .btn-light {
            background: #F8FAFC;
            color: #475569;
            border-color: var(--border-light);
        }
        .btn-light:hover {
            background: #F1F5F9;
        }

        .btn-outline-primary {
            background: transparent;
            color: var(--primary);
            border-color: var(--primary);
        }
        .btn-outline-primary:hover {
            background: var(--primary);
            color: white;
        }

        .btn-sm {
            padding: 5px 12px;
            font-size: 10px;
        }

        .btn-xs {
            padding: 3px 8px;
            font-size: 9px;
        }

        .btn-group {
            display: flex;
            gap: 4px;
        }

        /* ========== TABLES ========== */
        .table-responsive {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table thead th {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-light);
            background: #F8FAFC;
            padding: 12px 16px;
            text-align: left;
            border-bottom: 2px solid var(--border-light);
            white-space: nowrap;
        }

        .table tbody td {
            padding: 12px 16px;
            border-bottom: 1px solid var(--border-light);
            font-size: 13px;
            color: var(--text-body);
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background: #F8FAFC;
        }

        .table-empty {
            text-align: center;
            padding: 60px 20px !important;
        }

        .table-empty-icon {
            font-size: 48px;
            color: #CBD5E1;
            margin-bottom: 12px;
        }

        /* ========== FORMS ========== */
        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            font-size: 12px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 5px;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-label .required {
            color: var(--danger);
        }

        .form-control,
        .form-select {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid var(--border-light);
            background: #FFFFFF;
            font-size: 13px;
            color: var(--text-dark);
            transition: border-color 0.15s;
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: var(--danger);
        }

        .invalid-feedback {
            font-size: 11px;
            color: var(--danger);
            margin-top: 4px;
            font-weight: 500;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 80px;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-check-input {
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
        }

        .form-check-label {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-body);
        }

        /* ========== ALERTS ========== */
        .alert {
            padding: 14px 18px;
            margin-bottom: 20px;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid;
        }

        .alert-success {
            background: #F0FDF4;
            color: #166534;
            border-left-color: var(--success);
        }

        .alert-danger {
            background: #FEF2F2;
            color: #991B1B;
            border-left-color: var(--danger);
        }

        .alert-warning {
            background: #FFFBEB;
            color: #92400E;
            border-left-color: var(--warning);
        }

        .alert-info {
            background: #EFF6FF;
            color: #1E40AF;
            border-left-color: var(--primary);
        }

        .alert-dismiss {
            margin-left: auto;
            cursor: pointer;
            opacity: 0.5;
            font-size: 18px;
            line-height: 1;
        }

        .alert-dismiss:hover {
            opacity: 1;
        }

        /* ========== BADGES ========== */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 10px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .badge-success { background: #DCFCE7; color: #166534; }
        .badge-danger { background: #FEE2E2; color: #991B1B; }
        .badge-warning { background: #FEF3C7; color: #92400E; }
        .badge-info { background: #DBEAFE; color: #1E40AF; }
        .badge-primary { background: #DBEAFE; color: #1E40AF; }
        .badge-secondary { background: #F1F5F9; color: #475569; }

        .status-dot {
            width: 7px;
            height: 7px;
            display: inline-block;
            margin-right: 6px;
        }
        .status-active { background: var(--success); }
        .status-inactive { background: #CBD5E1; }

        /* ========== PAGINATION ========== */
        .pagination-wrapper {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pagination-info {
            font-size: 12px;
            color: var(--text-light);
            font-weight: 500;
        }

        .pagination {
            display: flex;
            gap: 2px;
            list-style: none;
        }

        .pagination li a,
        .pagination li span {
            display: block;
            padding: 7px 13px;
            border: 1px solid var(--border-light);
            font-size: 12px;
            text-decoration: none;
            color: var(--text-body);
            font-weight: 600;
            transition: all 0.1s;
        }

        .pagination li a:hover {
            background: var(--body-bg);
        }

        .pagination li.active span {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .pagination li.disabled span {
            color: #CBD5E1;
            cursor: not-allowed;
        }

        /* ========== GRID ========== */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .col-12 { width: 100%; padding: 0 10px; }
        .col-lg-8 { width: 100%; padding: 0 10px; }
        .col-lg-4 { width: 33.333%; padding: 0 10px; }
        .col-md-6 { width: 50%; padding: 0 10px; }
        .col-md-12 { width: 100%; padding: 0 10px; }

        @media (max-width: 768px) {
            .col-lg-8, .col-lg-4, .col-md-6 {
                width: 100%;
            }
        }

        /* ========== UTILITIES ========== */
        .text-danger { color: var(--danger) !important; }
        .text-success { color: var(--success) !important; }
        .text-muted { color: var(--text-light) !important; }
        .text-primary { color: var(--primary) !important; }
        .text-center { text-align: center; }
        .text-end { text-align: end; }
        
        .d-flex { display: flex; }
        .flex-wrap { flex-wrap: wrap; }
        .align-items-center { align-items: center; }
        .justify-content-between { justify-content: space-between; }
        .justify-content-end { justify-content: flex-end; }
        .justify-content-center { justify-content: center; }
        
        .gap-1 { gap: 4px; }
        .gap-2 { gap: 8px; }
        .gap-3 { gap: 16px; }
        .gap-4 { gap: 24px; }
        
        .mt-1 { margin-top: 4px; }
        .mt-2 { margin-top: 8px; }
        .mt-3 { margin-top: 16px; }
        .mt-4 { margin-top: 24px; }
        .mb-1 { margin-bottom: 4px; }
        .mb-2 { margin-bottom: 8px; }
        .mb-3 { margin-bottom: 16px; }
        .mb-4 { margin-bottom: 24px; }
        
        .w-100 { width: 100%; }
        .d-none { display: none; }
        
        hr {
            border: none;
            border-top: 1px solid var(--border-light);
            margin: 20px 0;
        }

        small {
            font-size: 11px;
        }

        .fw-bold { font-weight: 700; }
        /* ========== SIDEBAR (Complete) ========== */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 260px;
    height: 100vh;
    background: #0A0F1A;
    z-index: 1040;
    overflow-y: auto;
    overflow-x: hidden;
    display: flex;
    flex-direction: column;
    border-right: 1px solid #1E2A3A;
}

.sidebar::-webkit-scrollbar { width: 3px; }
.sidebar::-webkit-scrollbar-track { background: transparent; }
.sidebar::-webkit-scrollbar-thumb { background: #2D3A4A; }

/* Sidebar Header */
.sidebar-header {
    padding: 22px 20px;
    border-bottom: 1px solid #1E2A3A;
    display: flex;
    align-items: center;
    gap: 12px;
}

.brand-icon {
    flex-shrink: 0;
    display: flex;
    align-items: center;
}

.brand-info {
    flex: 1;
    min-width: 0;
}

.brand-name {
    font-size: 15px;
    font-weight: 800;
    color: #FFFFFF;
    letter-spacing: 0.5px;
    line-height: 1.1;
}

.brand-subtitle {
    font-size: 9px;
    color: #64748B;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    font-weight: 600;
    margin-top: 2px;
}

/* Navigation */
.sidebar-nav {
    flex: 1;
    padding: 8px 0;
    overflow-y: auto;
}

.sidebar-nav::-webkit-scrollbar { width: 3px; }
.sidebar-nav::-webkit-scrollbar-thumb { background: #2D3A4A; }

/* Nav Divider */
.nav-divider {
    padding: 16px 20px 8px 20px;
}

.nav-divider span {
    font-size: 10px;
    font-weight: 700;
    color: #4B5563;
    text-transform: uppercase;
    letter-spacing: 1.5px;
}

/* Nav Link */
.nav-link {
    display: flex;
    align-items: center;
    padding: 10px 20px;
    margin: 1px 8px;
    color: #94A3B8;
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
    transition: all 0.2s ease;
    border-left: 2px solid transparent;
    position: relative;
}

.nav-link:hover {
    background: #111827;
    color: #E2E8F0;
    border-left-color: #4B5563;
}

.nav-link.active {
    background: #13203B;
    color: #60A5FA;
    border-left-color: #3B82F6;
    font-weight: 600;
}

.nav-link.disabled {
    opacity: 0.4;
    cursor: not-allowed;
    pointer-events: none;
}

/* Nav Icon */
.nav-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    margin-right: 12px;
    flex-shrink: 0;
}

.nav-icon svg {
    width: 18px;
    height: 18px;
}

/* Nav Label */
.nav-label {
    flex: 1;
}

/* Nav Count */
.nav-count {
    background: #1E2A3A;
    color: #94A3B8;
    font-size: 10px;
    font-weight: 700;
    padding: 2px 8px;
    letter-spacing: 0.5px;
    min-width: 20px;
    text-align: center;
}

.nav-link.active .nav-count {
    background: #1E3A5F;
    color: #60A5FA;
}

/* Nav Badge */
.nav-badge {
    background: #312E1A;
    color: #A0903A;
    font-size: 9px;
    font-weight: 700;
    padding: 2px 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Sidebar Footer */
.sidebar-footer {
    padding: 12px 20px;
    border-top: 1px solid #1E2A3A;
    margin-top: auto;
}

.footer-text {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    color: #4B5563;
    font-weight: 500;
}

/* Mobile Toggle */
.sidebar-toggle {
    display: none;
    position: fixed;
    top: 12px;
    left: 12px;
    z-index: 1050;
    width: 42px;
    height: 42px;
    background: #0A0F1A;
    color: white;
    border: 1px solid #1E2A3A;
    cursor: pointer;
    align-items: center;
    justify-content: center;
}

.sidebar-toggle:hover {
    background: #111827;
}

@media (max-width: 992px) {
    .sidebar {
        transform: translateX(-100%);
    }
    .sidebar.active {
        transform: translateX(0);
    }
    .sidebar-toggle {
        display: flex;
    }
}
/* ========== PAGINATION - SHARP DESIGN ========== */
.pagination-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 20px;
    border-top: 1px solid #E2E8F0;
}

.pagination-info {
    font-size: 11px;
    color: #94A3B8;
    font-weight: 500;
}

.pagination-info strong {
    color: #0F172A;
    font-weight: 700;
}

/* Navigation Container */
.pagination-nav {
    display: flex;
    align-items: center;
    gap: 2px;
}

/* Page Numbers */
.pagination-nav a,
.pagination-nav span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 32px;
    height: 32px;
    padding: 0 8px;
    border: 1px solid #E2E8F0;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    color: #475569;
    background: #FFFFFF;
    transition: all 0.15s;
}

.pagination-nav a:hover {
    background: #F1F5F9;
    border-color: #CBD5E1;
    color: #0F172A;
}

/* Active Page */
.pagination-nav .active {
    background: #3B82F6;
    border-color: #3B82F6;
    color: #FFFFFF;
}

/* Disabled State */
.pagination-nav .disabled {
    color: #CBD5E1;
    background: #F8FAFC;
    cursor: not-allowed;
}

/* Previous/Next Buttons */
.pagination-nav .prev-btn,
.pagination-nav .next-btn {
    min-width: 32px;
    padding: 0 10px;
}

.pagination-nav .prev-btn svg,
.pagination-nav .next-btn svg {
    width: 14px;
    height: 14px;
}

/* Hide text for small screens */
.pagination-nav .btn-text {
    display: inline;
}

@media (max-width: 640px) {
    .pagination-nav .btn-text {
        display: none;
    }
}

/* Override Tailwind Pagination */
nav[role="navigation"] .flex {
    gap: 2px;
}

nav[role="navigation"] svg {
    width: 14px !important;
    height: 14px !important;
}

nav[role="navigation"] .rounded-md,
nav[role="navigation"] .rounded-l-md,
nav[role="navigation"] .rounded-r-md {
    border-radius: 0 !important;
}

nav[role="navigation"] .shadow-sm {
    box-shadow: none !important;
}

/* Pagination number buttons */
nav[role="navigation"] a,
nav[role="navigation"] span[aria-current="page"] {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    min-width: 32px !important;
    height: 32px !important;
    padding: 0 10px !important;
    border: 1px solid #E2E8F0 !important;
    font-size: 12px !important;
    font-weight: 600 !important;
    text-decoration: none !important;
    color: #475569 !important;
    background: #FFFFFF !important;
    margin-left: 0 !important;
}

nav[role="navigation"] a:hover {
    background: #F1F5F9 !important;
    border-color: #CBD5E1 !important;
    color: #0F172A !important;
}

nav[role="navigation"] span[aria-current="page"] {
    background: #3B82F6 !important;
    border-color: #3B82F6 !important;
    color: #FFFFFF !important;
}

/* Disabled arrows */
nav[role="navigation"] span[aria-disabled="true"] {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    min-width: 32px !important;
    height: 32px !important;
    padding: 0 10px !important;
    border: 1px solid #E2E8F0 !important;
    color: #CBD5E1 !important;
    background: #F8FAFC !important;
}

/* Arrow buttons */
nav[role="navigation"] a[rel="prev"],
nav[role="navigation"] a[rel="next"] {
    min-width: 32px !important;
    padding: 0 10px !important;
}

/* Hide Tailwind text on mobile */
nav[role="navigation"] .sm\\:hidden {
    display: none !important;
}

/* Show only numbers and arrows */
nav[role="navigation"] .sm\\:flex-1 {
    display: flex !important;
    gap: 2px !important;
    align-items: center !important;
}

/* Hide "Showing X to Y of Z" duplicate text */
nav[role="navigation"] p.text-sm {
    display: none !important;
}
.col-lg-8 {
    width: 100%;
    margin: 0 auto;
}

/* ========================================== */
/* DARK MODE - COMPLETE */
/* ========================================== */
body.dark-mode {
    --body-bg: #0F172A;
    --card-bg: #1E293B;
    --card-border: #334155;
    --text-primary: #F1F5F9;
    --text-secondary: #CBD5E1;
    --text-muted: #94A3B8;
    --topbar-bg: #1E293B;
    --topbar-border: #334155;
    --input-bg: #1A2332;
    --input-border: #334155;
}

/* Background */
body.dark-mode .main-content,
body.dark-mode .page-content {
    background: var(--body-bg) !important;
}

body.dark-mode {
    background: var(--body-bg) !important;
}

/* Cards */
body.dark-mode .card,
body.dark-mode .stat-card,
body.dark-mode .info-card,
body.dark-mode .form-card,
body.dark-mode .table-card,
body.dark-mode .settings-card,
body.dark-mode .detail-card,
body.dark-mode .report-card,
body.dark-mode .supplier-card,
body.dark-mode .customer-card {
    background: var(--card-bg) !important;
    border-color: var(--card-border) !important;
}

/* Card Headers */
body.dark-mode .card-header,
body.dark-mode .form-header,
body.dark-mode .settings-header,
body.dark-mode .detail-header,
body.dark-mode .report-card-header,
body.dark-mode .card-header-row,
body.dark-mode .info-card-header {
    border-color: var(--card-border) !important;
    background: var(--card-bg) !important;
}

body.dark-mode .card-header h5,
body.dark-mode .form-header-title,
body.dark-mode .settings-header,
body.dark-mode .detail-header,
body.dark-mode .report-card-header,
body.dark-mode .info-card-title,
body.dark-mode .brand-name,
body.dark-mode .category-name,
body.dark-mode .product-name,
body.dark-mode .customer-name,
body.dark-mode .supplier-name {
    color: var(--text-primary) !important;
}

/* Top Bar */
body.dark-mode .top-bar {
    background: var(--topbar-bg) !important;
    border-color: var(--topbar-border) !important;
}

body.dark-mode .top-bar h4,
body.dark-mode .top-bar-left h4 {
    color: #F1F5F9 !important;
}

body.dark-mode .top-bar .subtitle,
body.dark-mode .top-bar .text-muted {
    color: #94A3B8 !important;
}

/* Tables */
body.dark-mode .table {
    background: var(--card-bg) !important;
}

body.dark-mode .table th {
    background: #1A2332 !important;
    color: #94A3B8 !important;
    border-color: #334155 !important;
}

body.dark-mode .table td {
    color: #E2E8F0 !important;
    border-color: #334155 !important;
}

body.dark-mode .table tbody tr:hover {
    background: #1A2332 !important;
}

body.dark-mode .table tbody tr:nth-child(even) {
    background: #1A2332;
}

/* Forms */
body.dark-mode .form-input,
body.dark-mode .form-select,
body.dark-mode .form-textarea {
    background: var(--input-bg) !important;
    border-color: var(--input-border) !important;
    color: #E2E8F0 !important;
}

body.dark-mode .form-input:focus,
body.dark-mode .form-select:focus,
body.dark-mode .form-textarea:focus {
    border-color: #3B82F6 !important;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.15) !important;
}

body.dark-mode .form-input::placeholder,
body.dark-mode .form-textarea::placeholder {
    color: #64748B !important;
}

body.dark-mode .form-label {
    color: #CBD5E1 !important;
}

body.dark-mode .form-hint {
    color: #64748B !important;
}

/* Labels & Text */
body.dark-mode .info-label {
    color: #94A3B8 !important;
}

body.dark-mode .info-value {
    color: #E2E8F0 !important;
}

body.dark-mode .info-value.success {
    color: #34D399 !important;
}

body.dark-mode .info-value.danger {
    color: #F87171 !important;
}

body.dark-mode .text-muted {
    color: #94A3B8 !important;
}

body.dark-mode .stat-label {
    color: #94A3B8 !important;
}

body.dark-mode .stat-value {
    color: #F1F5F9 !important;
}

/* Stat Cards */
body.dark-mode .stat-card:hover {
    border-color: #3B82F6 !important;
}

/* Customer/Supplier Cards */
body.dark-mode .customer-card:hover,
body.dark-mode .supplier-card:hover {
    border-color: #3B82F6 !important;
    background: #1A2332 !important;
}

/* Status Badges */
body.dark-mode .status-badge.active {
    background: #064E3B !important;
    color: #34D399 !important;
}

body.dark-mode .status-badge.inactive {
    background: #1A2332 !important;
    color: #64748B !important;
}

/* Role Badges */
body.dark-mode .role-badge.role-admin {
    background: #7F1D1D !important;
    color: #FCA5A5 !important;
}

body.dark-mode .role-badge.role-manager {
    background: #78350F !important;
    color: #FCD34D !important;
}

/* Buttons */
body.dark-mode .btn-cancel {
    background: #1E293B !important;
    border-color: #334155 !important;
    color: #CBD5E1 !important;
}

body.dark-mode .btn-cancel:hover {
    background: #334155 !important;
}

body.dark-mode .btn-icon {
    background: #1E293B !important;
    border-color: #334155 !important;
}

body.dark-mode .btn-icon svg {
    stroke: #CBD5E1 !important;
}

/* Pagination */
body.dark-mode .pagination li a,
body.dark-mode .pagination li span {
    background: #1E293B !important;
    border-color: #334155 !important;
    color: #CBD5E1 !important;
}

body.dark-mode .pagination li a:hover {
    background: #334155 !important;
}

body.dark-mode .pagination li.active span {
    background: #3B82F6 !important;
    border-color: #3B82F6 !important;
    color: #FFF !important;
}

/* Dropdown */
body.dark-mode .dropdown-menu {
    background: #1E293B !important;
    border-color: #334155 !important;
}

body.dark-mode .dropdown-item {
    color: #E2E8F0 !important;
}

body.dark-mode .dropdown-item:hover {
    background: #334155 !important;
}

body.dark-mode .dropdown-divider {
    border-color: #334155 !important;
}

/* User Dropdown */
body.dark-mode .user-dropdown:hover {
    background: #1E293B !important;
}

body.dark-mode .user-name {
    color: #F1F5F9 !important;
}

/* Alert */
body.dark-mode .alert-success {
    background: #064E3B !important;
    border-color: #065F46 !important;
    color: #6EE7B7 !important;
}

body.dark-mode .alert-danger {
    background: #7F1D1D !important;
    border-color: #991B1B !important;
    color: #FCA5A5 !important;
}

/* Settings */
body.dark-mode .settings-card,
body.dark-mode .settings-body {
    background: var(--card-bg) !important;
}

/* Activity */
body.dark-mode .activity-title {
    color: #E2E8F0 !important;
}

body.dark-mode .activity-sub {
    color: #94A3B8 !important;
}

/* Info Row */
body.dark-mode .info-row {
    border-color: #334155 !important;
}

/* Hr */
body.dark-mode hr {
    border-color: #334155 !important;
}

/* Section Title */
body.dark-mode .section-title,
body.dark-mode .form-section-title {
    color: #94A3B8 !important;
    border-color: #334155 !important;
}

/* File Upload */
body.dark-mode .file-upload-area,
body.dark-mode .file-upload-box {
    background: #1A2332 !important;
    border-color: #334155 !important;
}

body.dark-mode .file-upload-text {
    color: #CBD5E1 !important;
}

/* Status Toggle */
body.dark-mode .status-toggle {
    background: #1A2332 !important;
    border-color: #334155 !important;
}

body.dark-mode .toggle-label {
    color: #CBD5E1 !important;
}

/* Checkbox */
body.dark-mode .checkbox-group {
    background: #1A2332 !important;
    border-color: #334155 !important;
}

body.dark-mode .checkbox-label {
    color: #CBD5E1 !important;
}

/* Info Alert */
body.dark-mode .info-alert {
    background: #1E3A5F !important;
    border-color: #1E4D8C !important;
}

body.dark-mode .info-alert-text {
    color: #93C5FD !important;
}

/* Empty State */
body.dark-mode .empty-state {
    background: var(--card-bg) !important;
    border-color: var(--card-border) !important;
}

body.dark-mode .empty-icon,
body.dark-mode .empty-icon-box {
    background: #1A2332 !important;
}

body.dark-mode .empty-title {
    color: #E2E8F0 !important;
}

body.dark-mode .empty-desc {
    color: #94A3B8 !important;
}

/* Brand/Product/Category specific */
body.dark-mode .category-slug,
body.dark-mode .brand-slug {
    color: #94A3B8 !important;
}

body.dark-mode .supplier-company,
body.dark-mode .customer-email,
body.dark-mode .customer-contact {
    color: #94A3B8 !important;
}

/* Sidebar stays dark always */
body.dark-mode .sidebar {
    background: #060B14 !important;
    border-color: #1A2332 !important;
}

/* Mobile Toggle */
body.dark-mode .sidebar-toggle {
    background: #1E293B !important;
    border-color: #334155 !important;
}

/* POS specific */
body.dark-mode .pos-wrapper {
    background: #0F172A !important;
}

body.dark-mode .pos-products {
    background: #0F172A !important;
}

body.dark-mode .pos-topbar,
body.dark-mode .pos-pagination {
    background: #1E293B !important;
    border-color: #334155 !important;
}

body.dark-mode .pos-cart {
    background: #1E293B !important;
    border-color: #334155 !important;
}

body.dark-mode .product-card {
    background: #1E293B !important;
    border-color: #334155 !important;
}

body.dark-mode .product-card:hover {
    border-color: #3B82F6 !important;
}

body.dark-mode .pc-name {
    color: #E2E8F0 !important;
}

body.dark-mode .cart-header,
body.dark-mode .cart-footer,
body.dark-mode .cart-customer {
    background: #1A2332 !important;
    border-color: #334155 !important;
}

body.dark-mode .cart-title {
    color: #F1F5F9 !important;
}

body.dark-mode .cart-item-row {
    border-color: #334155 !important;
}

body.dark-mode .cart-item-row:hover {
    background: #1A2332 !important;
}

body.dark-mode .cart-item-name {
    color: #E2E8F0 !important;
}

body.dark-mode .cart-item-total {
    color: #F1F5F9 !important;
}

body.dark-mode .qty-group {
    border-color: #334155 !important;
    background: #0F172A !important;
}

body.dark-mode .qty-btn {
    background: #1A2332 !important;
    color: #CBD5E1 !important;
}

body.dark-mode .qty-value {
    color: #F1F5F9 !important;
}

body.dark-mode .summary-row {
    color: #94A3B8 !important;
}

body.dark-mode .total-label,
body.dark-mode .total-value {
    color: #F1F5F9 !important;
}

body.dark-mode .payment-option {
    background: #1A2332 !important;
    border-color: #334155 !important;
    color: #94A3B8 !important;
}

body.dark-mode .payment-option.active {
    background: #1E3A5F !important;
    border-color: #3B82F6 !important;
    color: #60A5FA !important;
}

body.dark-mode .paid-input {
    background: #0F172A !important;
    border-color: #334155 !important;
    color: #F1F5F9 !important;
}

/* Collapsible Sidebar */
:root {
    --sidebar-width: 260px;
    --sidebar-collapsed-width: 70px;
}

.sidebar {
    width: var(--sidebar-width);
    transition: width 0.25s ease;
}

.sidebar.collapsed {
    width: var(--sidebar-collapsed-width);
}

.sidebar.collapsed .brand-name,
.sidebar.collapsed .brand-subtitle,
.sidebar.collapsed .brand-version,
.sidebar.collapsed .nav-label,
.sidebar.collapsed .nav-count,
.sidebar.collapsed .nav-badge,
.sidebar.collapsed .nav-arrow,
.sidebar.collapsed .nav-indicator,
.sidebar.collapsed .nav-divider span,
.sidebar.collapsed .sidebar-footer-wrap {
    display: none !important;
}

.sidebar.collapsed .brand-info {
    display: none;
}

.sidebar.collapsed .sidebar-header {
    justify-content: center;
    padding: 16px 10px;
}

.sidebar.collapsed .nav-link {
    justify-content: center;
    padding: 12px 10px;
}

.sidebar.collapsed .nav-icon {
    margin-right: 0;
}

.sidebar.collapsed .nav-link:hover .nav-label {
    display: block !important;
    position: absolute;
    left: 100%;
    top: 0;
    background: #0F172A;
    color: #FFF;
    padding: 10px 14px;
    white-space: nowrap;
    z-index: 1000;
    border: 1px solid #1E2A3A;
}

/* Main content margin */
.main-content {
    margin-left: var(--sidebar-width);
    transition: margin 0.25s ease;
}

.sidebar.collapsed ~ .main-content {
    margin-left: var(--sidebar-collapsed-width);
}

.sidebar-toggle-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
}

@media (max-width: 992px) {
    .sidebar.collapsed ~ .main-content {
        margin-left: 0;
    }
}
    </style>

    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    @include('layouts.sidebar')

<!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="top-bar-left">
                <h4>@yield('page-title', 'Dashboard')</h4>
                <div class="subtitle">@yield('page-subtitle', 'Business Overview')</div>
            </div>
            <div class="top-bar-right">

                <!-- Notification Bell - All Alerts in One -->
                <!-- Dark/Light Toggle -->
                <button class="btn-icon" onclick="toggleTheme()" title="Toggle Theme" id="themeToggle">
                    <svg id="themeIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                    </svg>
                </button>
                <div class="dropdown" style="position: relative;">
                    <button class="btn-icon" title="Notifications" onclick="toggleNotifDropdown()">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                        </svg>
                        @php 
                            $lowStockCount = \App\Models\Product::whereColumn('stock_quantity', '<=', 'min_stock_quantity')->where('stock_quantity', '>', 0)->count();
                            $outOfStock = \App\Models\Product::where('stock_quantity', 0)->count();
                            $totalAlerts = $lowStockCount + $outOfStock;
                        @endphp
                        @if($totalAlerts > 0)
                            <span style="position:absolute;top:-4px;right:-4px;background:#EF4444;color:#FFF;font-size:9px;font-weight:700;min-width:16px;height:16px;display:flex;align-items:center;justify-content:center;padding:0 4px;">{{ $totalAlerts }}</span>
                        @endif
                    </button>
                    
                    <!-- Dropdown -->
                    <div id="notifDropdown" style="display:none;position:absolute;top:100%;right:0;background:#FFF;border:1px solid #E2E8F0;min-width:280px;z-index:1050;box-shadow:0 10px 30px rgba(0,0,0,0.1);">
                        <div style="padding:12px 16px;border-bottom:1px solid #E2E8F0;font-size:12px;font-weight:700;color:#0F172A;">Notifications</div>
                        
                        @if($lowStockCount > 0)
                            <a href="{{ route('admin.inventory.index') }}" style="display:flex;align-items:center;gap:10px;padding:10px 16px;text-decoration:none;border-bottom:1px solid #F1F5F9;">
                                <span style="width:8px;height:8px;background:#F59E0B;flex-shrink:0;"></span>
                                <span style="font-size:12px;color:#475569;">{{ $lowStockCount }} products low on stock</span>
                            </a>
                        @endif
                        
                        @if($outOfStock > 0)
                            <a href="{{ route('admin.inventory.index') }}" style="display:flex;align-items:center;gap:10px;padding:10px 16px;text-decoration:none;border-bottom:1px solid #F1F5F9;">
                                <span style="width:8px;height:8px;background:#EF4444;flex-shrink:0;"></span>
                                <span style="font-size:12px;color:#475569;">{{ $outOfStock }} products out of stock</span>
                            </a>
                        @endif
                        
                        @if($totalAlerts == 0)
                            <div style="padding:20px;text-align:center;font-size:12px;color:#94A3B8;">No new notifications</div>
                        @endif
                    </div>
                </div>

<script>
    function toggleNotifDropdown() {
        var d = document.getElementById('notifDropdown');
        d.style.display = d.style.display === 'none' ? 'block' : 'none';
    }
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            document.getElementById('notifDropdown').style.display = 'none';
        }
    });
</script>


                <!-- User Dropdown -->
                <div class="dropdown" style="position: relative;">
                    <div class="user-dropdown" onclick="toggleDropdown()">
                        <div class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="user-info d-none d-md-block">
                            <div class="user-name">{{ Auth::user()->name }}</div>
                            <div class="user-role">{{ ucfirst(str_replace('_', ' ', Auth::user()->role ?? 'admin')) }}</div>
                        </div>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#64748B" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </div>
                    <div class="dropdown-menu" id="userDropdown">
                        <a href="#" class="dropdown-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                            Profile
                        </a>
        <!-- Settings -->
        @if(Route::has('admin.settings.index'))
        <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
                </svg>
            </span>
            <span class="nav-label">Settings</span>
        </a>
        @endif
                        <hr class="dropdown-divider">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                    <polyline points="16 17 21 12 16 7"/>
                                    <line x1="21" y1="12" x2="9" y2="12"/>
                                </svg>
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="page-content">
            <!-- Alerts -->
            @if(session('success'))
                <div class="alert alert-success">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    {{ session('success') }}
                    <span class="alert-dismiss" onclick="this.parentElement.remove()">&times;</span>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="15" y1="9" x2="9" y2="15"/>
                        <line x1="9" y1="9" x2="15" y2="15"/>
                    </svg>
                    {{ session('error') }}
                    <span class="alert-dismiss" onclick="this.parentElement.remove()">&times;</span>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Mobile Sidebar Toggle -->
    <button class="sidebar-toggle" onclick="document.getElementById('sidebar').classList.toggle('active')">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
            <line x1="3" y1="12" x2="21" y2="12"/>
            <line x1="3" y1="6" x2="21" y2="6"/>
            <line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
    </button>

    <script>
        // Dropdown Toggle
        function toggleDropdown() {
            document.getElementById('userDropdown').classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.dropdown')) {
                document.getElementById('userDropdown').classList.remove('show');
            }
        });

        // Delete Confirmation
        function confirmDelete(formId) {
            if (confirm('Are you sure you want to delete this? This action cannot be undone.')) {
                document.getElementById(formId).submit();
            }
        }
    </script>

    @stack('scripts')
    <script>
    // Check saved theme
    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-mode');
    }

    function toggleTheme() {
        document.body.classList.toggle('dark-mode');
        
        // Save preference
        if (document.body.classList.contains('dark-mode')) {
            localStorage.setItem('theme', 'dark');
        } else {
            localStorage.setItem('theme', 'light');
        }
        
        updateThemeIcon();
    }

    function updateThemeIcon() {
        var icon = document.getElementById('themeIcon');
        if (document.body.classList.contains('dark-mode')) {
            icon.innerHTML = '<circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>';
        } else {
            icon.innerHTML = '<path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>';
        }
    }

    // Initial icon
    updateThemeIcon();
</script>
</body>
</html>