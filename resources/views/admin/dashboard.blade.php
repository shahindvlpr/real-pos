@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Business Overview')

@push('styles')
<style>
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
        margin-bottom: 14px;
    }

    .stat-card {
        background: #FFF;
        border: 1px solid #E2E8F0;
        padding: 14px 18px;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all 0.15s;
        position: relative;
        overflow: hidden;
    }

    .stat-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
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
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon-box.blue { background: #EFF6FF; color: #3B82F6; }
    .stat-icon-box.green { background: #ECFDF5; color: #10B981; }
    .stat-icon-box.purple { background: #F5F3FF; color: #8B5CF6; }
    .stat-icon-box.amber { background: #FFFBEB; color: #F59E0B; }

    .stat-icon-box svg { width: 18px; height: 18px; }

    .stat-info { flex: 1; min-width: 0; }

    .stat-value {
        font-size: 20px;
        font-weight: 800;
        color: #0F172A;
        line-height: 1;
        margin-bottom: 2px;
        letter-spacing: -0.3px;
    }

    .stat-label {
        font-size: 9px;
        color: #94A3B8;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
    }

    /* Welcome Banner */
    .welcome-banner {
        background: #0A0F1A;
        padding: 22px 28px;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        border: 1px solid #1E2A3A;
        position: relative;
        overflow: hidden;
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -5%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(59,130,246,0.04) 0%, transparent 70%);
    }

    .welcome-left { position: relative; z-index: 1; flex: 1; }

    .welcome-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: rgba(16,185,129,0.12);
        color: #34D399;
        font-size: 9px;
        font-weight: 700;
        padding: 3px 10px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 8px;
    }

    .welcome-badge .dot {
        width: 5px;
        height: 5px;
        background: #10B981;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.3; }
    }

    .welcome-title {
        font-size: 18px;
        font-weight: 800;
        color: #FFF;
        margin-bottom: 2px;
    }

    .welcome-desc {
        font-size: 10px;
        color: #94A3B8;
        font-weight: 500;
        max-width: 400px;
        line-height: 1.5;
    }

    .welcome-right {
        position: relative;
        z-index: 1;
        display: flex;
        gap: 6px;
    }

    .quick-btn {
        display: flex;
        align-items: center;
        gap: 5px;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.06);
        color: #E2E8F0;
        padding: 8px 14px;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        text-decoration: none;
        transition: all 0.15s;
    }

    .quick-btn:hover {
        background: rgba(255,255,255,0.08);
        border-color: rgba(255,255,255,0.15);
        color: #FFF;
    }

    .quick-btn svg { width: 12px; height: 12px; }

    /* Bottom Grid */
    .bottom-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .info-card {
        background: #FFF;
        border: 1px solid #E2E8F0;
        padding: 16px 18px;
    }

    .info-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        padding-bottom: 10px;
        border-bottom: 1px solid #F1F5F9;
    }

    .info-card-title {
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #94A3B8;
    }

    .status-dot { width: 5px; height: 5px; }
    .status-dot.green { background: #10B981; }
    .status-dot.blue { background: #3B82F6; }
    .status-dot.amber { background: #F59E0B; }
    .status-dot.red { background: #EF4444; }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 8px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 6px 0;
    }

    .info-row:not(:last-child) { border-bottom: 1px solid #F8FAFC; }

    .info-label { font-size: 10px; color: #64748B; font-weight: 500; }
    .info-value { font-size: 11px; font-weight: 700; color: #0F172A; }
    .info-value.danger { color: #EF4444; }
    .info-value.success { color: #10B981; }

    /* Activity */
    .activity-item {
        display: flex;
        gap: 8px;
        padding: 7px 0;
        align-items: flex-start;
    }

    .activity-item:not(:last-child) { border-bottom: 1px solid #F8FAFC; }

    .activity-dot {
        width: 6px;
        height: 6px;
        flex-shrink: 0;
        margin-top: 4px;
    }

    .activity-dot.green { background: #10B981; }
    .activity-dot.amber { background: #F59E0B; }
    .activity-dot.blue { background: #3B82F6; }

    .activity-content { flex: 1; min-width: 0; }

    .activity-title {
        font-size: 11px;
        font-weight: 600;
        color: #0F172A;
        line-height: 1.3;
    }

    .activity-sub {
        font-size: 9px;
        color: #94A3B8;
        font-weight: 500;
    }

    .activity-amount {
        font-size: 11px;
        font-weight: 700;
        color: #10B981;
        flex-shrink: 0;
    }

    @media (max-width: 1200px) {
        .stat-grid { grid-template-columns: repeat(2, 1fr); }
        .bottom-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .stat-grid { grid-template-columns: 1fr; }
        .bottom-grid { grid-template-columns: 1fr; }
        .welcome-banner { flex-direction: column; text-align: center; }
    }
</style>
@endpush

@section('content')
<!-- Stats Row -->
<div class="stat-grid">
    <div class="stat-card blue">
        <div class="stat-icon-box blue">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
            </svg>
        </div>
        <div class="stat-info">
            <div class="stat-value">৳ {{ number_format($todaySales, 0) }}</div>
            <div class="stat-label">Today's Sales</div>
        </div>
    </div>

    <div class="stat-card green">
        <div class="stat-icon-box green">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
            </svg>
        </div>
        <div class="stat-info">
            <div class="stat-value">৳ {{ number_format($monthlySales, 0) }}</div>
            <div class="stat-label">Monthly Sales</div>
        </div>
    </div>

    <div class="stat-card purple">
        <div class="stat-icon-box purple">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polygon points="12 2 22 8 12 14 2 8 12 2"/><polyline points="2 8 12 14 22 8"/>
            </svg>
        </div>
        <div class="stat-info">
            <div class="stat-value">{{ $totalProducts }}</div>
            <div class="stat-label">Products</div>
        </div>
    </div>

    <div class="stat-card amber">
        <div class="stat-icon-box amber">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>
            </svg>
        </div>
        <div class="stat-info">
            <div class="stat-value">{{ $totalCustomers }}</div>
            <div class="stat-label">Customers</div>
        </div>
    </div>
</div>

<!-- Welcome Banner -->
<div class="welcome-banner">
    <div class="welcome-left">
        <div class="welcome-badge"><span class="dot"></span>System Active</div>
        <h2 class="welcome-title">Welcome to Real POS</h2>
        <p class="welcome-desc">Manage products, track inventory, process sales, and grow your business.</p>
    </div>
    <div class="welcome-right">
        <a href="{{ route('pos.index') }}" class="quick-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
            POS
        </a>
        <a href="{{ route('products.index') }}" class="quick-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
            Products
        </a>
    </div>
</div>

<!-- Bottom Grid -->
<div class="bottom-grid">
    <!-- System -->
    <div class="info-card">
        <div class="info-card-header">
            <span class="info-card-title">System</span>
            <span class="status-badge"><span class="status-dot green"></span>Online</span>
        </div>
        <div class="info-row"><span class="info-label">Laravel</span><span class="info-value">{{ app()->version() }}</span></div>
        <div class="info-row"><span class="info-label">PHP</span><span class="info-value">{{ phpversion() }}</span></div>
        <div class="info-row"><span class="info-label">Database</span><span class="info-value">MySQL</span></div>
        <div class="info-row"><span class="info-label">Total Sales</span><span class="info-value success">৳ {{ number_format($totalSalesAmount, 0) }}</span></div>
    </div>

    <!-- Statistics -->
    <div class="info-card">
        <div class="info-card-header">
            <span class="info-card-title">Statistics</span>
            <span class="status-badge"><span class="status-dot blue"></span>Live</span>
        </div>
        <div class="info-row"><span class="info-label">Users</span><span class="info-value">{{ $totalUsers }}</span></div>
        <div class="info-row"><span class="info-label">Categories</span><span class="info-value">{{ $totalCategories }}</span></div>
        <div class="info-row"><span class="info-label">Brands</span><span class="info-value">{{ $totalBrands }}</span></div>
        <div class="info-row"><span class="info-label">Units</span><span class="info-value">{{ $totalUnits }}</span></div>
        <div class="info-row"><span class="info-label">Suppliers</span><span class="info-value">{{ $totalSuppliers }}</span></div>
        <div class="info-row"><span class="info-label">Stock Alerts</span><span class="info-value {{ $lowStockCount > 0 ? 'danger' : 'success' }}">{{ $lowStockCount }} Low</span></div>
        <div class="info-row"><span class="info-label">Today Orders</span><span class="info-value">{{ $todayOrders }}</span></div>
    </div>

    <!-- Recent Sales -->
    <div class="info-card">
        <div class="info-card-header">
            <span class="info-card-title">Recent Sales</span>
            <span class="status-badge"><span class="status-dot amber"></span>Latest</span>
        </div>
        @forelse($recentSales as $sale)
            <div class="activity-item">
                <div class="activity-dot {{ $sale->payment_status == 'paid' ? 'green' : 'amber' }}"></div>
                <div class="activity-content">
                    <div class="activity-title">{{ $sale->invoice_no }}</div>
                    <div class="activity-sub">{{ $sale->customer->name ?? 'Walk-in' }} | {{ $sale->created_at->format('h:i A') }}</div>
                </div>
                <span class="activity-amount">৳ {{ number_format($sale->total, 0) }}</span>
            </div>
        @empty
            <div class="activity-item">
                <div class="activity-dot blue"></div>
                <div class="activity-content">
                    <div class="activity-title">No sales yet</div>
                    <div class="activity-sub">Start selling from POS</div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection