<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Real POS') }} - Login</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #0F172A;
            color: #E2E8F0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            -webkit-font-smoothing: antialiased;
        }
        
        .auth-container {
            width: 100%;
            max-width: 440px;
            padding: 20px;
        }
        
        .auth-card {
            background: #1E293B;
            border: 1px solid #334155;
            padding: 40px;
        }
        
        .auth-logo {
            text-align: center;
            margin-bottom: 32px;
        }
        
        .auth-logo svg {
            width: 48px;
            height: 48px;
            margin-bottom: 12px;
        }
        
        .auth-logo h2 {
            font-size: 20px;
            font-weight: 800;
            color: #FFFFFF;
            letter-spacing: -0.3px;
        }
        
        .auth-logo p {
            font-size: 12px;
            color: #64748B;
            margin-top: 4px;
            font-weight: 500;
        }
        
        .form-group {
            margin-bottom: 16px;
        }
        
        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #94A3B8;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .form-input {
            width: 100%;
            padding: 10px 14px;
            background: #0F172A;
            border: 1px solid #334155;
            color: #FFFFFF;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.15s;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #3B82F6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }
        
        .form-input.is-invalid {
            border-color: #EF4444;
        }
        
        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .form-check-input {
            width: 16px;
            height: 16px;
            accent-color: #3B82F6;
            cursor: pointer;
        }
        
        .form-check-label {
            font-size: 13px;
            color: #94A3B8;
            font-weight: 500;
        }
        
        .btn-submit {
            width: 100%;
            padding: 11px;
            background: #3B82F6;
            border: 1px solid #3B82F6;
            color: #FFFFFF;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.15s;
            font-family: 'Inter', sans-serif;
        }
        
        .btn-submit:hover {
            background: #2563EB;
            border-color: #2563EB;
        }
        
        .auth-links {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #64748B;
        }
        
        .auth-links a {
            color: #3B82F6;
            text-decoration: none;
            font-weight: 600;
        }
        
        .auth-links a:hover {
            color: #60A5FA;
        }
        
        .error-message {
            background: #7F1D1D;
            border: 1px solid #991B1B;
            color: #FCA5A5;
            padding: 10px 14px;
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 20px;
        }
        
        .error-text {
            font-size: 11px;
            color: #EF4444;
            margin-top: 4px;
            font-weight: 500;
            display: block;
        }
        
        hr {
            border: none;
            border-top: 1px solid #334155;
            margin: 24px 0;
        }
        
        .back-link {
            display: block;
            text-align: center;
            font-size: 12px;
            color: #64748B;
            text-decoration: none;
            margin-top: 16px;
            font-weight: 500;
        }
        
        .back-link:hover {
            color: #94A3B8;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            @yield('content')
        </div>
        
        <a href="/" class="back-link">&larr; Back to Home</a>
    </div>
    
    @stack('scripts')
</body>
</html>