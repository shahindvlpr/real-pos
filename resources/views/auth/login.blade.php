@extends('layouts.guest')

@section('content')
    <div class="auth-logo">
        <svg viewBox="0 0 48 48" fill="none">
            <rect width="48" height="48" fill="#3B82F6"/>
            <path d="M14 14h10l6 10-6 10H14l6-10-6-10zM24 14h10l6 10-6 10H24l6-10-6-10z" fill="white" opacity="0.9"/>
        </svg>
        <h2>Welcome Back</h2>
        <p>Sign in to your POS dashboard</p>
    </div>

    @if($errors->any())
        <div class="error-message">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; vertical-align: middle; margin-right: 6px;">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            These credentials do not match our records.
        </div>
    @endif

    @if(session('status'))
        <div style="background: #064E3B; border: 1px solid #065F46; color: #6EE7B7; padding: 10px 14px; font-size: 12px; font-weight: 500; margin-bottom: 20px;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="form-group">
            <label class="form-label">Email Address</label>
            <input type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   class="form-input @error('email') is-invalid @enderror" 
                   placeholder="Enter your email"
                   required 
                   autofocus>
            @error('email')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label class="form-label">Password</label>
            <div style="position: relative;">
                <input type="password" 
                       name="password" 
                       id="password"
                       class="form-input @error('password') is-invalid @enderror" 
                       placeholder="Enter your password"
                       style="padding-right: 44px;"
                       required>
                <button type="button" 
                        onclick="togglePassword()" 
                        style="position: absolute; right: 0; top: 0; height: 100%; width: 44px; background: none; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #64748B;"
                        tabindex="-1">
                    <!-- Eye Open Icon -->
                    <svg id="eye-open" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <!-- Eye Off Icon -->
                    <svg id="eye-off" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: none;">
                        <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <label class="form-check" style="margin-bottom: 0;">
                <input type="checkbox" name="remember" class="form-check-input">
                <span class="form-check-label">Remember me</span>
            </label>
            @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="font-size: 12px; color: #3B82F6; text-decoration: none; font-weight: 600;">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-submit">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="display: inline; vertical-align: middle; margin-right: 8px;">
                <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/>
                <polyline points="10 17 15 12 10 7"/>
                <line x1="15" y1="12" x2="3" y2="12"/>
            </svg>
            Sign In
        </button>
    </form>

    <hr>

    <div class="auth-links">
        Don't have an account? 
        <a href="{{ route('register') }}">Create Account</a>
    </div>
@endsection

@push('scripts')
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeOpen = document.getElementById('eye-open');
        const eyeOff = document.getElementById('eye-off');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeOpen.style.display = 'none';
            eyeOff.style.display = 'block';
        } else {
            passwordInput.type = 'password';
            eyeOpen.style.display = 'block';
            eyeOff.style.display = 'none';
        }
    }
</script>
@endpush