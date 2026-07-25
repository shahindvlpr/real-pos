<nav class="sidebar" id="sidebar">
    <!-- Brand -->
    <div class="sidebar-header">
        <div class="brand-icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                <rect width="24" height="24" rx="0" fill="#3B82F6"/>
                <path d="M7 7h4l2 5-2 5H7l2-5-2-5zM13 7h4l2 5-2 5h-4l2-5-2-5z" fill="white"/>
            </svg>
        </div>
        <div class="brand-info">
            <div class="brand-name">REAL POS</div>
            <div class="brand-subtitle">Management System v1.0</div>
        </div>
    </div>

<!-- Sidebar Footer -->
<div style="padding: 14px 18px; border-top: 1px solid #1E2A3A; margin-top: auto;">
    <div style="display: flex; align-items: center; gap: 8px;">
        <!-- Calendar Icon -->
        <div style="width: 32px; height: 32px; background: #1E2A3A; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#60A5FA" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="0"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
        </div>
        <!-- Time Info -->
        <div style="flex: 1; min-width: 0;">
            <div style="display: flex; align-items: baseline; gap: 4px;">
                <span id="sidebarTime" style="font-size: 15px; font-weight: 700; color: #E2E8F0; line-height: 1; letter-spacing: -0.3px;">03:45</span>
                <span id="sidebarSeconds" style="font-size: 10px; font-weight: 600; color: #60A5FA; line-height: 1;">00</span>
                <span id="sidebarAmPm" style="font-size: 10px; font-weight: 600; color: #64748B; line-height: 1;">PM</span>
            </div>
            <div id="sidebarDate" style="font-size: 10px; color: #64748B; font-weight: 500; margin-top: 2px; text-transform: uppercase; letter-spacing: 0.5px;">FRI, 24 JUL 2026</div>
        </div>
    </div>
</div>

<script>
    function updateDateTime() {
        const now = new Date();
        
        // Hours & Minutes
        const hours = now.getHours();
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const displayHours = hours % 12 || 12;
        document.getElementById('sidebarTime').textContent = displayHours + ':' + minutes;
        
        // Seconds (Blue color)
        document.getElementById('sidebarSeconds').textContent = now.getSeconds().toString().padStart(2, '0');
        
        // AM/PM
        document.getElementById('sidebarAmPm').textContent = hours >= 12 ? 'PM' : 'AM';
        
        // Date
        const dateOptions = { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' };
        document.getElementById('sidebarDate').textContent = now.toLocaleString('en-US', dateOptions).toUpperCase();
    }
    updateDateTime();
    setInterval(updateDateTime, 1000); // Update every second
</script>
    <!-- Navigation -->
    <div class="sidebar-nav">
        
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" 
           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7"/>
                    <rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/>
                    <rect x="3" y="14" width="7" height="7"/>
                </svg>
            </span>
            <span class="nav-label">Dashboard</span>
        </a>

        <!-- Divider -->
        <div class="nav-divider">
            <span>Product Management</span>
        </div>

        <!-- Categories -->
        <a href="{{ route('categories.index') }}" 
           class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7" rx="0"/>
                    <rect x="14" y="3" width="7" height="7" rx="0"/>
                    <rect x="3" y="14" width="7" height="7" rx="0"/>
                    <rect x="14" y="14" width="7" height="7" rx="0"/>
                </svg>
            </span>
            <span class="nav-label">Categories</span>
            <span class="nav-count">{{ \App\Models\Category::count() }}</span>
        </a>

        <!-- Brands -->
        @if(Route::has('brands.index'))
        <a href="{{ route('brands.index') }}" class="nav-link {{ request()->routeIs('brands.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="7" cy="7" r="3"/>
                    <circle cx="17" cy="7" r="3"/>
                    <path d="M5 12l2 10h10l2-10"/>
                </svg>
            </span>
            <span class="nav-label">Brands</span>
        </a>
        @endif

        <!-- Units -->
        @if(Route::has('units.index'))
        <a href="{{ route('units.index') }}" class="nav-link {{ request()->routeIs('units.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 7h18v4H3zM5 11v11h14V11"/>
                </svg>
            </span>
            <span class="nav-label">Units</span>
        </a>
        @endif

        <!-- Products -->
        @if(Route::has('products.index'))
        <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="12 2 22 8 12 14 2 8 12 2"/>
                    <polyline points="2 8 12 14 22 8"/>
                    <polyline points="12 14 22 8 22 18 12 22 2 18 2 8"/>
                </svg>
            </span>
            <span class="nav-label">Products</span>
        </a>
        @endif

        <!-- Divider -->
        <div class="nav-divider">
            <span>Inventory</span>
        </div>

        <!-- Stock In -->
        <a href="#" class="nav-link disabled">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
            </span>
            <span class="nav-label">Stock In</span>
            <span class="nav-badge">Soon</span>
        </a>

        <!-- Stock Out -->
        <a href="#" class="nav-link disabled">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14"/>
                </svg>
            </span>
            <span class="nav-label">Stock Out</span>
            <span class="nav-badge">Soon</span>
        </a>

        <!-- Stock Transfer -->
        <a href="#" class="nav-link disabled">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="17 1 21 5 17 9"/>
                    <path d="M3 11V9a4 4 0 014-4h14"/>
                    <polyline points="7 23 3 19 7 15"/>
                    <path d="M21 13v2a4 4 0 01-4 4H3"/>
                </svg>
            </span>
            <span class="nav-label">Stock Transfer</span>
            <span class="nav-badge">Soon</span>
        </a>

                <!-- ============ SALES ============ -->
        <div class="nav-divider">
            <span>Sales</span>
        </div>

        <!-- POS Screen -->
        @if(Route::has('pos.index'))
        <a href="{{ route('pos.index') }}" class="nav-link {{ request()->routeIs('pos.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/>
                </svg>
            </span>
            <span class="nav-label">POS Screen</span>
            <span class="nav-indicator"></span>
        </a>
        @endif

        <!-- Sales History -->
        @if(Route::has('admin.sales.index'))
        <a href="{{ route('admin.sales.index') }}" class="nav-link {{ request()->routeIs('admin.sales.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                </svg>
            </span>
            <span class="nav-label">Sales History</span>
        </a>
        @endif

        <!-- Sales Return -->
        <a href="#" class="nav-link disabled">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="1 4 1 10 7 10"/>
                    <path d="M3.51 15a9 9 0 102.13-9.36L1 10"/>
                </svg>
            </span>
            <span class="nav-label">Sales Return</span>
            <span class="nav-badge">Soon</span>
        </a>

        <!-- Divider -->
        <div class="nav-divider">
            <span>Purchase</span>
        </div>

        <!-- Purchase Orders -->
        <a href="#" class="nav-link disabled">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <path d="M16 10a4 4 0 01-8 0"/>
                </svg>
            </span>
            <span class="nav-label">Purchase Orders</span>
            <span class="nav-badge">Soon</span>
        </a>

        <!-- Divider -->
        <div class="nav-divider">
            <span>People</span>
        </div>

        <!-- Customers -->
        @if(Route::has('customers.index'))
        <a href="{{ route('customers.index') }}" class="nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                    <path d="M16 3.13a4 4 0 010 7.75"/>
                </svg>
            </span>
            <span class="nav-label">Customers</span>
        </a>
        @endif

        <!-- Suppliers -->
        <a href="#" class="nav-link disabled">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="1" y="3" width="15" height="13" rx="0"/>
                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                    <circle cx="5.5" cy="18.5" r="2.5"/>
                    <circle cx="18.5" cy="18.5" r="2.5"/>
                </svg>
            </span>
            <span class="nav-label">Suppliers</span>
            <span class="nav-badge">Soon</span>
        </a>

        <!-- Divider -->
        <div class="nav-divider">
            <span>System</span>
        </div>

        <!-- Reports -->
        <a href="#" class="nav-link disabled">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                </svg>
            </span>
            <span class="nav-label">Reports</span>
            <span class="nav-badge">Soon</span>
        </a>

        <!-- Settings -->
        <a href="#" class="nav-link disabled">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
                </svg>
            </span>
            <span class="nav-label">Settings</span>
            <span class="nav-badge">Soon</span>
        </a>
    </div>

    <!-- Sidebar Footer -->
<div style="padding: 14px 18px; border-top: 1px solid #1E2A3A; margin-top: auto;">
    <!-- Brand -->
    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 10px;">
        <div style="width: 30px; height: 30px; background: #1E3A5F; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#60A5FA" stroke-width="2">
                <rect width="24" height="24" fill="none"/>
                <path d="M7 7h4l2 5-2 5H7l2-5-2-5zM13 7h4l2 5-2 5h-4l2-5-2-5z"/>
            </svg>
        </div>
        <div style="flex: 1; min-width: 0;">
            <div style="font-size: 12px; font-weight: 700; color: #E2E8F0;">Real POS</div>
            <div style="font-size: 9px; color: #64748B; font-weight: 500; text-transform: uppercase; letter-spacing: 1px;">Version 1.0</div>
        </div>
    </div>
    
    <!-- Time (Compact) -->
    <div style="display: flex; align-items: center; justify-content: space-between;">
        <span style="font-size: 9px; color: #475569; font-weight: 500;">&copy; {{ date('Y') }}</span>
        <span id="footerMiniTime" style="font-size: 10px; font-weight: 600; color: #64748B;"></span>
    </div>
</div>

<script>
    function updateFooterMiniTime() {
        const now = new Date();
        const hours = now.getHours();
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const displayHours = hours % 12 || 12;
        const ampm = hours >= 12 ? 'PM' : 'AM';
        document.getElementById('footerMiniTime').textContent = displayHours + ':' + minutes + ' ' + ampm;
    }
    updateFooterMiniTime();
    setInterval(updateFooterMiniTime, 30000);
</script>
</nav>

<!-- Mobile Toggle -->
<button class="sidebar-toggle" onclick="document.getElementById('sidebar').classList.toggle('active')">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <line x1="3" y1="12" x2="21" y2="12"/>
        <line x1="3" y1="6" x2="21" y2="6"/>
        <line x1="3" y1="18" x2="21" y2="18"/>
    </svg>
</button>