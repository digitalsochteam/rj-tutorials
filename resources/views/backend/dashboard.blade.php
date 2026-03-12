@extends('backend.layouts.app')

@section('page-title', $activePanel === 'about' ? 'About Us' : ($activePanel === 'team' ? 'Team' : ($activePanel === 'blog' ? 'Blog' : ($activePanel === 'courses' ? 'Courses' : ($activePanel === 'gallery' ? 'Gallery' : ($activePanel === 'enquiries' ? 'Enquiries' : ($activePanel === 'seo' ? 'Home SEO' : ($activePanel === 'testimonials' ? 'Testimonials' : ($activePanel === 'fees' ? 'Fees Structure' : 'Dashboard')))))))))

@section('content')

    {{-- ══ PANEL: OVERVIEW ══ --}}
    <div class="panel {{ !in_array($activePanel, ['about', 'team', 'blog', 'courses', 'gallery', 'enquiries', 'seo']) ? 'active' : '' }}"
        id="panel-overview">

        {{-- Hero Greeting --}}
        <div class="hero-card">
            <div class="hero-badge">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                    <path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z" fill="rgba(255,255,255,.9)" />
                </svg>
                RJ Tutorials Admin
            </div>
            <div class="hero-greeting">
                Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 17 ? 'afternoon' : 'evening') }},
                {{ explode(' ', $user->name)[0] }} 👋
            </div>
            <div class="hero-sub">
                Here's what's happening on your platform &mdash; {{ now()->format('l, d F Y') }}
            </div>
        </div>

        {{-- Section Header --}}
        <div class="section-header">
            <div>
                <div class="section-title">Platform Overview</div>
                <div class="section-sub">Live counts from your database</div>
            </div>
        </div>

        {{-- Stats Grid --}}
        <div class="stats-grid">

            {{-- Courses --}}
            <div class="stat-card violet" onclick="switchPanel('courses')" style="cursor:pointer;">
                <div class="stat-top">
                    <div class="stat-icon violet">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5z" stroke="currentColor" stroke-width="2"
                                stroke-linejoin="round" />
                            <path d="M2 17l10 5 10-5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M2 12l10 5 10-5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <span class="stat-trend flat">Courses</span>
                </div>
                <div>
                    <div class="stat-value">{{ $courses->count() }}</div>
                    <div class="stat-label">Total Courses &nbsp;·&nbsp; {{ $courses->where('is_active', true)->count() }}
                        active</div>
                </div>
                <div class="stat-bar-bg">
                    @php $courseBar = $courses->count() ? round(($courses->where('is_active', true)->count() / $courses->count()) * 100) : 0; @endphp
                    <div class="stat-bar" style="width:{{ $courseBar }}%;background:#7c3aed;"></div>
                </div>
            </div>

            {{-- Blog Posts --}}
            <div class="stat-card blue" onclick="switchPanel('blog')" style="cursor:pointer;">
                <div class="stat-top">
                    <div class="stat-icon blue">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24">
                            <path d="M4 4h16v2H4zM4 9h10v2H4zM4 14h12v2H4zM4 19h8v2H4z" fill="currentColor" opacity=".85" />
                        </svg>
                    </div>
                    <span class="stat-trend flat">Blog</span>
                </div>
                <div>
                    <div class="stat-value">{{ $blogPosts->count() }}</div>
                    <div class="stat-label">Total Posts &nbsp;·&nbsp; {{ $blogPosts->where('is_published', true)->count() }}
                        published</div>
                </div>
                <div class="stat-bar-bg">
                    @php $blogBar = $blogPosts->count() ? round(($blogPosts->where('is_published', true)->count() / $blogPosts->count()) * 100) : 0; @endphp
                    <div class="stat-bar" style="width:{{ $blogBar }}%;background:#3b82f6;"></div>
                </div>
            </div>

            {{-- Team Members --}}
            <div class="stat-card green" onclick="switchPanel('team')" style="cursor:pointer;">
                <div class="stat-top">
                    <div class="stat-icon green">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" />
                            <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>
                    <span class="stat-trend flat">Team</span>
                </div>
                <div>
                    <div class="stat-value">{{ $teamMembers->count() }}</div>
                    <div class="stat-label">Team Members &nbsp;·&nbsp; {{ $teamMembers->where('is_active', true)->count() }}
                        active</div>
                </div>
                <div class="stat-bar-bg">
                    @php $teamBar = $teamMembers->count() ? round(($teamMembers->where('is_active', true)->count() / $teamMembers->count()) * 100) : 0; @endphp
                    <div class="stat-bar" style="width:{{ $teamBar }}%;background:#22c55e;"></div>
                </div>
            </div>

            {{-- Enquiries --}}
            <div class="stat-card amber" onclick="switchPanel('enquiries')" style="cursor:pointer;">
                <div class="stat-top">
                    <div class="stat-icon amber">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    @if($unreadCount > 0)
                        <span class="stat-trend down">{{ $unreadCount }} new</span>
                    @else
                        <span class="stat-trend up">All read</span>
                    @endif
                </div>
                <div>
                    <div class="stat-value">{{ $enquiries->count() }}</div>
                    <div class="stat-label">Enquiries &nbsp;·&nbsp; {{ $unreadCount }} unread</div>
                </div>
                <div class="stat-bar-bg">
                    @php $enqBar = $enquiries->count() ? round((($enquiries->count() - $unreadCount) / $enquiries->count()) * 100) : 100; @endphp
                    <div class="stat-bar" style="width:{{ $enqBar }}%;background:#f59e0b;"></div>
                </div>
            </div>

        </div>

        {{-- Quick Actions --}}
        <div class="section-header" style="margin-top:0.5rem;">
            <div>
                <div class="section-title">Quick Actions</div>
                <div class="section-sub">Jump straight to adding or editing content</div>
            </div>
        </div>

        <div class="quick-grid">
            <a href="{{ route('dashboard') }}?panel=courses" class="quick-card"
                onclick="switchPanel('courses');return false;">
                <div class="quick-icon">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5z" stroke="currentColor" stroke-width="2"
                            stroke-linejoin="round" />
                        <path d="M2 17l10 5 10-5M2 12l10 5 10-5" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div>
                    <div class="quick-label">Add Course</div>
                    <div class="quick-sublabel">{{ $courses->count() }} total</div>
                </div>
            </a>
            <a href="{{ route('dashboard') }}?panel=blog" class="quick-card" onclick="switchPanel('blog');return false;">
                <div class="quick-icon">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" />
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>
                <div>
                    <div class="quick-label">Write Post</div>
                    <div class="quick-sublabel">{{ $blogPosts->count() }} total</div>
                </div>
            </a>
            <a href="{{ route('dashboard') }}?panel=team" class="quick-card" onclick="switchPanel('team');return false;">
                <div class="quick-icon">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" />
                        <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" />
                    </svg>
                </div>
                <div>
                    <div class="quick-label">Add Member</div>
                    <div class="quick-sublabel">{{ $teamMembers->count() }} members</div>
                </div>
            </a>
            <a href="{{ route('dashboard') }}?panel=gallery" class="quick-card"
                onclick="switchPanel('gallery');return false;">
                <div class="quick-icon">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2" />
                        <circle cx="8.5" cy="8.5" r="1.5" stroke="currentColor" stroke-width="1.5" />
                        <path d="M21 15l-5-5L5 21" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <div>
                    <div class="quick-label">Gallery</div>
                    <div class="quick-sublabel">{{ $galleryImages->count() }} media items</div>
                </div>
            </a>
            <a href="{{ route('dashboard') }}?panel=enquiries" class="quick-card"
                onclick="switchPanel('enquiries');return false;">
                <div class="quick-icon">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div>
                    <div class="quick-label">View Messages</div>
                    <div class="quick-sublabel">
                        @if($unreadCount > 0)
                            <span style="color:#dc2626;font-weight:700;">{{ $unreadCount }} unread</span>
                        @else
                            All caught up
                        @endif
                    </div>
                </div>
            </a>
            <a href="{{ route('dashboard') }}?panel=seo" class="quick-card" onclick="switchPanel('seo');return false;">
                <div class="quick-icon">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2" />
                        <path d="M21 21l-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>
                <div>
                    <div class="quick-label">SEO Settings</div>
                    <div class="quick-sublabel">Home page meta</div>
                </div>
            </a>
        </div>

    </div>{{-- /panel-overview --}}

    {{-- ══ PANEL: ABOUT US ══ --}}
    <div class="panel {{ $activePanel === 'about' ? 'active' : '' }}" id="panel-about">

        <div class="section-header">
            <div>
                <div class="section-title">About Us Content</div>
                <div class="section-sub">Edit the text, stats and images shown in the About Us section of your homepage.
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                    <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                <strong>Please fix the following errors:</strong>
                <ul style="padding-left:1rem;margin-top:.3rem;">
                    @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('about-us.update') }}" enctype="multipart/form-data">
            @csrf

            {{-- Text Content --}}
            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-card-title">Text Content</div>
                    <div class="form-card-sub">Tagline, heading and paragraphs shown on the homepage.</div>
                </div>
                <div class="form-body">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="tagline">Tagline</label>
                            <input type="text" id="tagline" name="tagline" value="{{ old('tagline', $about->tagline) }}"
                                placeholder="About Us">
                        </div>
                        <div class="form-group full">
                            <label for="title">Section Title</label>
                            <input type="text" id="title" name="title" value="{{ old('title', $about->title) }}"
                                placeholder="Section heading">
                        </div>
                        <div class="form-group full">
                            <label for="paragraph_1">Paragraph 1</label>
                            <textarea id="paragraph_1" name="paragraph_1" rows="4"
                                class="wysiwyg">{!! old('paragraph_1', $about->paragraph_1) !!}</textarea>
                        </div>
                        <div class="form-group full">
                            <label for="paragraph_2">Paragraph 2</label>
                            <textarea id="paragraph_2" name="paragraph_2" rows="4"
                                class="wysiwyg">{!! old('paragraph_2', $about->paragraph_2) !!}</textarea>
                        </div>
                        <div class="form-group full">
                            <label for="paragraph_3">Paragraph 3</label>
                            <textarea id="paragraph_3" name="paragraph_3" rows="5"
                                class="wysiwyg">{!! old('paragraph_3', $about->paragraph_3) !!}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Stats --}}
            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-card-title">Counter Stats</div>
                    <div class="form-card-sub">Numbers displayed on the About Us section.</div>
                </div>
                <div class="form-body">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="years_experience">Years of Experience</label>
                            <input type="number" id="years_experience" name="years_experience" min="0"
                                value="{{ old('years_experience', $about->years_experience) }}">
                        </div>
                        <div class="form-group">
                            <label for="students_count">Satisfied Students (K)</label>
                            <input type="number" id="students_count" name="students_count" min="0"
                                value="{{ old('students_count', $about->students_count) }}">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Images --}}
            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-card-title">Images</div>
                    <div class="form-card-sub">Leave blank to keep the current image.</div>
                </div>
                <div class="form-body">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="main_image">Main Image</label>
                            <input type="file" id="main_image" name="main_image" accept="image/*"
                                onchange="previewImage(this,'prev_main')">
                            <div class="img-preview">
                                <img id="prev_main"
                                    src="{{ $about->main_image ? asset('storage/' . $about->main_image) : asset('assets/images/resources/about-one-img-1.jpg') }}"
                                    alt="Main Image">
                                <span>Current main image</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="secondary_image">Secondary Image</label>
                            <input type="file" id="secondary_image" name="secondary_image" accept="image/*"
                                onchange="previewImage(this,'prev_secondary')">
                            <div class="img-preview">
                                <img id="prev_secondary"
                                    src="{{ $about->secondary_image ? asset('storage/' . $about->secondary_image) : asset('assets/images/resources/about-one-img-2.jpg') }}"
                                    alt="Secondary Image">
                                <span>Current secondary image</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SEO --}}
            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-card-title">SEO / Meta Tags</div>
                    <div class="form-card-sub">Control how the About Us page appears in search engines. Leave blank to use sensible defaults.</div>
                </div>
                <div class="form-body">
                    <div class="form-grid">
                        <div class="form-group full">
                            <label for="about_meta_title">Meta Title <small style="color:#94a3b8;">(50–60 chars ideal)</small></label>
                            <input type="text" id="about_meta_title" name="meta_title" maxlength="80"
                                value="{{ old('meta_title', $about->meta_title) }}"
                                placeholder="e.g. About RJ Tutorials | Expert Coaching Since 2000"
                                oninput="countChars(this,'about_meta_title_count',60)">
                            <span id="about_meta_title_count" style="font-size:.75rem;color:#94a3b8;">{{ strlen(old('meta_title', $about->meta_title ?? '')) }} / 60</span>
                        </div>
                        <div class="form-group full">
                            <label for="about_meta_description">Meta Description <small style="color:#94a3b8;">(150–160 chars ideal)</small></label>
                            <textarea id="about_meta_description" name="meta_description" rows="3" maxlength="320"
                                placeholder="Brief description shown in Google search results..."
                                oninput="countChars(this,'about_meta_desc_count',160)">{{ old('meta_description', $about->meta_description) }}</textarea>
                            <span id="about_meta_desc_count" style="font-size:.75rem;color:#94a3b8;">{{ strlen(old('meta_description', $about->meta_description ?? '')) }} / 160</span>
                        </div>
                        <div class="form-group full">
                            <label for="about_meta_keywords">Meta Keywords <small style="color:#94a3b8;">(comma-separated)</small></label>
                            <input type="text" id="about_meta_keywords" name="meta_keywords"
                                value="{{ old('meta_keywords', $about->meta_keywords) }}"
                                placeholder="about us, RJ tutorials, coaching institute, science coaching">
                        </div>
                    </div>
                </div>
            </div>

            <div style="display:flex;justify-content:flex-end;">
                <button type="submit" class="btn-primary">Save Changes</button>
            </div>

        </form>

    </div>{{-- /panel-about --}}

    {{-- ══ PANEL: TEAM ══ --}}
    <div class="panel {{ $activePanel === 'team' ? 'active' : '' }}" id="panel-team">

        <div class="section-header">
            <div>
                <div class="section-title">Team Members</div>
                <div class="section-sub">Manage the team members shown on your website.</div>
            </div>
            <a href="{{ route('team.create') }}" class="btn-primary" style="text-decoration:none;">+ Add Member</a>
        </div>

        @if(session('team_success'))
            <div class="alert-success">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                    <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                {{ session('team_success') }}
            </div>
        @endif

        <div class="table-card">
            <div class="table-card-header">
                <div>
                    <div class="table-card-title">All Members</div>
                    <div class="table-card-sub">{{ $teamMembers->count() }} member(s) total</div>
                </div>
            </div>
            @if($teamMembers->isEmpty())
                <div style="padding:2.5rem;text-align:center;color:#94a3b8;">
                    <svg width="40" height="40" fill="none" viewBox="0 0 24 24" style="margin-bottom:.75rem;opacity:.4;">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" />
                        <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="1.5" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" />
                    </svg>
                    <p style="font-size:.875rem;">No team members yet. <a href="{{ route('team.create') }}"
                            style="color:var(--brand);">Add the first one →</a></p>
                </div>
            @else
                <div class="table-responsive-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teamMembers as $member)
                                <tr>
                                    <td>
                                        <img src="{{ $member->photo ? asset('storage/' . $member->photo) : asset('assets/images/team/team-1-1.jpg') }}"
                                            alt="{{ $member->name }}"
                                            style="width:40px;height:40px;object-fit:cover;border-radius:50%;border:1px solid var(--border);">
                                    </td>
                                    <td class="td-action">{{ $member->name }}</td>
                                    <td class="td-email">{{ $member->designation }}</td>
                                    <td class="td-date">{{ $member->sort_order }}</td>
                                    <td>
                                        @if($member->is_active)
                                            <span class="badge badge-green">Active</span>
                                        @else
                                            <span class="badge badge-red">Hidden</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="display:flex;gap:.5rem;">
                                            <a href="{{ route('team.edit', $member) }}"
                                                style="padding:.3rem .75rem;background:var(--brand-light);color:var(--brand);border-radius:7px;font-size:.78rem;font-weight:600;">Edit</a>
                                            <form method="POST" action="{{ route('team.destroy', $member) }}"
                                                onsubmit="return confirm('Delete {{ $member->name }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    style="padding:.3rem .75rem;background:#fef2f2;color:#dc2626;border:none;border-radius:7px;font-size:.78rem;font-weight:600;cursor:pointer;">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>{{-- /.table-responsive-wrap --}}
            @endif
        </div>

    </div>{{-- /panel-team --}}

    {{-- ══ PANEL: BLOG ══ --}}
    <div class="panel {{ $activePanel === 'blog' ? 'active' : '' }}" id="panel-blog">

        <div class="section-header">
            <div>
                <div class="section-title">Blog Posts</div>
                <div class="section-sub">Manage articles shown on your website.</div>
            </div>
            <a href="{{ route('blog.create') }}" class="btn-primary" style="text-decoration:none;">+ New Post</a>
        </div>

        @if(session('blog_success'))
            <div class="alert-success">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                    <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                {{ session('blog_success') }}
            </div>
        @endif

        <div class="table-card">
            <div class="table-card-header">
                <div>
                    <div class="table-card-title">All Posts</div>
                    <div class="table-card-sub">{{ $blogPosts->count() }} post(s) total</div>
                </div>
            </div>
            @if($blogPosts->isEmpty())
                <div style="padding:2.5rem;text-align:center;color:#94a3b8;">
                    <p style="font-size:.875rem;">No posts yet. <a href="{{ route('blog.create') }}"
                            style="color:var(--brand);">Write the first one →</a></p>
                </div>
            @else
                <div class="table-responsive-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogPosts as $post)
                                <tr>
                                    <td class="td-action" style="max-width:220px;white-space:normal;line-height:1.4;">
                                        {{ $post->title }}
                                    </td>
                                    <td class="td-email">{{ $post->category }}</td>
                                    <td class="td-email">{{ $post->author }}</td>
                                    <td>
                                        @if($post->is_published)
                                            <span class="badge badge-green">Published</span>
                                        @else
                                            <span class="badge badge-yellow">Draft</span>
                                        @endif
                                    </td>
                                    <td class="td-date">
                                        {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                                    </td>
                                    <td>
                                        <div style="display:flex;gap:.5rem;">
                                            <a href="{{ route('blog.edit', $post) }}"
                                                style="padding:.3rem .75rem;background:var(--brand-light);color:var(--brand);border-radius:7px;font-size:.78rem;font-weight:600;">Edit</a>
                                            <form method="POST" action="{{ route('blog.destroy', $post) }}"
                                                onsubmit="return confirm('Delete this post?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    style="padding:.3rem .75rem;background:#fef2f2;color:#dc2626;border:none;border-radius:7px;font-size:.78rem;font-weight:600;cursor:pointer;">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        @if(session('blog_seo_success'))
            <div class="alert-success" style="margin-top:1.25rem;">{{ session('blog_seo_success') }}</div>
        @endif

        <form method="POST" action="{{ route('page-seo.update', 'blog') }}" style="margin-top:1.5rem;">
            @csrf
            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-card-title">SEO / Meta Tags</div>
                    <div class="form-card-sub">Control how the Blog listing page appears in search engines.</div>
                </div>
                <div class="form-body">
                    <div class="form-grid">
                        <div class="form-group full">
                            <label>Meta Title <small style="color:#94a3b8;">(50–60 chars ideal)</small></label>
                            <input type="text" name="meta_title" maxlength="80"
                                value="{{ old('meta_title', $pageSeo['blog']->meta_title) }}"
                                placeholder="e.g. Blog | RJ Tutorials"
                                oninput="countChars(this,'blog_seo_title_count',60)">
                            <span id="blog_seo_title_count" style="font-size:.75rem;color:#94a3b8;">{{ strlen($pageSeo['blog']->meta_title ?? '') }} / 60</span>
                        </div>
                        <div class="form-group full">
                            <label>Meta Description <small style="color:#94a3b8;">(150–160 chars ideal)</small></label>
                            <textarea name="meta_description" rows="3" maxlength="320"
                                placeholder="Brief description shown in Google search results..."
                                oninput="countChars(this,'blog_seo_desc_count',160)">{{ old('meta_description', $pageSeo['blog']->meta_description) }}</textarea>
                            <span id="blog_seo_desc_count" style="font-size:.75rem;color:#94a3b8;">{{ strlen($pageSeo['blog']->meta_description ?? '') }} / 160</span>
                        </div>
                        <div class="form-group full">
                            <label>Meta Keywords <small style="color:#94a3b8;">(comma-separated)</small></label>
                            <input type="text" name="meta_keywords"
                                value="{{ old('meta_keywords', $pageSeo['blog']->meta_keywords) }}"
                                placeholder="blog, articles, RJ tutorials, education tips">
                        </div>
                    </div>
                </div>
            </div>
            <div style="display:flex;justify-content:flex-end;margin-bottom:1.5rem;">
                <button type="submit" class="btn-primary">Save SEO</button>
            </div>
        </form>

    </div>{{-- /panel-blog --}}

    {{-- ══ PANEL: COURSES ══ --}}
    <div class="panel {{ $activePanel === 'courses' ? 'active' : '' }}" id="panel-courses">

        <div class="section-header">
            <div>
                <div class="section-title">Courses</div>
                <div class="section-sub">Manage the courses shown on the website.</div>
            </div>
            <a href="{{ route('courses.create') }}" class="btn-primary" style="text-decoration:none;">+ New Course</a>
        </div>

        @if(session('courses_success'))
            <div class="alert-success" style="margin-bottom:1rem;">{{ session('courses_success') }}</div>
        @endif

        @if($courses->isEmpty())
            <div style="text-align:center;padding:3rem 1rem;background:#fff;border-radius:14px;border:1px dashed #e2e8f0;">
                <p style="color:#94a3b8;font-size:.9rem;">No courses yet. Create your first course above.</p>
            </div>
        @else
            <div class="table-responsive-wrap">
                <table
                    style="width:100%;border-collapse:collapse;background:#fff;border-radius:14px;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.06);">
                    <thead>
                        <tr style="background:#f8fafc;border-bottom:2px solid #e2e8f0;">
                            <th
                                style="padding:.8rem 1rem;text-align:left;font-size:.78rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#64748b;">
                                Image</th>
                            <th
                                style="padding:.8rem 1rem;text-align:left;font-size:.78rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#64748b;">
                                Title</th>
                            <th
                                style="padding:.8rem 1rem;text-align:left;font-size:.78rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#64748b;">
                                Category</th>
                            <th
                                style="padding:.8rem 1rem;text-align:left;font-size:.78rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#64748b;">
                                Order</th>
                            <th
                                style="padding:.8rem 1rem;text-align:left;font-size:.78rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#64748b;">
                                Status</th>
                            <th
                                style="padding:.8rem 1rem;text-align:left;font-size:.78rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#64748b;">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                            <tr style="border-bottom:1px solid #f1f5f9;">
                                <td style="padding:.75rem 1rem;">
                                    <img src="{{ $course->image ? asset('storage/' . $course->image) : asset('assets/images/services/services-2-1.jpg') }}"
                                        alt="{{ $course->title }}"
                                        style="width:56px;height:42px;object-fit:cover;border-radius:7px;">
                                </td>
                                <td style="padding:.75rem 1rem;">
                                    <div style="font-weight:600;color:#1e293b;font-size:.875rem;">{{ $course->title }}</div>
                                    @if($course->tagline)
                                        <div style="font-size:.78rem;color:#94a3b8;margin-top:.1rem;">
                                            {{ Str::limit($course->tagline, 50) }}
                                        </div>
                                    @endif
                                </td>
                                <td style="padding:.75rem 1rem;font-size:.875rem;color:#475569;">{{ $course->category }}</td>
                                <td style="padding:.75rem 1rem;font-size:.875rem;color:#475569;">{{ $course->sort_order }}</td>
                                <td style="padding:.75rem 1rem;">
                                    @if($course->is_active)
                                        <span
                                            style="background:#dcfce7;color:#16a34a;font-size:.72rem;font-weight:700;padding:3px 10px;border-radius:12px;text-transform:uppercase;">Active</span>
                                    @else
                                        <span
                                            style="background:#fef9c3;color:#ca8a04;font-size:.72rem;font-weight:700;padding:3px 10px;border-radius:12px;text-transform:uppercase;">Inactive</span>
                                    @endif
                                </td>
                                <td style="padding:.75rem 1rem;">
                                    <div style="display:flex;gap:.5rem;flex-wrap:wrap;">
                                        <a href="{{ route('courses.edit', $course) }}"
                                            style="padding:.3rem .75rem;background:#eff6ff;color:#2563eb;border-radius:7px;font-size:.78rem;font-weight:600;text-decoration:none;">Edit</a>
                                        <form method="POST" action="{{ route('courses.destroy', $course) }}"
                                            onsubmit="return confirm('Delete this course?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                style="padding:.3rem .75rem;background:#fef2f2;color:#dc2626;border:none;border-radius:7px;font-size:.78rem;font-weight:600;cursor:pointer;">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if(session('courses_seo_success'))
            <div class="alert-success" style="margin-top:1.25rem;">{{ session('courses_seo_success') }}</div>
        @endif

        <form method="POST" action="{{ route('page-seo.update', 'courses') }}" style="margin-top:1.5rem;">
            @csrf
            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-card-title">SEO / Meta Tags</div>
                    <div class="form-card-sub">Control how the Courses listing page appears in search engines.</div>
                </div>
                <div class="form-body">
                    <div class="form-grid">
                        <div class="form-group full">
                            <label>Meta Title <small style="color:#94a3b8;">(50–60 chars ideal)</small></label>
                            <input type="text" name="meta_title" maxlength="80"
                                value="{{ old('meta_title', $pageSeo['courses']->meta_title) }}"
                                placeholder="e.g. Our Courses | RJ Tutorials"
                                oninput="countChars(this,'courses_seo_title_count',60)">
                            <span id="courses_seo_title_count" style="font-size:.75rem;color:#94a3b8;">{{ strlen($pageSeo['courses']->meta_title ?? '') }} / 60</span>
                        </div>
                        <div class="form-group full">
                            <label>Meta Description <small style="color:#94a3b8;">(150–160 chars ideal)</small></label>
                            <textarea name="meta_description" rows="3" maxlength="320"
                                placeholder="Brief description shown in Google search results..."
                                oninput="countChars(this,'courses_seo_desc_count',160)">{{ old('meta_description', $pageSeo['courses']->meta_description) }}</textarea>
                            <span id="courses_seo_desc_count" style="font-size:.75rem;color:#94a3b8;">{{ strlen($pageSeo['courses']->meta_description ?? '') }} / 160</span>
                        </div>
                        <div class="form-group full">
                            <label>Meta Keywords <small style="color:#94a3b8;">(comma-separated)</small></label>
                            <input type="text" name="meta_keywords"
                                value="{{ old('meta_keywords', $pageSeo['courses']->meta_keywords) }}"
                                placeholder="courses, RJ tutorials, science coaching, JEE NEET">
                        </div>
                    </div>
                </div>
            </div>
            <div style="display:flex;justify-content:flex-end;margin-bottom:1.5rem;">
                <button type="submit" class="btn-primary">Save SEO</button>
            </div>
        </form>

    </div>{{-- /panel-courses --}}

    {{-- ══ PANEL: GALLERY ══ --}}
    <div class="panel {{ $activePanel === 'gallery' ? 'active' : '' }}" id="panel-gallery">
        <div class="section-header">
            <div>
                <div class="section-title">Gallery</div>
                <div class="section-sub">Manage photos &amp; videos.</div>
            </div>
            <div style="display:flex;gap:.5rem;flex-wrap:wrap;">
                <a href="{{ route('gallery.create', ['type' => 'image']) }}" class="btn-primary"
                    style="text-decoration:none;">+ Upload Image</a>
                <a href="{{ route('gallery.create', ['type' => 'video']) }}" class="btn-secondary"
                    style="text-decoration:none;">+ Add Video</a>
            </div>
        </div>

        @if(session('gallery_success'))
            <div class="alert-success" style="margin-bottom:1.25rem;">{{ session('gallery_success') }}</div>
        @endif

        @if($galleryImages->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <svg width="32" height="32" fill="none" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor" stroke-width="1.6" />
                        <circle cx="8.5" cy="8.5" r="1.5" stroke="currentColor" stroke-width="1.5" />
                        <path d="M21 15l-5-5L5 21" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <p>No images yet.</p>
                <div style="display:flex;gap:.5rem;justify-content:center;">
                    <a href="{{ route('gallery.create', ['type' => 'image']) }}" class="btn-primary"
                        style="text-decoration:none;">Upload First Image</a>
                    <a href="{{ route('gallery.create', ['type' => 'video']) }}" class="btn-secondary"
                        style="text-decoration:none;">Add Video</a>
                </div>
            </div>
        @else
            <div style="overflow-x:auto;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width:80px;">Preview</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Type</th>
                            <th>Sort</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($galleryImages as $img)
                            <tr>
                                <td>
                                    @if($img->isVideo())
                                        <div
                                            style="width:60px;height:45px;border-radius:6px;background:#0f172a;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;">
                                            @if($img->thumbnail)
                                                <img src="{{ $img->thumbnail }}" alt="{{ $img->title }}"
                                                    style="width:100%;height:100%;object-fit:cover;opacity:.6;">
                                            @endif
                                            <span style="position:absolute;color:#fff;font-size:1.1rem;">▶</span>
                                        </div>
                                    @else
                                        <img src="{{ asset('storage/' . $img->image) }}" alt="{{ $img->title }}"
                                            style="width:60px;height:45px;object-fit:cover;border-radius:6px;">
                                    @endif
                                </td>
                                <td>
                                    <div style="font-weight:600;font-size:.875rem;color:#1e293b;">{{ $img->title }}</div>
                                    @if($img->caption)
                                        <div style="font-size:.75rem;color:#94a3b8;margin-top:.15rem;">
                                            {{ Str::limit($img->caption, 60) }}
                                        </div>
                                    @endif
                                </td>
                                <td><span class="badge">{{ $img->category }}</span></td>
                                <td>
                                    <span class="badge"
                                        style="background:{{ $img->isVideo() ? '#dbeafe' : '#dcfce7' }};color:{{ $img->isVideo() ? '#1d4ed8' : '#15803d' }};">
                                        {{ $img->isVideo() ? 'Video' : 'Image' }}
                                    </span>
                                </td>
                                <td style="color:#64748b;font-size:.875rem;">{{ $img->sort_order }}</td>
                                <td>
                                    <span class="status-badge {{ $img->is_active ? 'published' : 'draft' }}">
                                        {{ $img->is_active ? 'Active' : 'Hidden' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <a href="{{ route('gallery.edit', $img) }}" class="action-btn edit">Edit</a>
                                        <form method="POST" action="{{ route('gallery.destroy', $img) }}"
                                            onsubmit="return confirm('Delete this image?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="action-btn delete">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        @if(session('gallery_seo_success'))
            <div class="alert-success" style="margin-top:1.25rem;">{{ session('gallery_seo_success') }}</div>
        @endif

        <form method="POST" action="{{ route('page-seo.update', 'gallery') }}" style="margin-top:1.5rem;">
            @csrf
            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-card-title">SEO / Meta Tags</div>
                    <div class="form-card-sub">Control how the Gallery page appears in search engines.</div>
                </div>
                <div class="form-body">
                    <div class="form-grid">
                        <div class="form-group full">
                            <label>Meta Title <small style="color:#94a3b8;">(50–60 chars ideal)</small></label>
                            <input type="text" name="meta_title" maxlength="80"
                                value="{{ old('meta_title', $pageSeo['gallery']->meta_title) }}"
                                placeholder="e.g. Gallery | RJ Tutorials"
                                oninput="countChars(this,'gallery_seo_title_count',60)">
                            <span id="gallery_seo_title_count" style="font-size:.75rem;color:#94a3b8;">{{ strlen($pageSeo['gallery']->meta_title ?? '') }} / 60</span>
                        </div>
                        <div class="form-group full">
                            <label>Meta Description <small style="color:#94a3b8;">(150–160 chars ideal)</small></label>
                            <textarea name="meta_description" rows="3" maxlength="320"
                                placeholder="Brief description shown in Google search results..."
                                oninput="countChars(this,'gallery_seo_desc_count',160)">{{ old('meta_description', $pageSeo['gallery']->meta_description) }}</textarea>
                            <span id="gallery_seo_desc_count" style="font-size:.75rem;color:#94a3b8;">{{ strlen($pageSeo['gallery']->meta_description ?? '') }} / 160</span>
                        </div>
                        <div class="form-group full">
                            <label>Meta Keywords <small style="color:#94a3b8;">(comma-separated)</small></label>
                            <input type="text" name="meta_keywords"
                                value="{{ old('meta_keywords', $pageSeo['gallery']->meta_keywords) }}"
                                placeholder="gallery, RJ tutorials, photos, events">
                        </div>
                    </div>
                </div>
            </div>
            <div style="display:flex;justify-content:flex-end;margin-bottom:1.5rem;">
                <button type="submit" class="btn-primary">Save SEO</button>
            </div>
        </form>

    </div>{{-- /panel-gallery --}}

    {{-- ══ PANEL: ENQUIRIES ══ --}}
    <div class="panel {{ $activePanel === 'enquiries' ? 'active' : '' }}" id="panel-enquiries">
        <div class="section-header">
            <div>
                <div class="section-title">Enquiries</div>
                <div class="section-sub">Messages from your Contact Us page.
                    @if($unreadCount > 0)
                        <span
                            style="background:#dc2626;color:#fff;font-size:.7rem;font-weight:700;padding:.15rem .55rem;border-radius:999px;margin-left:.4rem;">{{ $unreadCount }}
                            new</span>
                    @endif
                </div>
            </div>
        </div>

        @if(session('enquiry_success'))
            <div class="alert-success" style="margin-bottom:1.25rem;">{{ session('enquiry_success') }}</div>
        @endif

        @if($enquiries->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <svg width="32" height="32" fill="none" viewBox="0 0 24 24">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <p>No enquiries yet. They will appear here when someone fills the contact form.</p>
            </div>
        @else
            <div style="overflow-x:auto;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width:36px;"></th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enquiries as $enq)
                            <tr style="{{ $enq->is_read ? '' : 'background:#fefce8;' }}">
                                <td>
                                    @if(!$enq->is_read)
                                        <span style="display:inline-block;width:9px;height:9px;border-radius:50%;background:#dc2626;"
                                            title="Unread"></span>
                                    @endif
                                </td>
                                <td>
                                    <div style="font-weight:{{ $enq->is_read ? '500' : '700' }};font-size:.875rem;color:#1e293b;">
                                        {{ $enq->name }}
                                    </div>
                                </td>
                                <td>
                                    <div style="font-size:.8rem;color:#475569;">{{ $enq->email }}</div>
                                    @if($enq->phone)
                                        <div style="font-size:.78rem;color:#94a3b8;">{{ $enq->phone }}</div>
                                    @endif
                                </td>
                                <td style="font-size:.875rem;color:#475569;">{{ $enq->subject ?? '—' }}</td>
                                <td style="font-size:.8rem;color:#64748b;max-width:220px;">
                                    <span title="{{ $enq->message }}">{{ Str::limit($enq->message, 80) }}</span>
                                </td>
                                <td style="font-size:.78rem;color:#94a3b8;white-space:nowrap;">
                                    {{ $enq->created_at->format('d M Y, h:i A') }}
                                </td>
                                <td>
                                    <div class="action-btns">
                                        @if(!$enq->is_read)
                                            <form method="POST" action="{{ route('enquiry.read', $enq) }}">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="action-btn edit" title="Mark as Read">Read</button>
                                            </form>
                                        @endif
                                        <form method="POST" action="{{ route('enquiry.destroy', $enq) }}"
                                            onsubmit="return confirm('Delete this enquiry?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="action-btn delete">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>{{-- /panel-enquiries --}}

    {{-- ══ PANEL: HOME SEO ══ --}}
    <div class="panel {{ $activePanel === 'seo' ? 'active' : '' }}" id="panel-seo">

        <div class="section-header">
            <div>
                <div class="section-title">Home Page SEO</div>
                <div class="section-sub">Controls the meta title, description, keywords and social share image for the
                    homepage.</div>
            </div>
        </div>

        @if(session('seo_success'))
            <div class="alert-success">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                    <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                {{ session('seo_success') }}
            </div>
        @endif

        @if($errors->has('seo_title') || $errors->has('seo_description') || $errors->has('seo_keywords') || $errors->has('og_image'))
            <div class="alert-error">
                <strong>Please fix the following errors:</strong>
                <ul style="padding-left:1rem;margin-top:.3rem;">
                    @foreach($errors->only(['seo_title', 'seo_description', 'seo_keywords', 'og_image']) as $msgs)
                        @foreach($msgs as $e)<li>{{ $e }}</li>@endforeach
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('home-seo.update') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-card-title">Meta Tags</div>
                    <div class="form-card-sub">Shown in Google search results. Keep title &le;60 chars, description &le;160
                        chars.</div>
                </div>
                <div class="form-body">
                    <div class="form-grid">
                        <div class="form-group full">
                            <label for="seo_title">Meta Title</label>
                            <input type="text" id="seo_title" name="seo_title"
                                value="{{ old('seo_title', $homeSeo->seo_title) }}"
                                placeholder="RJ TUTORIALS – Expert Coaching for JEE, NEET & MHCET"
                                oninput="countChars(this,'seo_title_count',60)">
                            <span id="seo_title_count" style="font-size:.75rem;color:#94a3b8;">
                                {{ strlen(old('seo_title', $homeSeo->seo_title ?? '')) }} / 60
                            </span>
                        </div>
                        <div class="form-group full">
                            <label for="seo_description">Meta Description</label>
                            <textarea id="seo_description" name="seo_description" rows="3"
                                placeholder="Brief description of your page for search engines (max 160 chars)"
                                oninput="countChars(this,'seo_desc_count',160)">{{ old('seo_description', $homeSeo->seo_description) }}</textarea>
                            <span id="seo_desc_count" style="font-size:.75rem;color:#94a3b8;">
                                {{ strlen(old('seo_description', $homeSeo->seo_description ?? '')) }} / 160
                            </span>
                        </div>
                        <div class="form-group full">
                            <label for="seo_keywords">Keywords <small
                                    style="color:#94a3b8;">(comma-separated)</small></label>
                            <input type="text" id="seo_keywords" name="seo_keywords"
                                value="{{ old('seo_keywords', $homeSeo->seo_keywords) }}"
                                placeholder="RJ Tutorials, JEE coaching, NEET coaching, Mumbai">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-card-title">Social Share Image (OG Image)</div>
                    <div class="form-card-sub">Shows when your homepage is shared on Facebook, WhatsApp, LinkedIn.
                        Recommended: 1200×630 px.</div>
                </div>
                <div class="form-body">
                    <div class="form-group">
                        <label for="og_image">Upload OG Image</label>
                        <input type="file" id="og_image" name="og_image" accept="image/*"
                            onchange="previewImage(this,'prev_og')">
                        <div class="img-preview">
                            <img id="prev_og"
                                src="{{ $homeSeo->og_image ? asset('storage/' . $homeSeo->og_image) : asset('assets/images/backgrounds/page-header-bg.jpg') }}"
                                alt="OG Image">
                            <span>{{ $homeSeo->og_image ? 'Current OG image' : 'No OG image set (using default)' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div style="display:flex;justify-content:flex-end;">
                <button type="submit" class="btn-primary">Save SEO Settings</button>
            </div>
        </form>

        @if(session('contact_seo_success'))
            <div class="alert-success" style="margin-top:1.25rem;">{{ session('contact_seo_success') }}</div>
        @endif

        <form method="POST" action="{{ route('page-seo.update', 'contact') }}" style="margin-top:1.5rem;">
            @csrf
            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-card-title">Contact Us Page — SEO / Meta Tags</div>
                    <div class="form-card-sub">Control how the Contact Us page appears in search engines.</div>
                </div>
                <div class="form-body">
                    <div class="form-grid">
                        <div class="form-group full">
                            <label>Meta Title <small style="color:#94a3b8;">(50–60 chars ideal)</small></label>
                            <input type="text" name="meta_title" maxlength="80"
                                value="{{ old('meta_title', $pageSeo['contact']->meta_title) }}"
                                placeholder="e.g. Contact Us | RJ Tutorials"
                                oninput="countChars(this,'contact_seo_title_count',60)">
                            <span id="contact_seo_title_count" style="font-size:.75rem;color:#94a3b8;">{{ strlen($pageSeo['contact']->meta_title ?? '') }} / 60</span>
                        </div>
                        <div class="form-group full">
                            <label>Meta Description <small style="color:#94a3b8;">(150–160 chars ideal)</small></label>
                            <textarea name="meta_description" rows="3" maxlength="320"
                                placeholder="Brief description shown in Google search results..."
                                oninput="countChars(this,'contact_seo_desc_count',160)">{{ old('meta_description', $pageSeo['contact']->meta_description) }}</textarea>
                            <span id="contact_seo_desc_count" style="font-size:.75rem;color:#94a3b8;">{{ strlen($pageSeo['contact']->meta_description ?? '') }} / 160</span>
                        </div>
                        <div class="form-group full">
                            <label>Meta Keywords <small style="color:#94a3b8;">(comma-separated)</small></label>
                            <input type="text" name="meta_keywords"
                                value="{{ old('meta_keywords', $pageSeo['contact']->meta_keywords) }}"
                                placeholder="contact us, RJ tutorials, Chembur coaching, enquiry">
                        </div>
                    </div>
                </div>
            </div>
            <div style="display:flex;justify-content:flex-end;margin-bottom:1.5rem;">
                <button type="submit" class="btn-primary">Save SEO</button>
            </div>
        </form>

    </div>{{-- /panel-seo --}}

    {{-- ══ PANEL: TESTIMONIALS ══ --}}
    <div class="panel {{ $activePanel === 'testimonials' ? 'active' : '' }}" id="panel-testimonials">

        <div class="section-header">
            <div>
                <div class="section-title">Testimonials</div>
                <div class="section-sub">Manage student & client reviews shown on the homepage.</div>
            </div>
            <a href="{{ route('testimonials.create') }}" class="btn-primary" style="text-decoration:none;">+ Add
                Testimonial</a>
        </div>

        @if(session('testimonial_success'))
            <div class="alert-success">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                    <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                {{ session('testimonial_success') }}
            </div>
        @endif

        <div class="table-card">
            <div class="table-card-header">
                <div>
                    <div class="table-card-title">All Testimonials</div>
                    <div class="table-card-sub">{{ $testimonials->count() }} testimonial(s) total</div>
                </div>
            </div>
            @if($testimonials->isEmpty())
                <div style="padding:2.5rem;text-align:center;color:#94a3b8;">
                    <svg width="40" height="40" fill="none" viewBox="0 0 24 24" style="margin-bottom:.75rem;opacity:.4;">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <p style="font-size:.875rem;">No testimonials yet. <a href="{{ route('testimonials.create') }}"
                            style="color:var(--brand);">Add the first one →</a></p>
                </div>
            @else
                <div class="table-responsive-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Rating</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($testimonials as $t)
                                <tr>
                                    <td>
                                        <img src="{{ $t->photo ? asset('storage/' . $t->photo) : asset('assets/images/testimonial/testimonial-1-1.jpg') }}"
                                            alt="{{ $t->name }}"
                                            style="width:40px;height:40px;object-fit:cover;border-radius:50%;border:1px solid var(--border);">
                                    </td>
                                    <td class="td-action">{{ $t->name }}</td>
                                    <td class="td-email">{{ $t->designation }}</td>
                                    <td>
                                        @for($i = 1; $i <= 5; $i++)
                                            <span
                                                style="color:{{ $i <= $t->rating ? '#f59e0b' : '#d1d5db' }};font-size:.85rem;">★</span>
                                        @endfor
                                    </td>
                                    <td class="td-date">{{ $t->sort_order }}</td>
                                    <td>
                                        @if($t->is_active)
                                            <span class="badge badge-green">Active</span>
                                        @else
                                            <span class="badge badge-red">Hidden</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="display:flex;gap:.5rem;">
                                            <a href="{{ route('testimonials.edit', $t) }}"
                                                style="padding:.3rem .75rem;background:var(--brand-light);color:var(--brand);border-radius:7px;font-size:.78rem;font-weight:600;">Edit</a>
                                            <form method="POST" action="{{ route('testimonials.destroy', $t) }}"
                                                onsubmit="return confirm('Delete testimonial from {{ $t->name }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    style="padding:.3rem .75rem;background:#fef2f2;color:#dc2626;border:none;border-radius:7px;font-size:.78rem;font-weight:600;cursor:pointer;">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>{{-- /panel-testimonials --}}

    {{-- ══ PANEL: FEES ══ --}}
    <div class="panel {{ $activePanel === 'fees' ? 'active' : '' }}" id="panel-fees">

        <div class="section-header">
            <div>
                <div class="section-title">Fees Structure</div>
                <div class="section-sub">Entries with the same Course Name are grouped under one table on the website.</div>
            </div>
            <a href="{{ route('fees.create') }}" class="btn-primary" style="text-decoration:none;">+ Add Fee Entry</a>
        </div>

        @if(session('fees_success'))
            <div class="alert-success">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                    <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                {{ session('fees_success') }}
            </div>
        @endif

        <div class="table-card">
            <div class="table-card-header">
                <div>
                    <div class="table-card-title">All Fee Entries</div>
                    <div class="table-card-sub">{{ $feeStructures->count() }} entr(ies) total</div>
                </div>
            </div>
            @if($feeStructures->isEmpty())
                <div style="padding:2.5rem;text-align:center;color:#94a3b8;">
                    <p style="font-size:.875rem;">No fee entries yet. <a href="{{ route('fees.create') }}"
                            style="color:var(--brand);">Add the first one →</a></p>
                </div>
            @else
                <div class="table-responsive-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Individual / Combo</th>
                                <th>Fees (₹)</th>
                                <th>Discount (₹)</th>
                                <th>After Discount (₹)</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($feeStructures as $f)
                                <tr>
                                    <td><span
                                            style="background:var(--brand-light);color:var(--brand);padding:.2rem .6rem;border-radius:6px;font-size:.78rem;font-weight:600;">{{ $f->course_name }}</span>
                                    </td>
                                    <td class="td-action">{{ $f->type }}</td>
                                    <td>{{ $f->fees ? '₹' . number_format($f->fees, 0) : '—' }}</td>
                                    <td style="color:#dc2626;">{{ $f->discount ? '₹' . number_format($f->discount, 0) : '—' }}</td>
                                    <td style="color:#16a34a;font-weight:600;">
                                        {{ $f->after_discount ? '₹' . number_format($f->after_discount, 0) : '—' }}
                                    </td>
                                    <td class="td-date">{{ $f->sort_order }}</td>
                                    <td>
                                        @if($f->is_active)
                                            <span class="badge badge-green">Active</span>
                                        @else
                                            <span class="badge badge-red">Hidden</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="display:flex;gap:.5rem;">
                                            <a href="{{ route('fees.edit', $f) }}"
                                                style="padding:.3rem .75rem;background:var(--brand-light);color:var(--brand);border-radius:7px;font-size:.78rem;font-weight:600;">Edit</a>
                                            <form method="POST" action="{{ route('fees.destroy', $f) }}"
                                                onsubmit="return confirm('Delete this fee entry?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    style="padding:.3rem .75rem;background:#fef2f2;color:#dc2626;border:none;border-radius:7px;font-size:.78rem;font-weight:600;cursor:pointer;">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- Optional intro/notes content for the fees page --}}
        @if(session('fees_content_success'))
            <div class="alert-success" style="margin-top:1.5rem;">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                    <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                {{ session('fees_content_success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('fees-content.update') }}" style="margin-top:1.5rem;">
            @csrf
            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-card-title">Additional Notes / Intro</div>
                    <div class="form-card-sub">Optional text shown above the fee tables on the website (e.g. disclaimers,
                        payment info).</div>
                </div>
                <div class="form-body">
                    <div class="form-group full">
                        <textarea id="fees_intro_content" name="intro_content" rows="8"
                            class="wysiwyg">{!! old('intro_content', $feesContent->intro_content) !!}</textarea>
                    </div>
                </div>
            </div>
            <div style="display:flex;justify-content:flex-end;margin-bottom:1.5rem;">
                <button type="submit" class="btn-primary">Save Notes</button>
            </div>
        </form>

        @if(session('fees_seo_success'))
            <div class="alert-success" style="margin-top:1.25rem;">{{ session('fees_seo_success') }}</div>
        @endif

        <form method="POST" action="{{ route('page-seo.update', 'fees') }}" style="margin-top:1.5rem;">
            @csrf
            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-card-title">SEO / Meta Tags</div>
                    <div class="form-card-sub">Control how the Fees page appears in search engines.</div>
                </div>
                <div class="form-body">
                    <div class="form-grid">
                        <div class="form-group full">
                            <label>Meta Title <small style="color:#94a3b8;">(50–60 chars ideal)</small></label>
                            <input type="text" name="meta_title" maxlength="80"
                                value="{{ old('meta_title', $pageSeo['fees']->meta_title) }}"
                                placeholder="e.g. Fees Structure | RJ Tutorials"
                                oninput="countChars(this,'fees_seo_title_count',60)">
                            <span id="fees_seo_title_count" style="font-size:.75rem;color:#94a3b8;">{{ strlen($pageSeo['fees']->meta_title ?? '') }} / 60</span>
                        </div>
                        <div class="form-group full">
                            <label>Meta Description <small style="color:#94a3b8;">(150–160 chars ideal)</small></label>
                            <textarea name="meta_description" rows="3" maxlength="320"
                                placeholder="Brief description shown in Google search results..."
                                oninput="countChars(this,'fees_seo_desc_count',160)">{{ old('meta_description', $pageSeo['fees']->meta_description) }}</textarea>
                            <span id="fees_seo_desc_count" style="font-size:.75rem;color:#94a3b8;">{{ strlen($pageSeo['fees']->meta_description ?? '') }} / 160</span>
                        </div>
                        <div class="form-group full">
                            <label>Meta Keywords <small style="color:#94a3b8;">(comma-separated)</small></label>
                            <input type="text" name="meta_keywords"
                                value="{{ old('meta_keywords', $pageSeo['fees']->meta_keywords) }}"
                                placeholder="fees, tuition fees, RJ tutorials, course pricing">
                        </div>
                    </div>
                </div>
            </div>
            <div style="display:flex;justify-content:flex-end;margin-bottom:1.5rem;">
                <button type="submit" class="btn-primary">Save SEO</button>
            </div>
        </form>

    </div>{{-- /panel-fees --}}

@endsection

@push('scripts')
    <script>
        // ── Panel switching ──────────────────────────────────────────────     const panels = {
        overview: {
            panelId: 'panel-overview',
                navId: 'nav-overview',
                    title: 'Dashboard',
                                },
        about: {
            panelId: 'panel-about',
                navId: 'nav-about',
                    title: 'About Us',
                                },
        team: {
            panelId: 'panel-team',
                navId: 'nav-team',
                    title: 'Team',
                                },
        blog: {
            panelId: 'panel-blog',
                navId: 'nav-blog',
                    title: 'Blog',
                                },
        courses: {
            panelId: 'panel-courses',
                navId: 'nav-courses',
                    title: 'Courses',
                                },
        gallery: {
            panelId: 'panel-gallery',
                navId: 'nav-gallery',
                    title: 'Gallery',
                                },
        enquiries: {
            panelId: 'panel-enquiries',
                navId: 'nav-enquiries',
                    title: 'Enquiries',
                                },
        seo: {
            panelId: 'panel-seo',
                navId: 'nav-seo',
                    title: 'Home SEO',
                                },
        testimonials: {
            panelId: 'panel-testimonials',
                navId: 'nav-testimonials',
                    title: 'Testimonials',
                                },
        fees: {
            panelId: 'panel-fees',
                navId: 'nav-fees',
                    title: 'Fees Structure',
                                },
                            };

        function switchPanel(name) {
            if (!panels[name]) return;

            // Toggle panels
            Object.keys(panels).forEach(key => {
                document.getElementById(panels[key].panelId).classList.toggle('active', key === name);
            });

            // Toggle sidebar active state
            Object.keys(panels).forEach(key => {
                const navEl = document.getElementById(panels[key].navId);
                if (navEl) navEl.classList.toggle('active', key === name);
            });

            // Update topbar title
            document.getElementById('topbar-title').textContent = panels[name].title;

            // Close mobile sidebar
            closeSidebar();

            // Update URL (no reload)
            const url = new URL(window.location);
            if (name === 'overview') url.searchParams.delete('panel');
            else url.searchParams.set('panel', name);
            history.replaceState(null, '', url);
        }

        // Expose globally so sidebar partial can call it
        window.switchPanel = switchPanel;

        // Image preview helper
        function previewImage(input, previewId) {
            const reader = new FileReader();
            reader.onload = e => { document.getElementById(previewId).src = e.target.result; };
            if (input.files[0]) reader.readAsDataURL(input.files[0]);
        }

        // Character counter helper (used by SEO panel)
        function countChars(el, countId, max) {
            const span = document.getElementById(countId);
            if (!span) return;
            const len = el.value.length;
            span.textContent = len + ' / ' + max;
            span.style.color = len > max ? '#dc2626' : '#94a3b8';
        }

        // On page load: activate correct panel based on server-resolved activePanel
        document.addEventListener('DOMContentLoaded', () => {
            const active = '{{ $activePanel }}';
            if (active && panels[active]) {
                // Sync nav highlights (panels already visible via Blade class, just fix nav)
                Object.keys(panels).forEach(key => {
                    const navEl = document.getElementById(panels[key].navId);
                    if (navEl) navEl.classList.toggle('active', key === active);
                });
                document.getElementById('topbar-title').textContent = panels[active].title;
            }
        });
    </script>
@endpush