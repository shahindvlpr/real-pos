@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Business Overview')

@push('styles')
<style>
    /* ========== STAT CARDS ========== */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin-bottom: 16px;
    }

    .stat-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 14px;
        transition: all 0.15s;
        position: relative;
        overflow: hidden;
    }

    .stat-card::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 3px;
        height: 100%;
    }

    .stat-card.blue::after { background: #3B82F6; }
    .stat-card.green::after { background: #10B981; }
    .stat-card.purple::after { background: #8B5CF6; }
    .stat-card.amber::after { background: #F59E0B; }

    .stat-card:hover {
        border-color: #CBD5E1;
        transform: translateX(2px);
    }

    .stat-icon-box {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon-box.blue { background: #EFF6FF; color: #3B82F6; }
    .stat-icon-box.green { background: #ECFDF5; color: #10B981; }
    .stat-icon-box.purple { background: #F5F3FF; color: #8B5CF6; }
    .stat-icon-box.amber { background: #FFFBEB; color: #F59E0B; }

    .stat-icon-box svg {
        width: 18px;
        height: 18px;
    }

    .stat-info {
        flex: 1;
        min-width: 0;
    }

    .stat-value {
        font-size: 22px;
        font-weight: 800;
        color: #0F172A;
        line-height: 1;
        margin-bottom: 2px;
        letter-spacing: -0.5px;
    }

    .stat-label {
        font-size: 10px;
        color: #94A3B8;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    /* ========== WELCOME BANNER ========== */
    .welcome-banner {
        background: #0A0F1A;
        padding: 32px 36px;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 32px;
        border: 1px solid #1E2A3A;
        position: relative;
        overflow: hidden;
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -30%;
        right: -5%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(59,130,246,0.06) 0%, transparent 70%);
    }

    .welcome-banner::after {
        content: '';
        position: absolute;
        bottom: -20%;
        left: 10%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(139,92,246,0.04) 0%, transparent 70%);
    }

    .welcome-left {
        position: relative;
        z-index: 1;
        flex: 1;
    }

    .welcome-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(59,130,246,0.15);
        color: #60A5FA;
        font-size: 10px;
        font-weight: 700;
        padding: 4px 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }

    .welcome-badge .dot {
        width: 6px;
        height: 6px;
        background: #3B82F6;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.3; }
    }

    .welcome-title {
        font-size: 22px;
        font-weight: 800;
        color: #FFFFFF;
        margin-bottom: 6px;
        letter-spacing: -0.3px;
    }

    .welcome-desc {
        font-size: 12px;
        color: #94A3B8;
        font-weight: 500;
        max-width: 450px;
        line-height: 1.6;
    }

    .welcome-right {
        position: relative;
        z-index: 1;
        display: flex;
        gap: 10px;
    }

    .quick-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        color: #E2E8F0;
        padding: 10px 18px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-decoration: none;
        transition: all 0.2s;
        white-space: nowrap;
    }

    .quick-btn:hover {
        background: rgba(255,255,255,0.1);
        border-color: rgba(255,255,255,0.2);
        color: #FFFFFF;
    }

    .quick-btn svg {
        width: 14px;
        height: 14px;
    }

    /* ========== INFO GRID ========== */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .info-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        padding: 20px;
    }

    .info-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 14px;
        padding-bottom: 12px;
        border-bottom: 1px solid #F1F5F9;
    }

    .info-card-title {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: #94A3B8;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 7px 0;
    }

    .info-row:not(:last-child) {
        border-bottom: 1px solid #F8FAFC;
    }

    .info-label {
        font-size: 12px;
        color: #64748B;
        font-weight: 500;
    }

    .info-value {
        font-size: 12px;
        font-weight: 700;
        color: #0F172A;
    }

    .info-value.danger {
        color: #EF4444;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-dot {
        width: 6px;
        height: 6px;
    }

    .status-dot.green { background: #10B981; }
    .status-dot.blue { background: #3B82F6; }
    .status-dot.amber { background: #F59E0B; }

    /* ========== ACTIVITY ========== */
    .activity-item {
        display: flex;
        gap: 10px;
        padding: 8px 0;
    }

    .activity-item:not(:last-child) {
        border-bottom: 1px solid #F8FAFC;
    }

    .activity-line {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex-shrink: 0;
    }

    .activity-dot {
        width: 8px;
        height: 8px;
        flex-shrink: 0;
    }

    .activity-dot.blue { background: #3B82F6; }
    .activity-dot.green { background: #10B981; }
    .activity-dot.amber { background: #F59E0B; }

    .activity-content {
        flex: 1;
        min-width: 0;
    }

    .activity-title {
        font-size: 12px;
        font-weight: 600;
        color: #0F172A;
        line-height: 1.3;
    }

    .activity-time {
        font-size: 10px;
        color: #94A3B8;
        font-weight: 500;
        margin-top: 1px;
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 1200px) {
        .stat-grid { grid-template-columns: repeat(2, 1fr); }
        .info-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .stat-grid { grid-template-columns: 1fr; }
        .info-grid { grid-template-columns: 1fr; }
        .welcome-banner { flex-direction: column; text-align: center; }
        .welcome-right { justify-content: center; }
        .welcome-desc { max-width: 100%; }
    }
</style>
@endpush

@section('content')
    <!-- Stats Row -->
    <div class="stat-grid">
        <!-- Today's Sales -->
        <div class="stat-card blue">
            <div class="stat-icon-box blue">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="1" x2="12" y2="23"/>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">৳ 0</div>
                <div class="stat-label">Today's Sales</div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="stat-card green">
            <div class="stat-icon-box green">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="12 2 22 8 12 14 2 8 12 2"/>
                    <polyline points="2 8 12 14 22 8"/>
                    <polyline points="12 14 22 8 22 18 12 22 2 18 2 8"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ \App\Models\Product::count() }}</div>
                <div class="stat-label">Products</div>
            </div>
        </div>

        <!-- Categories -->
        <div class="stat-card purple">
            <div class="stat-icon-box purple">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7"/>
                    <rect x="14" y="3" width="7" height="7"/>
                    <rect x="3" y="14" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ \App\Models\Category::count() }}</div>
                <div class="stat-label">Categories</div>
            </div>
        </div>

        <!-- Brands -->
        <div class="stat-card amber">
            <div class="stat-icon-box amber">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="7" cy="7" r="3"/>
                    <circle cx="17" cy="7" r="3"/>
                    <path d="M5 12l2 10h10l2-10"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ \App\Models\Brand::count() }}</div>
                <div class="stat-label">Brands</div>
            </div>
        </div>
    </div>

    <!-- Welcome Banner -->
    <div class="welcome-banner">
        <div class="welcome-left">
            <div class="welcome-badge">
                <span class="dot"></span>
                System Active
            </div>
            <h2 class="welcome-title">Welcome to Real POS</h2>
            <p class="welcome-desc">
                Manage products, track inventory, process sales, and grow your business with our powerful point of sale system.
            </p>
        </div>
        <div class="welcome-right">
            <a href="{{ route('categories.index') }}" class="quick-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Category
            </a>
            <a href="#" class="quick-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Product
            </a>
        </div>
    </div>

    <!-- Info Grid -->
    <div class="info-grid">
        <!-- System Info -->
        <div class="info-card">
            <div class="info-card-header">
                <span class="info-card-title">System</span>
                <span class="status-badge">
                    <span class="status-dot green"></span>
                    Online
                </span>
            </div>
            <div class="info-row">
                <span class="info-label">Laravel</span>
                <span class="info-value">{{ app()->version() }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">PHP</span>
                <span class="info-value">{{ phpversion() }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Database</span>
                <span class="info-value">MySQL</span>
            </div>
            <div class="info-row">
                <span class="info-label">Timezone</span>
                <span class="info-value">{{ config('app.timezone') }}</span>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="info-card">
            <div class="info-card-header">
                <span class="info-card-title">Statistics</span>
                <span class="status-badge">
                    <span class="status-dot blue"></span>
                    Live
                </span>
            </div>
            <div class="info-row">
                <span class="info-label">Users</span>
                <span class="info-value">{{ \App\Models\User::count() }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Active Products</span>
                <span class="info-value">{{ \App\Models\Product::where('is_active', true)->count() }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Stock Alerts</span>
                <span class="info-value danger">0 Low</span>
            </div>
            <div class="info-row">
                <span class="info-label">Today Orders</span>
                <span class="info-value">0</span>
            </div>
        </div>

        <!-- Activity -->
        <div class="info-card">
            <div class="info-card-header">
                <span class="info-card-title">Activity</span>
                <span class="status-badge">
                    <span class="status-dot amber"></span>
                    Recent
                </span>
            </div>
            <div class="activity-item">
                <div class="activity-line">
                    <div class="activity-dot blue"></div>
                </div>
                <div class="activity-content">
                    <div class="activity-title">System Installed</div>
                    <div class="activity-time">Real POS is ready</div>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-line">
                    <div class="activity-dot green"></div>
                </div>
                <div class="activity-content">
                    <div class="activity-title">Database Configured</div>
                    <div class="activity-time">Tables migrated</div>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-line">
                    <div class="activity-dot amber"></div>
                </div>
                <div class="activity-content">
                    <div class="activity-title">Setup Required</div>
                    <div class="activity-time">Add categories & products</div>
                </div>
            </div>
        </div>
    </div>
@endsection