<div class="ns-auth-wrapper">
    <div class="ns-auth-card">
        {{-- LEFT PANEL: LOGIN FORM --}}
        <div class="ns-auth-form-side">
            {{-- Brand Logo --}}
            <div class="ns-brand-header">
                <div class="ns-brand-logo">
                    {{-- Mengganti SVG dengan gambar logo lokal --}}
                    <img src="{{ asset('images/logo/logo_api.png') }}" alt="Logo API" style="width: 50px; height: 50px; object-fit: contain;" />
                </div>
                <span class="ns-brand-name">FOAMS</span>
            </div>

            {{-- Title & Subtitle --}}
            <h1 class="ns-auth-title">Log in to your Account</h1>
            <p class="ns-auth-subtitle">Welcome back! Select method to log in:</p>

            {{-- Social Login Buttons --}}
            <div class="ns-social-grid">
                <button type="button" class="ns-social-btn">
                    {{-- Google 4-color SVG Icon --}}
                    <svg width="18" height="18" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.8-2.4 3.66v3.04h3.88c2.27-2.09 3.665-5.17 3.665-9.14z"/>
                        <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.04c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.26v3.13C3.25 21.37 7.34 24 12 24z"/>
                        <path fill="#FBBC05" d="M5.28 14.28c-.25-.72-.38-1.49-.38-2.28s.13-1.56.38-2.28V6.59H1.26C.46 8.19 0 10.04 0 12s.46 3.81 1.26 5.41l4.02-3.13z"/>
                        <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.25 2.63 1.26 6.59l4.02 3.13c.95-2.83 3.6-4.97 6.72-4.97z"/>
                    </svg>
                    <span>Google</span>
                </button>
                <button type="button" class="ns-social-btn">
                    {{-- Facebook SVG Icon --}}
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="#1877F2">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    <span>Facebook</span>
                </button>
            </div>

            {{-- Divider --}}
            <div class="ns-divider">
                <span class="ns-divider-line"></span>
                <span class="ns-divider-text">or continue with email</span>
                <span class="ns-divider-line"></span>
            </div>

            {{-- Form --}}
            <form wire:submit="authenticate" class="ns-auth-form" x-data="{ showPassword: false }">
                {{-- Email Field --}}
                <div class="ns-input-group">
                    <div class="ns-input-wrapper @error('data.email') ns-input-error @enderror">
                        {{-- Mail Icon --}}
                        <svg class="ns-input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                        </svg>
                        <input
                            type="email"
                            wire:model.defer="data.email"
                            placeholder="Email"
                            autocomplete="email"
                            required
                            class="ns-input"
                        />
                    </div>
                    @error('data.email')
                        <p class="ns-error-text">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password Field --}}
                <div class="ns-input-group">
                    <div class="ns-input-wrapper @error('data.password') ns-input-error @enderror">
                        {{-- Lock Icon --}}
                        <svg class="ns-input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <input
                            :type="showPassword ? 'text' : 'password'"
                            wire:model.defer="data.password"
                            placeholder="Password"
                            autocomplete="current-password"
                            required
                            class="ns-input"
                        />
                        {{-- Toggle Eye Icon --}}
                        <button
                            type="button"
                            @click="showPassword = !showPassword"
                            class="ns-eye-btn"
                            tabindex="-1"
                        >
                            <svg x-show="!showPassword" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                                <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                                <line x1="2" x2="22" y1="2" y2="22"></line>
                            </svg>
                            <svg x-show="showPassword" x-cloak width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                    @error('data.password')
                        <p class="ns-error-text">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me (Forgot Password Ditiadakan Sesuai Permintaan) --}}
                <div class="ns-remember-row">
                    <label class="ns-remember-label">
                        <input
                            type="checkbox"
                            wire:model.defer="data.remember"
                            class="ns-checkbox"
                        />
                        <span>Remember me</span>
                    </label>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="ns-submit-btn" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="authenticate">Log in</span>
                    <span wire:loading wire:target="authenticate" class="ns-btn-loading">
                        <svg class="ns-spinner" viewBox="0 0 24 24" fill="none">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Logging in...
                    </span>
                </button>
            </form>
        </div>

        {{-- RIGHT PANEL: ILLUSTRATION & TEXT --}}
        <div class="ns-auth-visual-side">
            {{-- Background Subtle Glows --}}
            <div class="ns-visual-bg-glow"></div>

            {{-- Central Connected Graphic --}}
            <div class="ns-graphic-container">
                {{-- Concentric Rings --}}
                <div class="ns-ring-outer"></div>
                <div class="ns-ring-inner"></div>

                {{-- Left App Badges --}}
                <div class="ns-badges-column">
                    {{-- Badge 1: Slack --}}
                    <div class="ns-badge-node ns-node-1">
                        <svg width="22" height="22" viewBox="0 0 24 24">
                            <path fill="#E01E5A" d="M5.04 14.77a2.52 2.52 0 1 1-2.52-2.52h2.52v2.52z"/>
                            <path fill="#E01E5A" d="M6.3 14.77a2.52 2.52 0 0 1 5.04 0v6.3a2.52 2.52 0 1 1-5.04 0v-6.3z"/>
                            <path fill="#36C5F0" d="M9.23 5.04a2.52 2.52 0 1 1 2.52-2.52v2.52h-2.52z"/>
                            <path fill="#36C5F0" d="M9.23 6.3a2.52 2.52 0 0 1 0 5.04h-6.3a2.52 2.52 0 1 1 0-5.04h6.3z"/>
                            <path fill="#2EB67D" d="M18.96 9.23a2.52 2.52 0 1 1 2.52 2.52h-2.52v-2.52z"/>
                            <path fill="#2EB67D" d="M17.7 9.23a2.52 2.52 0 0 1-5.04 0v-6.3a2.52 2.52 0 0 1 5.04 0v6.3z"/>
                            <path fill="#ECB22E" d="M14.77 18.96a2.52 2.52 0 1 1-2.52 2.52v-2.52h2.52z"/>
                            <path fill="#ECB22E" d="M14.77 17.7a2.52 2.52 0 0 1 0-5.04h6.3a2.52 2.52 0 1 1 0 5.04h-6.3z"/>
                        </svg>
                    </div>

                    {{-- Badge 2: Camera / Instagram Style --}}
                    <div class="ns-badge-node ns-node-2">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                            <rect width="20" height="20" x="2" y="2" rx="6" fill="#0066f5"/>
                            <circle cx="12" cy="12" r="4.2" stroke="#ffffff" stroke-width="2"/>
                            <circle cx="17.2" cy="6.8" r="1.3" fill="#ffffff"/>
                        </svg>
                    </div>

                    {{-- Badge 3: Google --}}
                    <div class="ns-badge-node ns-node-3">
                        <svg width="20" height="20" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.8-2.4 3.66v3.04h3.88c2.27-2.09 3.665-5.17 3.665-9.14z"/>
                            <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.04c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.26v3.13C3.25 21.37 7.34 24 12 24z"/>
                            <path fill="#FBBC05" d="M5.28 14.28c-.25-.72-.38-1.49-.38-2.28s.13-1.56.38-2.28V6.59H1.26C.46 8.19 0 10.04 0 12s.46 3.81 1.26 5.41l4.02-3.13z"/>
                            <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.25 2.63 1.26 6.59l4.02 3.13c.95-2.83 3.6-4.97 6.72-4.97z"/>
                        </svg>
                    </div>
                </div>

                {{-- Connector SVG Lines --}}
                <svg class="ns-connecting-svg" viewBox="0 0 180 180" fill="none">
                    <path d="M 20 40 Q 90 40 90 90 T 160 90" stroke="rgba(255,255,255,0.4)" stroke-width="3" stroke-linecap="round" fill="none" />
                    <path d="M 20 90 L 160 90" stroke="rgba(255,255,255,0.4)" stroke-width="3" stroke-linecap="round" fill="none" />
                    <path d="M 20 140 Q 90 140 90 90 T 160 90" stroke="rgba(255,255,255,0.4)" stroke-width="3" stroke-linecap="round" fill="none" />
                </svg>

                {{-- Right Floating Dashboard Card --}}
                <div class="ns-dashboard-mockup">
                    {{-- Window Header with 3 Dots --}}
                    <div class="ns-mockup-header">
                        <div class="ns-window-dots">
                            <span class="ns-dot ns-dot-red"></span>
                            <span class="ns-dot ns-dot-yellow"></span>
                            <span class="ns-dot ns-dot-green"></span>
                        </div>
                        <div class="ns-mockup-search-pill"></div>
                    </div>

                    {{-- Window Body: 3 User Rows --}}
                    <div class="ns-mockup-body">
                        {{-- Row 1: Pesawat --}}
                        <div class="ns-mockup-row" style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 32px; height: 32px; min-width: 32px; border-radius: 50%; background: #e0f0ff; display: flex; align-items: center; justify-content: center;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0066f5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: block;">
                                    <path d="M17.8 19.2L16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.8c-.2.5 0 1.1.4 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.2 5.2c.2.4.8.6 1.3.4l.8-.3c.4-.2.6-.6.5-1.1z"/>
                                </svg>
                            </div>
                            <div class="ns-mockup-lines" style="flex-grow: 1;">
                                <div class="ns-line-main" style="width: 75%;"></div>
                                <div class="ns-line-sub" style="width: 45%;"></div>
                            </div>
                        </div>

                        {{-- Row 2: Taruna --}}
                        <div class="ns-mockup-row" style="display: flex; align-items: center; gap: 10px; margin-top: 8px;">
                            <div style="width: 32px; height: 32px; min-width: 32px; border-radius: 50%; background: #e6f7ef; display: flex; align-items: center; justify-content: center;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: block;">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <div class="ns-mockup-lines" style="flex-grow: 1;">
                                <div class="ns-line-main" style="width: 85%;"></div>
                                <div class="ns-line-sub" style="width: 50%;"></div>
                            </div>
                        </div>

                        {{-- Row 3: Instruktur --}}
                        <div class="ns-mockup-row" style="display: flex; align-items: center; gap: 10px; margin-top: 8px;">
                            <div style="width: 32px; height: 32px; min-width: 32px; border-radius: 50%; background: #fef3c7; display: flex; align-items: center; justify-content: center;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: block;">
                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                </svg>
                            </div>
                            <div class="ns-mockup-lines" style="flex-grow: 1;">
                                <div class="ns-line-main" style="width: 65%;"></div>
                                <div class="ns-line-sub" style="width: 40%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Text Content --}}
            <div class="ns-visual-text" id="dynamic-text-slider" style="text-align: left; align-items: flex-start;">
                <h2 class="ns-visual-heading" id="slider-heading" style="font-size: 18px; line-height: 1.4; transition: opacity 0.3s ease; text-align: left;">Flight Hours Scheduling Information System of API Banyuwangi</h2>
                <p class="ns-visual-subheading" id="slider-subheading" style="transition: opacity 0.3s ease; text-align: left;">Optimizing integrated real-time flight training management between cadets and instructors.</p>

                {{-- Pagination Dots (Left aligned) --}}
                <div class="ns-dots-row" id="slider-dots" style="justify-content: flex-start;">
                    <span class="ns-page-dot ns-dot-active" onclick="changeSlide(0)" style="cursor: pointer;"></span>
                    <span class="ns-page-dot" onclick="changeSlide(1)" style="cursor: pointer;"></span>
                    <span class="ns-page-dot" onclick="changeSlide(2)" style="cursor: pointer;"></span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Scoped Styles to Ensure 100% Exact Visual Match --}}
<script>
    const slides = [
        {
            heading: "Flight Hours Scheduling Information System of API Banyuwangi",
            subheading: "Optimizing integrated real-time flight training management between cadets and instructors."
        },
        {
            heading: "Digital Transformation of Modern Flight Operations",
            subheading: "Track flight hours progress, fleet availability, and training schedules in one centralized platform."
        },
        {
            heading: "Smart Integration for Cadets and Instructors Training",
            subheading: "Delivering transparency and precision in flight time allocation to produce skilled aviators."
        }
    ];

    let currentSlide = 0;
    const headingEl = document.getElementById('slider-heading');
    const subheadingEl = document.getElementById('slider-subheading');
    const dotsEl = document.getElementById('slider-dots').children;

    function updateSlide(index) {
        // Efek transisi pudar (fade) sederhana
        headingEl.style.opacity = 0;
        subheadingEl.style.opacity = 0;

        setTimeout(() => {
            headingEl.textContent = slides[index].heading;
            subheadingEl.textContent = slides[index].subheading;
            
            headingEl.style.opacity = 1;
            subheadingEl.style.opacity = 1;
        }, 300);

        // Update indikator titik aktif
        for (let i = 0; i < dotsEl.length; i++) {
            dotsEl[i].classList.remove('ns-dot-active');
        }
        dotsEl[index].classList.add('ns-dot-active');
    }

    function changeSlide(index) {
        currentSlide = index;
        updateSlide(currentSlide);
    }

    // Bergeser otomatis setiap 4 detik
    setInterval(() => {
        currentSlide = (currentSlide + 1) % slides.length;
        updateSlide(currentSlide);
    }, 4000);
</script>
<style>
    /* Full Page Container */
    .ns-auth-wrapper {
        min-height: 100vh;
        width: 100%;
        background-color: #d8e2ec;
        background-image:
            radial-gradient(at 0% 0%, #e2ecf7 0px, transparent 55%),
            radial-gradient(at 100% 100%, #cfdbe8 0px, transparent 55%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 20px;
        box-sizing: border-box;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }

    /* Main Dual-Tone Card */
    .ns-auth-card {
        width: 100%;
        max-width: 960px;
        min-height: 590px;
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 20px 50px -10px rgba(15, 23, 42, 0.15), 0 0 0 1px rgba(0, 0, 0, 0.03);
        display: grid;
        grid-template-columns: 1fr 1fr;
        overflow: hidden;
    }

    /* Left Form Side */
    .ns-auth-form-side {
        padding: 44px 44px 40px 44px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: #ffffff;
    }

    /* Brand Logo */
    .ns-brand-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 22px;
    }

    .ns-brand-logo {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .ns-brand-name {
        font-size: 20px;
        font-weight: 700;
        color: #0b57d0;
        letter-spacing: -0.4px;
    }

    /* Title & Subtitle */
    .ns-auth-title {
        font-size: 25px;
        font-weight: 700;
        color: #111827;
        margin: 0 0 6px 0;
        letter-spacing: -0.4px;
    }

    .ns-auth-subtitle {
        font-size: 13.5px;
        color: #6b7280;
        margin: 0 0 22px 0;
        line-height: 1.4;
    }

    /* Social Buttons */
    .ns-social-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 20px;
    }

    .ns-social-btn {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 13.5px;
        font-weight: 500;
        color: #374151;
        cursor: pointer;
        transition: all 0.15s ease;
        outline: none;
    }

    .ns-social-btn:hover {
        background-color: #f9fafb;
        border-color: #d1d5db;
    }

    /* Divider */
    .ns-divider {
        display: flex;
        align-items: center;
        margin: 16px 0 20px 0;
    }

    .ns-divider-line {
        flex: 1;
        height: 1px;
        background-color: #e5e7eb;
    }

    .ns-divider-text {
        padding: 0 12px;
        font-size: 11.5px;
        color: #9ca3af;
        font-weight: 500;
    }

    /* Form Inputs */
    .ns-input-group {
        margin-bottom: 14px;
    }

    .ns-input-wrapper {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        height: 44px;
        display: flex;
        align-items: center;
        padding: 0 14px;
        background: #ffffff;
        transition: all 0.15s ease;
    }

    .ns-input-wrapper:focus-within {
        border-color: #0062e3;
        box-shadow: 0 0 0 3px rgba(0, 98, 227, 0.12);
    }

    .ns-input-error {
        border-color: #ef4444 !important;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12) !important;
    }

    .ns-input-icon {
        color: #9ca3af;
        flex-shrink: 0;
    }

    .ns-input {
        border: none;
        outline: none;
        background: transparent;
        font-size: 14px;
        color: #111827;
        width: 100%;
        margin-left: 10px;
    }

    .ns-input::placeholder {
        color: #9ca3af;
    }

    .ns-eye-btn {
        background: none;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        padding: 0;
        display: flex;
        align-items: center;
        outline: none;
    }

    .ns-eye-btn:hover {
        color: #4b5563;
    }

    .ns-error-text {
        font-size: 12px;
        color: #ef4444;
        margin: 5px 0 0 2px;
    }

    /* Remember Row */
    .ns-remember-row {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin-top: 4px;
        margin-bottom: 22px;
    }

    .ns-remember-label {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        user-select: none;
        font-size: 13px;
        color: #4b5563;
    }

    .ns-checkbox {
        width: 16px;
        height: 16px;
        border-radius: 4px;
        border: 1px solid #d1d5db;
        accent-color: #0062e3;
        cursor: pointer;
    }

    /* Submit Button */
    .ns-submit-btn {
        width: 100%;
        height: 44px;
        background-color: #0062e3;
        color: #ffffff;
        font-size: 14.5px;
        font-weight: 600;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 14px rgba(0, 98, 227, 0.25);
        transition: background-color 0.15s ease, transform 0.05s ease;
    }

    .ns-submit-btn:hover {
        background-color: #0052cc;
    }

    .ns-submit-btn:active {
        transform: scale(0.99);
    }

    .ns-submit-btn:disabled {
        opacity: 0.75;
        cursor: not-allowed;
    }

    .ns-btn-loading {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .ns-spinner {
        width: 18px;
        height: 18px;
        animation: ns-spin 1s linear infinite;
    }

    @keyframes ns-spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* RIGHT VISUAL PANEL */
    .ns-auth-visual-side {
        background: linear-gradient(145deg, #0266f7 0%, #0051d2 100%);
        padding: 40px 36px 36px 36px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
        color: #ffffff;
    }

    .ns-visual-bg-glow {
        position: absolute;
        width: 380px;
        height: 380px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.12) 0%, transparent 70%);
        top: 15%;
        left: 50%;
        transform: translateX(-50%);
        pointer-events: none;
    }

    /* Graphic Container */
    .ns-graphic-container {
        position: relative;
        width: 100%;
        max-width: 360px;
        height: 290px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 15px;
    }

    /* Concentric Rings */
    .ns-ring-outer {
        position: absolute;
        width: 320px;
        height: 320px;
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, 0.12);
        pointer-events: none;
    }

    .ns-ring-inner {
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, 0.18);
        background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 75%);
        pointer-events: none;
    }

    /* Badges Column */
    .ns-badges-column {
        position: absolute;
        left: 20px;
        top: 30px;
        bottom: 30px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        z-index: 3;
    }

    .ns-badge-node {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #ffffff;
        box-shadow: 0 8px 18px rgba(0, 30, 80, 0.22);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.2s ease;
    }

    .ns-badge-node:hover {
        transform: scale(1.08);
    }

    /* Connector SVG */
    .ns-connecting-svg {
        position: absolute;
        left: 42px;
        top: 35px;
        width: 160px;
        height: 210px;
        z-index: 2;
        pointer-events: none;
    }

    /* Dashboard Mockup Card */
    .ns-dashboard-mockup {
        position: absolute;
        right: 18px;
        width: 185px;
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 18px 40px -5px rgba(0, 20, 70, 0.35);
        padding: 11px 13px;
        z-index: 3;
    }

    .ns-mockup-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 8px;
        margin-bottom: 8px;
        border-bottom: 1px solid #f1f5f9;
    }

    .ns-window-dots {
        display: flex;
        gap: 4px;
    }

    .ns-dot {
        width: 6.5px;
        height: 6.5px;
        border-radius: 50%;
    }

    .ns-dot-red { background-color: #ef4444; }
    .ns-dot-yellow { background-color: #f59e0b; }
    .ns-dot-green { background-color: #10b981; }

    .ns-mockup-search-pill {
        width: 45px;
        height: 5px;
        background-color: #e2e8f0;
        border-radius: 10px;
    }

    .ns-mockup-body {
        display: flex;
        flex-direction: column;
        gap: 9px;
    }

    .ns-mockup-row {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 5px 6px;
        background-color: #ffffff;
        border: 1px solid #f1f5f9;
        border-radius: 8px;
    }

    .ns-mockup-avatar {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
    }

    .ns-mockup-lines {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 3.5px;
    }

    .ns-line-main {
        height: 4.5px;
        background-color: #94a3b8;
        border-radius: 10px;
    }

    .ns-line-sub {
        height: 3.5px;
        background-color: #cbd5e1;
        border-radius: 10px;
    }

    /* Text Content */
    .ns-visual-text {
        text-align: center;
        z-index: 2;
        margin-top: 15px;
    }

    .ns-visual-heading {
        font-size: 20.5px;
        font-weight: 700;
        color: #ffffff;
        margin: 0;
        letter-spacing: -0.3px;
    }

    .ns-visual-subheading {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.85);
        margin: 7px 0 0 0;
        max-width: 320px;
        line-height: 1.45;
    }

    .ns-dots-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        margin-top: 22px;
    }

    .ns-page-dot {
        width: 6.5px;
        height: 6.5px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.35);
        transition: all 0.2s ease;
    }

    .ns-dot-active {
        background: #ffffff;
        width: 7.5px;
        height: 7.5px;
    }

    /* Mobile Responsive */
    @media (max-width: 820px) {
        .ns-auth-card {
            grid-template-columns: 1fr;
            max-width: 450px;
        }

        .ns-auth-visual-side {
            display: none;
        }

        .ns-auth-form-side {
            padding: 36px 28px;
        }
    }
    /* Mengatasi blok background abu-abu saat browser melakukan autofill */
    .ns-input:-webkit-autofill,
    .ns-input:-webkit-autofill:hover, 
    .ns-input:-webkit-autofill:focus, 
    .ns-input:-webkit-autofill:active {
        -webkit-box-shadow: 0 0 0 30px #ffffff inset !important;
        -webkit-text-fill-color: #111827 !important;
        transition: background-color 5000s ease-in-out 0s;
    }
</style>
