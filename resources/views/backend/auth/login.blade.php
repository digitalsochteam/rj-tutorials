<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login &mdash; RJ Tutorials</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap"
        rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --brand: #ff6700;
            --brand-dark: #e05a00;
            --brand-light: #fff4ec;
            --text: #1a202c;
            --text-muted: #6b7280;
            --border: #e5e7eb;
            --bg: #f9fafb;
            --white: #ffffff;
            --danger: #ef4444;
            --danger-bg: #fef2f2;
            --danger-border: #fecaca;
            --radius: 10px;
        }

        body {
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
            background: var(--bg);
            min-height: 100vh;
            display: flex;
        }

        /* â•â• LEFT BRAND PANEL â•â• */
        .brand-panel {
            width: 48%;
            background: linear-gradient(155deg, #1a1a2e 0%, #16213e 40%, #0f3460 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2.5rem;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .deco-circle-1 {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 103, 0, 0.15) 0%, transparent 70%);
            top: -150px;
            right: -150px;
            pointer-events: none;
        }

        .deco-circle-2 {
            position: absolute;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.15) 0%, transparent 70%);
            bottom: -100px;
            left: -100px;
            pointer-events: none;
        }

        .deco-circle-3 {
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(251, 191, 36, 0.12) 0%, transparent 70%);
            bottom: 120px;
            right: -50px;
            pointer-events: none;
        }

        .float-badge {
            position: absolute;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            padding: 0.5rem 0.85rem;
            font-size: 0.78rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            gap: 0.4rem;
            animation: floatBadge 4s ease-in-out infinite;
            z-index: 3;
        }

        .float-badge.b1 {
            top: 12%;
            left: 5%;
            animation-delay: 0s;
        }

        .float-badge.b2 {
            top: 18%;
            right: 4%;
            animation-delay: 0.8s;
        }

        .float-badge.b3 {
            bottom: 22%;
            left: 4%;
            animation-delay: 1.6s;
        }

        .float-badge.b4 {
            bottom: 13%;
            right: 5%;
            animation-delay: 2.4s;
        }

        .float-badge .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }

        .float-badge.jee .dot {
            background: #fbbf24;
        }

        .float-badge.neet .dot {
            background: #34d399;
        }

        .float-badge.mhcet .dot {
            background: #60a5fa;
        }

        .float-badge.cbse .dot {
            background: #f87171;
        }

        @keyframes floatBadge {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        .brand-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 340px;
            width: 100%;
        }

        .brand-icon-wrap {
            width: 88px;
            height: 88px;
            border-radius: 22px;
            background: linear-gradient(135deg, #ff6700, #fbbf24);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.4rem;
            box-shadow: 0 8px 32px rgba(255, 103, 0, 0.4);
        }

        .brand-name {
            font-family: 'Poppins', sans-serif;
            font-size: 1.9rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            line-height: 1;
            margin-bottom: 0.4rem;
        }

        .brand-name span {
            color: #ff6700;
        }

        .brand-tagline {
            font-size: 0.9rem;
            font-weight: 500;
            opacity: 0.7;
            margin-bottom: 1.8rem;
            line-height: 1.5;
        }

        .illus-box {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 18px;
            padding: 1.5rem 1.25rem;
            margin-bottom: 1.5rem;
        }

        .subject-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.65rem;
            text-align: left;
        }

        .subject-card {
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 0.7rem 0.85rem;
            transition: background 0.2s;
        }

        .subject-card:hover {
            background: rgba(255, 255, 255, 0.13);
        }

        .sc-icon {
            font-size: 1.25rem;
            margin-bottom: 0.25rem;
        }

        .sc-label {
            font-size: 0.68rem;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.45);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .sc-name {
            font-size: 0.88rem;
            font-weight: 600;
            color: #fff;
        }

        .stats-row {
            display: flex;
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .stat {
            flex: 1;
            text-align: center;
            padding: 0.85rem 0.5rem;
            background: rgba(255, 255, 255, 0.05);
            border-right: 1px solid rgba(255, 255, 255, 0.08);
        }

        .stat:last-child {
            border-right: none;
        }

        .stat-num {
            font-family: 'Poppins', sans-serif;
            font-size: 1.25rem;
            font-weight: 800;
            color: #ff6700;
        }

        .stat-lab {
            font-size: 0.68rem;
            color: rgba(255, 255, 255, 0.45);
            font-weight: 500;
            margin-top: 0.1rem;
        }

        /* â•â• RIGHT FORM PANEL â•â• */
        .form-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
            background: var(--white);
        }

        .form-box {
            width: 100%;
            max-width: 420px;
        }

        .back-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: var(--brand-light);
            color: var(--brand);
            border-radius: 999px;
            padding: 0.3rem 0.85rem;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 1.2rem;
        }

        .form-box h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.02em;
            line-height: 1.2;
        }

        .form-box .sub {
            color: var(--text-muted);
            font-size: 0.88rem;
            margin-top: 0.4rem;
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 0.45rem;
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
            padding: 0.75rem 0.9rem 0.75rem 2.5rem;
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            font-size: 0.92rem;
            color: var(--text);
            background: #fafafa;
            transition: border-color 0.15s, box-shadow 0.15s, background 0.15s;
            outline: none;
            font-family: inherit;
        }

        .input-wrapper input:focus {
            border-color: var(--brand);
            box-shadow: 0 0 0 3px rgba(255, 103, 0, 0.12);
            background: #fff;
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
            color: var(--brand);
        }

        .input-error {
            color: var(--danger);
            font-size: 0.78rem;
            margin-top: 0.35rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 0.45rem;
            margin-bottom: 1.5rem;
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

        .btn-primary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            padding: 0.83rem;
            background: linear-gradient(135deg, #ff6700, #e05a00);
            color: #fff;
            border: none;
            border-radius: var(--radius);
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            letter-spacing: 0.01em;
            box-shadow: 0 4px 16px rgba(255, 103, 0, 0.35);
            transition: transform 0.15s, box-shadow 0.15s, opacity 0.15s;
        }

        .btn-primary:hover {
            opacity: 0.92;
            box-shadow: 0 6px 24px rgba(255, 103, 0, 0.45);
        }

        .btn-primary:active {
            transform: scale(0.99);
        }

        .security-note {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 0.65rem 0.9rem;
            font-size: 0.78rem;
            color: #15803d;
            margin-top: 1.25rem;
        }

        .footer-note {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.78rem;
            color: #d1d5db;
        }

        @media (max-width: 900px) {
            .brand-panel {
                width: 42%;
                padding: 2rem 1.5rem;
            }
        }

        @media (max-width: 700px) {
            .brand-panel {
                display: none;
            }

            .form-panel {
                padding: 2rem 1.25rem;
                background: var(--bg);
            }
        }
    </style>
</head>

<body>

    <!-- â•â• LEFT: Educational Brand Panel â•â• -->
    <div class="brand-panel">
        <div class="deco-circle-1"></div>
        <div class="deco-circle-2"></div>
        <div class="deco-circle-3"></div>

        <div class="float-badge jee b1"><span class="dot"></span> JEE Mains &amp; Advanced</div>
        <div class="float-badge neet b2"><span class="dot"></span> NEET Preparation</div>
        <div class="float-badge mhcet b3"><span class="dot"></span> MHT-CET</div>
        <div class="float-badge cbse b4"><span class="dot"></span> CBSE / ICSE</div>

        <div class="brand-content">
            <div class="brand-icon-wrap">
                <svg width="46" height="46" viewBox="0 0 48 48" fill="none">
                    <path d="M24 6L4 16l20 10 20-10L24 6z" fill="#fff" opacity="0.95" />
                    <path d="M4 26l20 10 20-10" stroke="#fff" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round" opacity="0.7" />
                    <path d="M4 21l20 10 20-10" stroke="#fff" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round" opacity="0.5" />
                    <rect x="38" y="16" width="3" height="13" rx="1.5" fill="#fff" opacity="0.8" />
                    <path d="M39.5 31 L37 35 L42 35 Z" fill="#fff" opacity="0.8" />
                </svg>
            </div>
            <div class="brand-name">RJ <span>Tutorials</span></div>
            <p class="brand-tagline">Admin Panel &mdash; Manage courses, students &amp; results</p>

            <div class="illus-box">
                <div class="subject-row">
                    <div class="subject-card">
                        <div class="sc-icon">âš—ï¸</div>
                        <div class="sc-label">Science</div>
                        <div class="sc-name">Chemistry</div>
                    </div>
                    <div class="subject-card">
                        <div class="sc-icon">ðŸ”­</div>
                        <div class="sc-label">Science</div>
                        <div class="sc-name">Physics</div>
                    </div>
                    <div class="subject-card">
                        <div class="sc-icon">ðŸ§¬</div>
                        <div class="sc-label">Science</div>
                        <div class="sc-name">Biology</div>
                    </div>
                    <div class="subject-card">
                        <div class="sc-icon">ðŸ“</div>
                        <div class="sc-label">Maths</div>
                        <div class="sc-name">Mathematics</div>
                    </div>
                </div>
            </div>

            <div class="stats-row">
                <div class="stat">
                    <div class="stat-num">500+</div>
                    <div class="stat-lab">Students</div>
                </div>
                <div class="stat">
                    <div class="stat-num">10+</div>
                    <div class="stat-lab">Courses</div>
                </div>
                <div class="stat">
                    <div class="stat-num">98%</div>
                    <div class="stat-lab">Results</div>
                </div>
            </div>
        </div>
    </div>

    <!-- â•â• RIGHT: Login Form â•â• -->
    <div class="form-panel">
        <div class="form-box">

            <div class="back-badge">
                <svg width="12" height="12" fill="none" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Admin Portal
            </div>
            <h1>Welcome back </h1>
            <p class="sub">Sign in to manage RJ Tutorials courses, students &amp; more.</p>

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
                            autocomplete="username" placeholder="admin@rjtutorials.com"
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
                            placeholder="â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢"
                            class="{{ $errors->has('password') ? 'is-error' : '' }}">
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

                <div class="remember-row">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Keep me signed in</label>
                </div>

                <button type="submit" class="btn-primary">
                    <svg width="17" height="17" fill="none" viewBox="0 0 24 24">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M15 12H3" stroke="currentColor"
                            stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Sign In to Dashboard
                </button>
            </form>

            <div class="security-note">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24">
                    <path d="M12 2L3 7v5c0 5.25 3.75 10.15 9 11.25C17.25 22.15 21 17.25 21 12V7L12 2z" stroke="#16a34a"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9 12l2 2 4-4" stroke="#16a34a" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                Secured access &mdash; authorized personnel only
            </div>

            <p class="footer-note">&copy; {{ date('Y') }} RJ Tutorials. All rights reserved.</p>
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

</html>