<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In &mdash; {{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --brand: #4f46e5;
            --brand-dark: #4338ca;
            --brand-light: #eef2ff;
            --text: #111827;
            --text-muted: #6b7280;
            --border: #e5e7eb;
            --bg: #f9fafb;
            --white: #ffffff;
            --danger: #ef4444;
            --danger-bg: #fef2f2;
            --danger-border: #fecaca;
            --radius: 10px;
            --shadow: 0 10px 40px rgba(0, 0, 0, 0.10);
        }

        body {
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
            background: var(--bg);
            min-height: 100vh;
            display: flex;
        }

        /* ── Left brand panel ── */
        .brand-panel {
            width: 45%;
            background: linear-gradient(145deg, #4f46e5 0%, #7c3aed 60%, #a855f7 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .brand-panel::before {
            content: '';
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
            top: -100px;
            right: -100px;
        }

        .brand-panel::after {
            content: '';
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
            bottom: -60px;
            left: -60px;
        }

        .brand-logo {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.03em;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .brand-logo span {
            opacity: 0.7;
        }

        .brand-tagline {
            font-size: 1.35rem;
            font-weight: 600;
            text-align: center;
            line-height: 1.4;
            max-width: 280px;
            position: relative;
            z-index: 1;
        }

        .brand-sub {
            margin-top: 0.75rem;
            font-size: 0.9rem;
            opacity: 0.75;
            text-align: center;
            max-width: 260px;
            line-height: 1.5;
            position: relative;
            z-index: 1;
        }

        .brand-pills {
            margin-top: 2.5rem;
            display: flex;
            gap: 0.6rem;
            flex-wrap: wrap;
            justify-content: center;
            position: relative;
            z-index: 1;
        }

        .pill {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 999px;
            padding: 0.35rem 0.9rem;
            font-size: 0.78rem;
            font-weight: 500;
        }

        /* ── Right form panel ── */
        .form-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
        }

        .form-box {
            width: 100%;
            max-width: 420px;
        }

        .form-box h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.02em;
        }

        .form-box .sub {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-top: 0.35rem;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 0.45rem;
            letter-spacing: 0.01em;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            display: flex;
            pointer-events: none;
        }

        .input-wrapper input {
            width: 100%;
            padding: 0.7rem 0.9rem 0.7rem 2.5rem;
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            font-size: 0.92rem;
            color: var(--text);
            background: var(--white);
            transition: border-color 0.15s, box-shadow 0.15s;
            outline: none;
            font-family: inherit;
        }

        .input-wrapper input:focus {
            border-color: var(--brand);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
        }

        .input-wrapper input.is-error {
            border-color: var(--danger);
        }

        .input-wrapper input.is-error:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12);
        }

        .toggle-pw {
            position: absolute;
            right: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #9ca3af;
            display: flex;
            padding: 0;
        }

        .toggle-pw:hover {
            color: var(--text-muted);
        }

        .input-error {
            color: var(--danger);
            font-size: 0.78rem;
            margin-top: 0.35rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .row-between {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 0.45rem;
        }

        .remember-row input[type=checkbox] {
            accent-color: var(--brand);
            width: 15px;
            height: 15px;
            cursor: pointer;
        }

        .remember-row label {
            margin-bottom: 0;
            font-weight: 400;
            font-size: 0.85rem;
            cursor: pointer;
            color: var(--text-muted);
        }

        .btn-primary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            padding: 0.78rem;
            background: var(--brand);
            color: #fff;
            border: none;
            border-radius: var(--radius);
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s, transform 0.1s, box-shadow 0.15s;
            font-family: inherit;
            letter-spacing: 0.01em;
            box-shadow: 0 2px 8px rgba(79, 70, 229, 0.3);
        }

        .btn-primary:hover {
            background: var(--brand-dark);
            box-shadow: 0 4px 16px rgba(79, 70, 229, 0.4);
        }

        .btn-primary:active {
            transform: scale(0.99);
        }

        .alert-error {
            background: var(--danger-bg);
            border: 1px solid var(--danger-border);
            color: #b91c1c;
            border-radius: var(--radius);
            padding: 0.75rem 1rem;
            font-size: 0.86rem;
            margin-bottom: 1.4rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 1.5rem 0;
            color: var(--border);
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .footer-note {
            text-align: center;
            margin-top: 1.75rem;
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .brand-panel {
                display: none;
            }

            .form-panel {
                padding: 2rem 1.25rem;
            }
        }
    </style>
</head>

<body>
    <!-- Brand panel -->
    <div class="brand-panel">
        <div class="brand-logo">{{ config('app.name', 'Laravel') }}<span>.</span></div>
        <p class="brand-tagline">Your all-in-one admin & analytics platform</p>
        <p class="brand-sub">Manage users, track metrics, and grow your business — all from one place.</p>
        <div class="brand-pills">
            <span class="pill">&#10003; Analytics</span>
            <span class="pill">&#10003; User Management</span>
            <span class="pill">&#10003; Reports</span>
            <span class="pill">&#10003; Secure</span>
        </div>
    </div>

    <!-- Form panel -->
    <div class="form-panel">
        <div class="form-box">
            <h1>Welcome back</h1>
            <p class="sub">Sign in to your account to continue</p>

            @if ($errors->any())
                <div class="alert-error">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke="#ef4444" stroke-width="2" />
                        <path d="M12 8v4m0 4h.01" stroke="#ef4444" stroke-width="2" stroke-linecap="round" />
                    </svg>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email address</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                                <path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"
                                    stroke="currentColor" stroke-width="1.8" />
                                <path d="M22 6 12 13 2 6" stroke="currentColor" stroke-width="1.8"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            autocomplete="username" placeholder="you@example.com"
                            class="{{ $errors->has('email') ? 'is-error' : '' }}">
                    </div>
                    @error('email')
                        <p class="input-error">
                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" stroke="#ef4444" stroke-width="2" />
                                <path d="M12 8v4m0 4h.01" stroke="#ef4444" stroke-width="2" stroke-linecap="round" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                                <rect x="3" y="11" width="18" height="11" rx="2" stroke="currentColor"
                                    stroke-width="1.8" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" />
                            </svg>
                        </span>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            placeholder="••••••••" class="{{ $errors->has('password') ? 'is-error' : '' }}">
                        <button type="button" class="toggle-pw" onclick="togglePw()" title="Show/hide password">
                            <svg id="eye-icon" width="16" height="16" fill="none" viewBox="0 0 24 24">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor"
                                    stroke-width="1.8" />
                                <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="input-error">
                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" stroke="#ef4444" stroke-width="2" />
                                <path d="M12 8v4m0 4h.01" stroke="#ef4444" stroke-width="2" stroke-linecap="round" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="row-between">
                    <div class="remember-row">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                </div>

                <button type="submit" class="btn-primary">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M15 12H3" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Sign in
                </button>
            </form>

            <p class="footer-note">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
            </p>
        </div>
    </div>

    <script>
        function togglePw() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><line x1="1" y1="1" x2="23" y2="23" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8"/>';
            }
        }
    </script>
</body>

</html>