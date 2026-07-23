@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Business Overview')

@push('styles')
<style>
    .stat-icon-blue { background: #DBEAFE; color: #3B82F6; }
    .stat-icon-green { background: #DCFCE7; color: #10B981; }
    .stat-icon-purple { background: #F3E8FF; color: #9333EA; }
    .stat-icon-orange { background: #FFF7ED; color: #F97316; }
    
    .welcome-section {
        background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 50%, #0F172A 100%);
        color: white;
        padding: 48px;
        position: relative;
        overflow: hidden;
    }
    
    .welcome-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(59, 130, 246, 0.08);
        transform: rotate(45deg);
    }
    
    .welcome-section::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 300px;
        height: 300px;
        background: rgba(139, 92, 246, 0.06);
        transform: rotate(-30deg);
    }
    
    .welcome-content {
        position: relative;
        z-index: 1;
    }
    
    .welcome-icon {
        width: 64px;
        height: 64px;
        background: rgba(59, 130, 246, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }
    
    .welcome-title {
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }
    
    .welcome-subtitle {
        font-size: 14px;
        color: #94A3B8;
        font-weight: 500;
        margin-bottom: 24px;
        max-width: 500px;
    }
    
    .quick-action-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
    }
    
    .quick-action-card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 20px;
        text-decoration: none;
        color: white;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 14px;
    }
    
    .quick-action-card:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.2);
    }
    
    .quick-action-card .action-icon {
        width: 40px;
        height: 40px;
        background: rgba(59, 130, 246, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .quick-action-card .action-text {
        font-size: 13px;
        font-weight: 600;
    }
    
    .quick-action-card .action-arrow {
        margin-left: auto;
        opacity: 0.5;
        transition: all 0.2s;
    }
    
    .quick-action-card:hover .action-arrow {
        opacity: 1;
        transform: translateX(4px);
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 24px;
    }
    
    .info-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        padding: 24px;
    }
    
    .info-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }
    
    .info-card-title {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #64748B;
    }
    
    .info-card-badge {
        font-size: 10px;
        font-weight: 700;
        padding: 3px 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .info-card-value {
        font-size: 32px;
        font-weight: 800;
        color: #0F172A;
        line-height: 1;
    }
    
    .info-card-footer {
        margin-top: 12px;
        font-size: 11px;
        color: #94A3B8;
        font-weight: 500;
    }
</style>
@endpush

@section('content')
    <!-- Stats Row -->
    <div class="row mb-4">
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon stat-icon-blue">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="1" x2="12" y2="23"/>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                    </svg>
                </div>
                <div class="stat-value">৳ 0.00</div>
                <div class="stat-label">Today's Sales</div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon stat-icon-green">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                    </svg>
                </div>
                <div class="stat-value">0</div>
                <div class="stat-label">Total Products</div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon stat-icon-purple">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z"/>
                    </svg>
                </div>
                <div class="stat-value">{{ \App\Models\Category::count() }}</div>
                <div class="stat-label">Categories</div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon stat-icon-orange">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M20 7l-4-4-8 8-4-4"/>
                    </svg>
                </div>
                <div class="stat-value">{{ \App\Models\Brand::count() }}</div>
                <div class="stat-label">Brands</div>
            </div>
        </div>
    </div>

    <!-- Welcome Section -->
    <div class="welcome-section mb-4">
        <div class="welcome-content">
            <div class="welcome-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                    <path d="M2 17l10 5 10-5"/>
                    <path d="M2 12l10 5 10-5"/>
                </svg>
            </div>
            <h2 class="welcome-title">Welcome to Real POS</h2>
            <p class="welcome-subtitle">
                Manage your products, track inventory, process sales, and grow your business with our powerful point of sale system.
            </p>
            <div class="quick-action-grid">
                <a href="{{ route('categories.index') }}" class="quick-action-card">
                    <div class="action-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 5v14M5 12h14"/>
                        </svg>
                    </div>
                    <span class="action-text">Add Category</span>
                    <span class="action-arrow">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </span>
                </a>
                
                @if(Route::has('brands.index'))
                <a href="{{ route('brands.index') }}" class="quick-action-card">
                    <div class="action-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 5v14M5 12h14"/>
                        </svg>
                    </div>
                    <span class="action-text">Add Brand</span>
                    <span class="action-arrow">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </span>
                </a>
                @endif

                @if(Route::has('products.index'))
                <a href="{{ route('products.index') }}" class="quick-action-card">
                    <div class="action-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 5v14M5 12h14"/>
                        </svg>
                    </div>
                    <span class="action-text">Add Product</span>
                    <span class="action-arrow">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </span>
                </a>
                @endif
            </div>
        </div>
    </div>

    <!-- System Information -->
    <div class="info-grid">
        <div class="info-card">
            <div class="info-card-header">
                <span class="info-card-title">System Status</span>
                <span class="info-card-badge badge-success">Online</span>
            </div>
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 13px; color: #64748B;">Laravel Version</span>
                    <span style="font-size: 13px; font-weight: 600; color: #0F172A;">{{ app()->version() }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 13px; color: #64748B;">PHP Version</span>
                    <span style="font-size: 13px; font-weight: 600; color: #0F172A;">{{ phpversion() }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 13px; color: #64748B;">Database</span>
                    <span style="font-size: 13px; font-weight: 600; color: #0F172A;">MySQL</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 13px; color: #64748B;">Timezone</span>
                    <span style="font-size: 13px; font-weight: 600; color: #0F172A;">{{ config('app.timezone') }}</span>
                </div>
            </div>
        </div>

        <div class="info-card">
            <div class="info-card-header">
                <span class="info-card-title">Quick Stats</span>
            </div>
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 13px; color: #64748B;">Registered Users</span>
                    <span style="font-size: 13px; font-weight: 600; color: #0F172A;">{{ \App\Models\User::count() }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 13px; color: #64748B;">Active Products</span>
                    <span style="font-size: 13px; font-weight: 600; color: #0F172A;">{{ \App\Models\Product::where('is_active', true)->count() }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 13px; color: #64748B;">Stock Alert</span>
                    <span style="font-size: 13px; font-weight: 600; color: #EF4444;">0 Low Stock</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 13px; color: #64748B;">Today's Orders</span>
                    <span style="font-size: 13px; font-weight: 600; color: #0F172A;">0</span>
                </div>
            </div>
        </div>

        <div class="info-card">
            <div class="info-card-header">
                <span class="info-card-title">Recent Activity</span>
            </div>
            <div style="display: flex; flex-direction: column; gap: 14px;">
                <div style="display: flex; align-items: start; gap: 10px;">
                    <div style="width: 8px; height: 8px; background: #3B82F6; margin-top: 5px; flex-shrink: 0;"></div>
                    <div>
                        <div style="font-size: 13px; font-weight: 600; color: #0F172A;">System Installed</div>
                        <div style="font-size: 11px; color: #94A3B8;">Real POS is ready to use</div>
                    </div>
                </div>
                <div style="display: flex; align-items: start; gap: 10px;">
                    <div style="width: 8px; height: 8px; background: #10B981; margin-top: 5px; flex-shrink: 0;"></div>
                    <div>
                        <div style="font-size: 13px; font-weight: 600; color: #0F172A;">Database Configured</div>
                        <div style="font-size: 11px; color: #94A3B8;">All tables migrated successfully</div>
                    </div>
                </div>
                <div style="display: flex; align-items: start; gap: 10px;">
                    <div style="width: 8px; height: 8px; background: #F59E0B; margin-top: 5px; flex-shrink: 0;"></div>
                    <div>
                        <div style="font-size: 13px; font-weight: 600; color: #0F172A;">Setup Required</div>
                        <div style="font-size: 11px; color: #94A3B8;">Add categories, brands & products</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection