<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Real POS - Point of Sale System</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #0A0F1A;
            color: #FFFFFF;
            -webkit-font-smoothing: antialiased;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            border-bottom: 1px solid #1E2A3A;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            background: #3B82F6;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-icon svg {
            width: 20px;
            height: 20px;
        }

        .logo-text {
            font-size: 18px;
            font-weight: 800;
            color: #FFFFFF;
            letter-spacing: 0.5px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-decoration: none;
            transition: all 0.15s;
            cursor: pointer;
            border: 1px solid transparent;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-outline {
            background: transparent;
            border-color: #334155;
            color: #E2E8F0;
        }

        .btn-outline:hover {
            background: #1E293B;
            border-color: #475569;
        }

        .btn-primary {
            background: #3B82F6;
            border-color: #3B82F6;
            color: #FFFFFF;
        }

        .btn-primary:hover {
            background: #2563EB;
            border-color: #2563EB;
        }

        /* Hero */
        .hero {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 60px 20px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -20%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(59,130,246,0.06) 0%, transparent 70%);
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -20%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(139,92,246,0.04) 0%, transparent 70%);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 650px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(59,130,246,0.15);
            color: #60A5FA;
            font-size: 10px;
            font-weight: 700;
            padding: 5px 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 24px;
        }

        .hero-badge .dot {
            width: 6px;
            height: 6px;
            background: #3B82F6;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        .hero-title {
            font-size: 48px;
            font-weight: 900;
            letter-spacing: -1.5px;
            line-height: 1.1;
            margin-bottom: 16px;
        }

        .hero-title span {
            color: #3B82F6;
        }

        .hero-desc {
            font-size: 16px;
            color: #94A3B8;
            font-weight: 400;
            line-height: 1.7;
            margin-bottom: 36px;
        }

        .hero-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-lg {
            padding: 12px 28px;
            font-size: 13px;
        }

        /* Features */
        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            background: #1E2A3A;
            margin: 0 40px 40px;
            border: 1px solid #1E2A3A;
        }

        .feature-card {
            background: #0F172A;
            padding: 32px 28px;
            text-align: center;
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            background: #1E2A3A;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        .feature-icon svg {
            width: 22px;
            height: 22px;
            color: #3B82F6;
        }

        .feature-title {
            font-size: 14px;
            font-weight: 700;
            color: #FFFFFF;
            margin-bottom: 8px;
        }

        .feature-desc {
            font-size: 12px;
            color: #64748B;
            line-height: 1.6;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 20px 40px;
            border-top: 1px solid #1E2A3A;
            font-size: 11px;
            color: #475569;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .hero-title { font-size: 32px; }
            .features { grid-template-columns: 1fr; margin: 0 20px 20px; }
            .navbar { padding: 16px 20px; }
            .logo-text { font-size: 15px; }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="/" class="logo">
            <div class="logo-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <rect width="24" height="24" fill="white"/>
                    <path d="M7 7h4l2 5-2 5H7l2-5-2-5zM13 7h4l2 5-2 5h-4l2-5-2-5z" fill="#3B82F6"/>
                </svg>
            </div>
            <span class="logo-text">REAL POS</span>
        </a>
        <div class="nav-links">
            @if(Route::has('login'))
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <rect x="3" y="3" width="7" height="7"/>
                            <rect x="14" y="3" width="7" height="7"/>
                            <rect x="14" y="14" width="7" height="7"/>
                            <rect x="3" y="14" width="7" height="7"/>
                        </svg>
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline">Log In</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                            <circle cx="8.5" cy="7" r="4"/>
                            <line x1="20" y1="8" x2="20" y2="14"/>
                            <line x1="23" y1="11" x2="17" y2="11"/>
                        </svg>
                        Register
                    </a>
                @endauth
            @endif
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-badge">
                <span class="dot"></span>
                Powerful POS System
            </div>
            <h1 class="hero-title">Manage Your Business with <span>Real POS</span></h1>
            <p class="hero-desc">
                A complete point of sale solution for inventory management, sales tracking, purchase orders, customer management, and detailed business reports — all in one place.
            </p>
            <div class="hero-actions">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <rect x="3" y="3" width="7" height="7"/>
                            <rect x="14" y="3" width="7" height="7"/>
                            <rect x="14" y="14" width="7" height="7"/>
                            <rect x="3" y="14" width="7" height="7"/>
                        </svg>
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/>
                            <polyline points="10 17 15 12 10 7"/>
                            <line x1="15" y1="12" x2="3" y2="12"/>
                        </svg>
                        Get Started Free
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline btn-lg">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/>
                            <polyline points="10 17 15 12 10 7"/>
                        </svg>
                        Sign In
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="features">
        <div class="feature-card">
            <div class="feature-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <polygon points="12 2 22 8 12 14 2 8 12 2"/>
                    <polyline points="2 8 12 14 22 8"/>
                    <polyline points="12 14 22 8 22 18 12 22 2 18 2 8"/>
                </svg>
            </div>
            <div class="feature-title">Inventory Management</div>
            <div class="feature-desc">Track stock levels, manage warehouses, set low stock alerts and handle stock transfers easily.</div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="9" cy="21" r="1"/>
                    <circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/>
                </svg>
            </div>
            <div class="feature-title">POS Sales Screen</div>
            <div class="feature-desc">Fast product search, barcode scanning, multiple payment methods, discounts, tax and instant invoicing.</div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                </svg>
            </div>
            <div class="feature-title">Reports & Analytics</div>
            <div class="feature-desc">Daily sales, profit reports, expense tracking, tax reports and business analytics dashboard.</div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        &copy; {{ date('Y') }} Real POS System. All rights reserved Real POS Authority.
    </footer>
</body>
</html>