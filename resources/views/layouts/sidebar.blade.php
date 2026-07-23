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
        <a href="#" class="nav-link disabled">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="7" cy="7" r="3"/>
                    <circle cx="17" cy="7" r="3"/>
                    <path d="M5 12l2 10h10l2-10"/>
                </svg>
            </span>
            <span class="nav-label">Brands</span>
            <span class="nav-badge">Soon</span>
        </a>

        <!-- Units -->
        <a href="#" class="nav-link disabled">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 7h18v3H3zM5 10v11h14V10"/>
                </svg>
            </span>
            <span class="nav-label">Units</span>
            <span class="nav-badge">Soon</span>
        </a>

        <!-- Products -->
        <a href="#" class="nav-link disabled">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="12 2 22 8 12 14 2 8 12 2"/>
                    <polyline points="2 8 12 14 22 8"/>
                    <polyline points="12 14 22 8 22 18 12 22 2 18 2 8"/>
                </svg>
            </span>
            <span class="nav-label">Products</span>
            <span class="nav-badge">Soon</span>
        </a>

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

        <!-- Divider -->
        <div class="nav-divider">
            <span>Sales</span>
        </div>

        <!-- POS Screen -->
        <a href="#" class="nav-link disabled">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="9" cy="21" r="1"/>
                    <circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/>
                </svg>
            </span>
            <span class="nav-label">POS Screen</span>
            <span class="nav-badge">Soon</span>
        </a>

        <!-- Sales List -->
        <a href="#" class="nav-link disabled">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                </svg>
            </span>
            <span class="nav-label">Sales List</span>
            <span class="nav-badge">Soon</span>
        </a>

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
        <a href="#" class="nav-link disabled">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                    <path d="M16 3.13a4 4 0 010 7.75"/>
                </svg>
            </span>
            <span class="nav-label">Customers</span>
            <span class="nav-badge">Soon</span>
        </a>

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
    <div class="sidebar-footer">
        <div class="footer-text">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
            </svg>
            <span>{{ date('h:i A') }}</span>
        </div>
    </div>
</nav>

<!-- Mobile Toggle -->
<button class="sidebar-toggle" onclick="document.getElementById('sidebar').classList.toggle('active')">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <line x1="3" y1="12" x2="21" y2="12"/>
        <line x1="3" y1="6" x2="21" y2="6"/>
        <line x1="3" y1="18" x2="21" y2="18"/>
    </svg>
</button>