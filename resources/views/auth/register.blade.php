@extends('layouts.guest')

@section('content')
    <div class="auth-logo">
        <svg viewBox="0 0 48 48" fill="none">
            <rect width="48" height="48" fill="#3B82F6"/>
            <path d="M14 14h10l6 10-6 10H14l6-10-6-10zM24 14h10l6 10-6 10H24l6-10-6-10z" fill="white" opacity="0.9"/>
        </svg>
        <h2>Create Account</h2>
        <p>Set up your POS system</p>
    </div>

    @if($errors->any())
        <div class="error-message">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline; vertical-align: middle; margin-right: 6px;">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            Please fix the errors below.
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="form-group">
            <label class="form-label">Full Name</label>
            <input type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   class="form-input @error('name') is-invalid @enderror" 
                   placeholder="Enter your full name"
                   required 
                   autofocus>
            @error('name')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group">
            <label class="form-label">Email Address</label>
            <input type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   class="form-input @error('email') is-invalid @enderror" 
                   placeholder="Enter your email"
                   required>
            @error('email')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <!-- Phone -->
        <div class="form-group">
            <label class="form-label">Phone Number</label>
            <input type="text" 
                name="phone" 
                value="{{ old('phone') }}" 
                class="form-input @error('phone') is-invalid @enderror" 
                placeholder="Enter your phone number">
            @error('phone')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>
        <!-- Role -->
        <div class="form-group">
            <label class="form-label">Role <span style="color: #EF4444;">*</span></label>
            <select name="role" class="form-input @error('role') is-invalid @enderror" style="appearance: auto;" required>
                <option value="">Select Role</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                <option value="cashier" {{ old('role') == 'cashier' ? 'selected' : '' }}>Cashier</option>
                <option value="store_keeper" {{ old('role') == 'store_keeper' ? 'selected' : '' }}>Store Keeper</option>
            </select>
            @error('role')
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
                       placeholder="Minimum 8 characters"
                       style="padding-right: 44px;"
                       required>
                <button type="button" 
                        onclick="togglePassword('password', 'eye-open-p', 'eye-off-p')" 
                        style="position: absolute; right: 0; top: 0; height: 100%; width: 44px; background: none; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #64748B;"
                        tabindex="-1">
                    <svg id="eye-open-p" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <svg id="eye-off-p" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: none;">
                        <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label class="form-label">Confirm Password</label>
            <div style="position: relative;">
                <input type="password" 
                       name="password_confirmation" 
                       id="password_confirmation"
                       class="form-input @error('password_confirmation') is-invalid @enderror" 
                       placeholder="Re-enter your password"
                       style="padding-right: 44px;"
                       required>
                <button type="button" 
                        onclick="togglePassword('password_confirmation', 'eye-open-cp', 'eye-off-cp')" 
                        style="position: absolute; right: 0; top: 0; height: 100%; width: 44px; background: none; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #64748B;"
                        tabindex="-1">
                    <svg id="eye-open-cp" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <svg id="eye-off-cp" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: none;">
                        <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                </button>
            </div>
            @error('password_confirmation')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <!-- Terms -->
        @if(Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="form-check" style="margin-bottom: 20px;">
                <input type="checkbox" name="terms" class="form-check-input" required>
                <span class="form-check-label">
                    I agree to the 
                    <a href="{{ route('terms.show') }}" style="color: #3B82F6;">Terms</a> & 
                    <a href="{{ route('policy.show') }}" style="color: #3B82F6;">Privacy Policy</a>
                </span>
            </div>
        @endif

        <!-- Submit -->
        <button type="submit" class="btn-submit">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="display: inline; vertical-align: middle; margin-right: 8px;">
                <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                <circle cx="8.5" cy="7" r="4"/>
                <line x1="20" y1="8" x2="20" y2="14"/>
                <line x1="23" y1="11" x2="17" y2="11"/>
            </svg>
            Create Account
        </button>
    </form>

    <hr>

    <div class="auth-links">
        Already have an account? 
        <a href="{{ route('login') }}">Sign In</a>
    </div>
@endsection

@push('scripts')
<script>
    function togglePassword(inputId, eyeOpenId, eyeOffId) {
        const passwordInput = document.getElementById(inputId);
        const eyeOpen = document.getElementById(eyeOpenId);
        const eyeOff = document.getElementById(eyeOffId);
        
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