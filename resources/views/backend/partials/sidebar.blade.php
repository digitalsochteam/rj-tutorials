<aside class="sidebar" id="sidebar">

    {{-- Logo --}}
    <div class="sidebar-logo">
        <img src="{{ asset('assets/images/resources/logo-1.png') }}" alt="RJ Tutorials">
    </div>

    {{-- Main Menu --}}
    <div class="sidebar-section">Main Menu</div>
    <nav class="sidebar-nav">
        <a href="{{ route('dashboard') }}" id="nav-overview"
            class="{{ request()->routeIs('dashboard') && !in_array(request('panel'), ['about', 'team']) ? 'active' : '' }}"
            onclick="if(window.switchPanel) { switchPanel('overview'); return false; }">
            <svg class="nav-icon" width="16" height="16" fill="none" viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.8" />
                <rect x="14" y="3" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.8" />
                <rect x="3" y="14" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.8" />
                <rect x="14" y="14" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.8" />
            </svg>
            Dashboard
        </a>
    </nav>

    {{-- Content Management --}}
    <div class="sidebar-section" style="padding-top:.9rem;">Content</div>
    <nav class="sidebar-nav">
        <a href="{{ route('dashboard') }}?panel=about" id="nav-about"
            class="{{ request()->routeIs('dashboard') && request('panel') === 'about' ? 'active' : '' }}"
            onclick="if(window.switchPanel) { switchPanel('about'); return false; }">
            <svg class="nav-icon" width="16" height="16" fill="none" viewBox="0 0 24 24">
                <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.8" />
                <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
            </svg>
            About Us
        </a>
        <a href="{{ route('dashboard') }}?panel=team" id="nav-team"
            class="{{ request()->routeIs('dashboard') && request('panel') === 'team' ? 'active' : '' }}"
            onclick="if(window.switchPanel) { switchPanel('team'); return false; }">
            <svg class="nav-icon" width="16" height="16" fill="none" viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="1.8"
                    stroke-linecap="round" />
                <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="1.8" />
                <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" stroke="currentColor" stroke-width="1.8"
                    stroke-linecap="round" />
            </svg>
            Team
        </a>
        <a href="{{ route('dashboard') }}?panel=blog" id="nav-blog"
            class="{{ request()->routeIs('dashboard') && request('panel') === 'blog' ? 'active' : '' }}"
            onclick="if(window.switchPanel) { switchPanel('blog'); return false; }">
            <svg class="nav-icon" width="16" height="16" fill="none" viewBox="0 0 24 24">
                <path d="M4 4h16v2H4zM4 9h10v2H4zM4 14h12v2H4zM4 19h8v2H4z" fill="currentColor" opacity=".85" />
            </svg>
            Blog
        </a>
        <a href="{{ route('dashboard') }}?panel=courses" id="nav-courses"
            class="{{ request()->routeIs('dashboard') && request('panel') === 'courses' ? 'active' : '' }}"
            onclick="if(window.switchPanel) { switchPanel('courses'); return false; }">
            <svg class="nav-icon" width="16" height="16" fill="none" viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                <path d="M2 17l10 5 10-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M2 12l10 5 10-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            Courses
        </a>
        <a href="{{ route('dashboard') }}?panel=gallery" id="nav-gallery"
            class="{{ request()->routeIs('dashboard') && request('panel') === 'gallery' ? 'active' : '' }}"
            onclick="if(window.switchPanel) { switchPanel('gallery'); return false; }">
            <svg class="nav-icon" width="16" height="16" fill="none" viewBox="0 0 24 24">
                <rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor" stroke-width="1.8" />
                <circle cx="8.5" cy="8.5" r="1.5" stroke="currentColor" stroke-width="1.5" />
                <path d="M21 15l-5-5L5 21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            Gallery
        </a>
        <a href="{{ route('dashboard') }}?panel=enquiries" id="nav-enquiries"
            class="{{ request()->routeIs('dashboard') && request('panel') === 'enquiries' ? 'active' : '' }}"
            onclick="if(window.switchPanel) { switchPanel('enquiries'); return false; }">
            <svg class="nav-icon" width="16" height="16" fill="none" viewBox="0 0 24 24">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke="currentColor"
                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Enquiries
            @if(isset($unreadCount) && $unreadCount > 0)
                <span
                    style="margin-left:auto;background:#dc2626;color:#fff;font-size:.65rem;font-weight:700;padding:.1rem .45rem;border-radius:999px;line-height:1.5;">
                    {{ $unreadCount }}
                </span>
            @endif
        </a>
        <a href="{{ route('dashboard') }}?panel=seo" id="nav-seo"
            class="{{ request()->routeIs('dashboard') && request('panel') === 'seo' ? 'active' : '' }}"
            onclick="if(window.switchPanel) { switchPanel('seo'); return false; }">
            <svg class="nav-icon" width="16" height="16" fill="none" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="1.8" />
                <path d="M21 21l-4.35-4.35" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                <path d="M8 11h6M11 8v6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
            </svg>
            Home SEO
        </a>
        <a href="{{ route('dashboard') }}?panel=testimonials" id="nav-testimonials"
            class="{{ request()->routeIs('dashboard') && request('panel') === 'testimonials' ? 'active' : '' }}"
            onclick="if(window.switchPanel) { switchPanel('testimonials'); return false; }">
            <svg class="nav-icon" width="16" height="16" fill="none" viewBox="0 0 24 24">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke="currentColor"
                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M8 10h8M8 14h5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
            </svg>
            Testimonials
        </a>
        <a href="{{ route('dashboard') }}?panel=fees" id="nav-fees"
            class="{{ request()->routeIs('dashboard') && request('panel') === 'fees' ? 'active' : '' }}"
            onclick="if(window.switchPanel) { switchPanel('fees'); return false; }">
            <svg class="nav-icon" width="16" height="16" fill="none" viewBox="0 0 24 24">
                <rect x="2" y="5" width="20" height="14" rx="2" stroke="currentColor" stroke-width="1.8" />
                <path d="M2 10h20" stroke="currentColor" stroke-width="1.8" />
                <path d="M6 15h4M14 15h4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
            </svg>
            Fees Structure
        </a>
    </nav>

    {{-- Footer / User --}}
    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</div>
            <div>
                <div class="sidebar-user-name">{{ auth()->user()->name ?? 'User' }}</div>
                <div class="sidebar-user-role">Administrator</div>
            </div>
        </div>
    </div>

</aside>