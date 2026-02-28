<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title', 'Dashboard') — Admin Panel</title>
    <style>
        /* ══ RESET & BASE ══ */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }

        /* ══ DESIGN TOKENS ══ */
        :root {
            --brand: #66003b;
            --brand-dark: #4d002b;
            --brand-mid: #88004f;
            --brand-light: #fce7f3;
            --brand-xlight: #fff0f8;
            --bg: #f4f0f3;
            --white: #ffffff;
            --border: #e8dde3;
            --text: #1a0011;
            --text-muted: #6b5660;
            --sidebar-w: 252px;
            --topbar-h: 64px;
            --radius: 14px;
            --radius-lg: 18px;
            --shadow-sm: 0 1px 4px rgba(102, 0, 59, .06), 0 1px 2px rgba(0, 0, 0, .04);
            --shadow-md: 0 6px 20px rgba(102, 0, 59, .10);
            --shadow-lg: 0 12px 40px rgba(102, 0, 59, .14);
            --transition: 0.2s cubic-bezier(.4, 0, .2, 1);
        }

        /* ══ SIDEBAR ══ */
        .sidebar {
            position: fixed;
            inset-block: 0;
            left: 0;
            width: var(--sidebar-w);
            background: linear-gradient(180deg, #1a0011 0%, #2d001a 100%);
            border-right: none;
            box-shadow: 2px 0 16px rgba(0, 0, 0, .18);
            display: flex;
            flex-direction: column;
            z-index: 50;
            overflow-y: auto;
            padding-bottom: 1.5rem;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.1rem 1.25rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, .1);
            flex-shrink: 0;
        }

        .sidebar-logo img {
            height: 42px;
            width: auto;
            object-fit: contain;
            display: block;
        }

        .sidebar-section {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: rgba(255, 255, 255, .35);
            padding: 1.25rem 1.25rem 0.4rem;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 2px;
            padding: 0 0.75rem;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.55rem 0.65rem;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            color: rgba(255, 255, 255, .6);
            transition: background 0.15s, color 0.15s;
            cursor: pointer;
        }

        .sidebar-nav a:hover {
            background: rgba(255, 255, 255, .1);
            color: #ffffff;
            padding-left: 0.9rem;
        }

        .sidebar-nav a.active {
            background: linear-gradient(90deg, rgba(255, 255, 255, .18) 0%, rgba(255, 255, 255, .06) 100%);
            color: #ffffff;
            font-weight: 600;
            border-left: 3px solid rgba(255, 200, 230, .85);
            padding-left: calc(0.65rem - 3px);
        }

        .nav-icon {
            flex-shrink: 0;
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 1rem 1.25rem 0;
            border-top: 1px solid rgba(255, 255, 255, .1);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.65rem 0;
        }

        .avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .2);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1.5px solid rgba(255, 255, 255, .35);
        }

        .sidebar-user-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: #ffffff;
        }

        .sidebar-user-role {
            font-size: 0.72rem;
            color: rgba(255, 255, 255, .45);
        }

        /* ══ TOPBAR ══ */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-w);
            right: 0;
            height: var(--topbar-h);
            background: rgba(255, 255, 255, .92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            z-index: 40;
            box-shadow: 0 1px 0 rgba(102, 0, 59, .05), 0 2px 8px rgba(0, 0, 0, .04);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 0.85rem;
        }

        .topbar-title {
            font-size: 1.05rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-mid) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .topbar-date {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 1px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .topbar-btn {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--bg);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-muted);
            transition: all var(--transition);
            position: relative;
        }

        .topbar-btn:hover {
            background: var(--brand-light);
            border-color: var(--brand);
            color: var(--brand);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        .notif-dot {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 7px;
            height: 7px;
            background: var(--brand);
            border-radius: 50%;
            border: 1.5px solid var(--white);
        }

        /* ══ HAMBURGER ══ */
        .hamburger {
            display: none;
            flex-direction: column;
            justify-content: center;
            gap: 5px;
            width: 36px;
            height: 36px;
            background: none;
            border: 1px solid var(--border);
            border-radius: 8px;
            cursor: pointer;
            padding: 0 8px;
        }

        .hamburger span {
            display: block;
            height: 2px;
            background: var(--text);
            border-radius: 2px;
            transition: transform .25s, opacity .25s;
        }

        .hamburger.open span:nth-child(1) {
            transform: translateY(7px) rotate(45deg);
        }

        .hamburger.open span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.open span:nth-child(3) {
            transform: translateY(-7px) rotate(-45deg);
        }

        /* ══ SIDEBAR OVERLAY ══ */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .4);
            z-index: 45;
            backdrop-filter: blur(2px);
        }

        .sidebar-overlay.visible {
            display: block;
        }

        /* ══ MAIN AREA ══ */
        .main {
            margin-left: var(--sidebar-w);
            padding-top: var(--topbar-h);
            min-height: 100vh;
        }

        .main-inner {
            padding: 2rem 2.25rem;
        }

        /* ══ PANELS ══ */
        .panel {
            display: none;
        }

        .panel.active {
            display: block;
            animation: panelFadeIn 0.3s cubic-bezier(.4, 0, .2, 1);
        }

        @keyframes panelFadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ══ STAT CARDS ══ */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 1.4rem 1.4rem 1.1rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            box-shadow: var(--shadow-sm);
            transition: transform var(--transition), box-shadow var(--transition);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            border-radius: var(--radius-lg) var(--radius-lg) 0 0;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .stat-card.violet::before {
            background: linear-gradient(90deg, #7c3aed, #a855f7);
        }

        .stat-card.blue::before {
            background: linear-gradient(90deg, #3b82f6, #60a5fa);
        }

        .stat-card.green::before {
            background: linear-gradient(90deg, #16a34a, #22c55e);
        }

        .stat-card.amber::before {
            background: linear-gradient(90deg, #d97706, #f59e0b);
        }

        .stat-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }

        .stat-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-icon.blue {
            background: linear-gradient(135deg, #dbeafe, #eff6ff);
            color: #2563eb;
            box-shadow: 0 2px 8px rgba(59, 130, 246, .2);
        }

        .stat-icon.green {
            background: linear-gradient(135deg, #dcfce7, #f0fdf4);
            color: #16a34a;
            box-shadow: 0 2px 8px rgba(34, 197, 94, .2);
        }

        .stat-icon.violet {
            background: linear-gradient(135deg, #ede9fe, #f5f3ff);
            color: #7c3aed;
            box-shadow: 0 2px 8px rgba(124, 58, 237, .2);
        }

        .stat-icon.amber {
            background: linear-gradient(135deg, #fde68a, #fffbeb);
            color: #d97706;
            box-shadow: 0 2px 8px rgba(245, 158, 11, .2);
        }

        .stat-trend {
            font-size: 0.72rem;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: 20px;
            letter-spacing: 0.01em;
        }

        .stat-trend.up {
            background: #dcfce7;
            color: #16a34a;
        }

        .stat-trend.down {
            background: #fee2e2;
            color: #dc2626;
        }

        .stat-trend.flat {
            background: var(--bg);
            color: var(--text-muted);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 900;
            letter-spacing: -0.04em;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-top: 0.2rem;
            font-weight: 500;
        }

        .stat-bar-bg {
            height: 6px;
            background: var(--bg);
            border-radius: 99px;
            overflow: hidden;
        }

        .stat-bar {
            height: 6px;
            border-radius: 99px;
            transition: width 1s cubic-bezier(.4, 0, .2, 1);
        }

        /* ══ TABLE CARD ══ */
        .table-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .table-responsive-wrap {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.1rem 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .table-card-title {
            font-weight: 800;
            font-size: 1rem;
        }

        .table-card-sub {
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-top: 0.15rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            padding: 0.75rem 1.25rem;
            text-align: left;
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: var(--brand);
            background: linear-gradient(to bottom, var(--brand-xlight), var(--bg));
            border-bottom: 1px solid var(--brand-light);
        }

        td {
            padding: 0.85rem 1.25rem;
            border-bottom: 1px solid var(--border);
            font-size: 0.875rem;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: var(--brand-xlight);
        }

        .td-action {
            font-weight: 500;
        }

        .td-email {
            color: var(--text-muted);
            font-size: 0.82rem;
        }

        .td-date {
            color: var(--text-muted);
            font-size: 0.78rem;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 9px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .badge-green {
            background: #f0fdf4;
            color: #16a34a;
        }

        .badge-yellow {
            background: #fefce8;
            color: #ca8a04;
        }

        .badge-red {
            background: #fef2f2;
            color: #dc2626;
        }

        /* ══ BTN-SM ══ */
        .btn-sm {
            padding: 0.4rem 0.9rem;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            font-family: inherit;
            transition: all var(--transition);
        }

        .btn-sm:hover {
            background: var(--brand-light);
            border-color: var(--brand);
            color: var(--brand);
        }

        /* ══ FORM CARDS (About Us) ══ */
        .form-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            margin-bottom: 1.75rem;
            box-shadow: var(--shadow-sm);
            transition: box-shadow var(--transition);
        }

        .form-card:focus-within {
            box-shadow: var(--shadow-md);
        }

        .form-card-header {
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid var(--border);
            border-left: 4px solid var(--brand);
            background: linear-gradient(to right, var(--brand-xlight), var(--white));
        }

        .form-card-title {
            font-weight: 700;
            font-size: 0.95rem;
        }

        .form-card-sub {
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-top: 0.15rem;
        }

        .form-body {
            padding: 1.5rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.45rem;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label,
        .form-label {
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        input[type="text"],
        input[type="number"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 0.6rem 0.85rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 0.875rem;
            font-family: inherit;
            color: var(--text);
            background: var(--white);
            outline: none;
            transition: border 0.15s, box-shadow 0.15s;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="email"]:focus,
        textarea:focus {
            border-color: var(--brand);
            box-shadow: 0 0 0 3px rgba(102, 0, 59, .12);
        }

        textarea {
            resize: vertical;
            min-height: 95px;
        }

        input[type="file"] {
            font-size: 0.85rem;
            color: var(--text-muted);
            width: 100%;
        }

        .img-preview {
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .img-preview img {
            width: 90px;
            height: 65px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid var(--border);
        }

        .img-preview span {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        /* ══ BUTTONS ══ */
        .btn-primary {
            padding: 0.65rem 1.5rem;
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-mid) 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            transition: all var(--transition);
            box-shadow: 0 2px 8px rgba(102, 0, 59, .3);
            letter-spacing: 0.01em;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--brand-dark) 0%, var(--brand) 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(102, 0, 59, .35);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-secondary {
            padding: 0.6rem 1.1rem;
            background: var(--white);
            color: var(--text-muted);
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            font-family: inherit;
            transition: background 0.15s;
            display: inline-flex;
            align-items: center;
        }

        .btn-secondary:hover {
            background: var(--bg);
        }

        /* ══ ALERTS ══ */
        .alert-success {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            padding: 0.85rem 1.2rem;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            color: #15803d;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
        }

        .alert-error {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            padding: 0.85rem 1.2rem;
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 10px;
            color: #b91c1c;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
        }

        /* ══ RESPONSIVE ══ */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform .28s cubic-bezier(.4, 0, .2, 1);
                z-index: 60;
                background: linear-gradient(180deg, #1a0011 0%, #2d001a 100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .topbar {
                left: 0;
                padding: 0 1rem;
            }

            .hamburger {
                display: flex;
            }

            .topbar-date {
                display: none;
            }

            .main {
                margin-left: 0;
            }

            .main-inner {
                padding: 1.25rem 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .table-card-header {
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .table-responsive-wrap table {
                min-width: 560px;
            }

            th,
            td {
                white-space: nowrap;
            }
        }

        /* ══ HERO GREETING CARD ══ */
        .hero-card {
            background: linear-gradient(135deg, var(--brand) 0%, #aa005a 50%, #cc006e 100%);
            border-radius: var(--radius-lg);
            padding: 2rem 2.25rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(102, 0, 59, .28);
        }

        .hero-card::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, .07);
            border-radius: 50%;
        }

        .hero-card::after {
            content: '';
            position: absolute;
            bottom: -60px;
            right: 80px;
            width: 160px;
            height: 160px;
            background: rgba(255, 255, 255, .05);
            border-radius: 50%;
        }

        .hero-greeting {
            font-size: 1.55rem;
            font-weight: 900;
            color: #ffffff;
            letter-spacing: -0.03em;
            line-height: 1.2;
            position: relative;
            z-index: 1;
        }

        .hero-sub {
            font-size: 0.88rem;
            color: rgba(255, 255, 255, .75);
            margin-top: 0.35rem;
            position: relative;
            z-index: 1;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(255, 255, 255, .18);
            backdrop-filter: blur(8px);
            color: #fff;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.35rem 0.85rem;
            border-radius: 99px;
            border: 1px solid rgba(255, 255, 255, .25);
            margin-bottom: 0.85rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        /* ══ QUICK ACTIONS ══ */
        .quick-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .quick-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.1rem 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.9rem;
            cursor: pointer;
            transition: all var(--transition);
            box-shadow: var(--shadow-sm);
            text-decoration: none;
            color: var(--text);
        }

        .quick-card:hover {
            border-color: var(--brand);
            background: var(--brand-xlight);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            color: var(--brand);
        }

        .quick-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--brand-light);
            color: var(--brand);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background var(--transition);
        }

        .quick-card:hover .quick-icon {
            background: var(--brand);
            color: #fff;
        }

        .quick-label {
            font-size: 0.82rem;
            font-weight: 700;
        }

        .quick-sublabel {
            font-size: 0.72rem;
            color: var(--text-muted);
            margin-top: 1px;
        }

        /* ══ SECTION HEADER ══ */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
        }

        .section-title {
            font-size: 1rem;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .section-sub {
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-top: 0.1rem;
        }

        @stack('styles')
    </style>
    {{-- Summernote Lite --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        /* Summernote overrides to match admin theme */
        .note-editor.note-frame {
            border: 1.5px solid var(--border, #e2e8f0);
            border-radius: 8px;
            overflow: hidden;
        }

        .note-toolbar {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 6px 8px;
            flex-wrap: wrap;
        }

        .note-btn {
            border-radius: 5px !important;
            font-size: .8rem;
        }

        .note-editable {
            font-family: Inter, Segoe UI, sans-serif;
            font-size: 15px;
            color: #1a0011;
            line-height: 1.75;
            min-height: 320px;
            padding: 14px 16px;
        }

        .note-statusbar {
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>

<body>

    {{-- Sidebar overlay (mobile) --}}
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    {{-- ══ SIDEBAR ══ --}}
    @include('backend.partials.sidebar')

    {{-- ══ TOPBAR ══ --}}
    <header class="topbar">
        <div class="topbar-left">
            <button class="hamburger" id="hamburger" onclick="toggleSidebar()" aria-label="Toggle sidebar">
                <span></span><span></span><span></span>
            </button>
            <div>
                <div class="topbar-title" id="topbar-title">@yield('page-title', 'Dashboard')</div>
                <div class="topbar-date">{{ now()->format('l, F j Y') }}</div>
            </div>
        </div>
        <div class="topbar-right">
            {{-- Notification bell --}}
            <div class="topbar-btn" title="Notifications">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" />
                    <path d="M13.73 21a2 2 0 0 1-3.46 0" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" />
                </svg>
                @if(isset($unreadCount) && $unreadCount > 0)<span class="notif-dot"></span>@endif
            </div>

            {{-- User pill --}}
            <div
                style="display:flex;align-items:center;gap:.55rem;padding:.35rem .8rem .35rem .45rem;background:var(--brand-xlight);border:1px solid var(--brand-light);border-radius:99px;cursor:default;">
                <div
                    style="width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,var(--brand),var(--brand-mid));color:#fff;font-size:.72rem;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <span
                    style="font-size:.8rem;font-weight:700;color:var(--brand);max-width:100px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ explode(' ', auth()->user()->name)[0] }}</span>
            </div>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}" style="display:contents;">
                @csrf
                <button type="submit" class="topbar-btn" title="Log out">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" />
                        <polyline points="16 17 21 12 16 7" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <line x1="21" y1="12" x2="9" y2="12" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" />
                    </svg>
                </button>
            </form>
        </div>
    </header>

    {{-- ══ MAIN CONTENT ══ --}}
    <main class="main">
        <div class="main-inner">
            @yield('content')
        </div>
    </main>

    {{-- ══ BASE JS ══ --}}
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('visible');
            document.getElementById('hamburger').classList.toggle('open');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').classList.remove('visible');
            document.getElementById('hamburger').classList.remove('open');
        }
        window.addEventListener('resize', () => { if (window.innerWidth > 768) closeSidebar(); });
    </script>

    {{-- jQuery (required by Summernote) --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    {{-- Summernote Lite WYSIWYG --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function () {
            $('textarea.wysiwyg').summernote({
                height: 380,
                minHeight: 200,
                maxHeight: null,
                focus: false,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview', 'undo', 'redo']],
                ],
                styleTags: ['p', 'h1', 'h2', 'h3', 'h4', 'blockquote', 'pre'],
                fontNames: ['Arial', 'Georgia', 'Inter', 'Roboto', 'Times New Roman', 'Courier New'],
                fontSizes: ['12', '13', '14', '15', '16', '18', '20', '24', '28', '32', '36'],
                callbacks: {
                    onImageUpload: function (files) {
                        // prevent default file upload if no server route set
                        return false;
                    }
                }
            });
        });
    </script>
    @stack('scripts')

</body>

</html>