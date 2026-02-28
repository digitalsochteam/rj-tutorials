@extends('backend.layouts.app')
@section('page-title', 'Edit Course')

@section('content')
    <div style="margin-bottom:1.75rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
        <div>
            <h2 style="font-size:1.3rem;font-weight:800;letter-spacing:-0.025em;">Edit Course</h2>
            <p style="font-size:0.875rem;color:#64748b;margin-top:0.2rem;">Update course content and settings.</p>
        </div>
        <a href="{{ route('dashboard', ['panel' => 'courses']) }}" class="btn-secondary" style="text-decoration:none;">
            ← Back to Courses
        </a>
    </div>

    @if($errors->any())
        <div class="alert-error">
            <strong>Please fix the following errors:</strong>
            <ul style="padding-left:1rem;margin-top:.3rem;">
                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('courses.update', $course) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">Course Details</div>
                <div class="form-card-sub">Title, category, tagline and descriptions.</div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group full">
                        <label>Title <span style="color:#dc2626;">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $course->title) }}"
                            placeholder="e.g. Science Preparation" required>
                    </div>
                    <div class="form-group">
                        <label>Category <span style="color:#dc2626;">*</span></label>
                        <input type="text" name="category" value="{{ old('category', $course->category) }}"
                            placeholder="e.g. Science, Commerce, SSC" required>
                    </div>
                    <div class="form-group">
                        <label>Tagline</label>
                        <input type="text" name="tagline" value="{{ old('tagline', $course->tagline) }}"
                            placeholder="Short one-liner for the card">
                    </div>
                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $course->sort_order) }}"
                            min="0">
                    </div>
                    <div class="form-group" style="display:flex;align-items:center;gap:.75rem;padding-top:1.5rem;">
                        <label style="display:flex;align-items:center;gap:.6rem;cursor:pointer;">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', $course->is_active) ? 'checked' : '' }}
                                style="width:16px;height:16px;accent-color:var(--brand);">
                            <span style="font-size:.875rem;font-weight:600;color:#1e293b;">Active (visible on site)</span>
                        </label>
                    </div>
                    <div class="form-group full">
                        <label>Short Description <small style="color:#94a3b8;">(shown on card)</small></label>
                        <textarea name="short_description" rows="2">{{ old('short_description', $course->short_description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">Full Description</div>
                <div class="form-card-sub">Detailed content shown on the course detail page.</div>
            </div>
            <div class="form-body">
                <div class="form-group full">
                    <textarea name="description" rows="12" class="wysiwyg">{!! old('description', $course->description) !!}</textarea>
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">Course Image</div>
                <div class="form-card-sub">Leave blank to keep the current image.</div>
            </div>
            <div class="form-body">
                <div class="form-group">
                    <label>Upload New Image</label>
                    <input type="file" name="image" accept="image/*" onchange="previewImage(this,'prev_image')">
                    <div class="img-preview">
                        <img id="prev_image"
                            src="{{ $course->image ? asset('storage/' . $course->image) : asset('assets/images/services/services-2-1.jpg') }}"
                            alt="Current image">
                        <span>Current course image</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- SEO --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">SEO</div>
                <div class="form-card-sub">Search engine optimisation — helps Google rank this course.</div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group full">
                        <label>URL Slug <small style="color:#94a3b8;">(customise to change the page URL)</small></label>
                        <div style="display:flex;align-items:stretch;">
                            <span style="background:#f1f5f9;border:1px solid #e2e8f0;border-right:none;border-radius:8px 0 0 8px;padding:.55rem .85rem;font-size:.82rem;color:#64748b;line-height:1.6;white-space:nowrap;">rjtutorials.in/courses/</span>
                            <input type="text" id="slug_field" name="slug" value="{{ old('slug', $course->slug) }}"
                                style="border-radius:0 8px 8px 0;" oninput="this.value=slugify(this.value)">
                        </div>
                    </div>
                    <div class="form-group full">
                        <label>Meta Title <small style="color:#94a3b8;">(leave blank to use course title &mdash; 50-60 chars)</small></label>
                        <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $course->meta_title) }}"
                            placeholder="e.g. Science Preparation Course | RJ Tutorials" maxlength="80"
                            oninput="countChars(this,'meta_title_count',60)">
                        <span id="meta_title_count" style="font-size:.75rem;color:#94a3b8;">{{ strlen(old('meta_title', $course->meta_title ?? '')) }} / 60</span>
                    </div>
                    <div class="form-group full">
                        <label>Meta Description <small style="color:#94a3b8;">(leave blank to use short description &mdash; 150-160 chars)</small></label>
                        <textarea name="meta_description" rows="3" maxlength="165"
                            placeholder="Brief description shown in Google search results..."
                            oninput="countChars(this,'meta_desc_count',160)">{{ old('meta_description', $course->meta_description) }}</textarea>
                        <span id="meta_desc_count" style="font-size:.75rem;color:#94a3b8;">{{ strlen(old('meta_description', $course->meta_description ?? '')) }} / 160</span>
                    </div>
                    <div class="form-group full">
                        <label>Meta Keywords <small style="color:#94a3b8;">(comma-separated)</small></label>
                        <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $course->meta_keywords) }}"
                            placeholder="science course, RJ tutorials, preparation">
                    </div>
                </div>
            </div>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:.75rem;">
            <a href="{{ route('dashboard', ['panel' => 'courses']) }}" class="btn-secondary"
                style="text-decoration:none;">Cancel</a>
            <button type="submit" class="btn-primary">Save Changes</button>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        function slugify(str) {
            return str.toLowerCase().trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
        }
        function countChars(el, countId, max) {
            const len = el.value.length;
            const el2 = document.getElementById(countId);
            el2.textContent = len + ' / ' + max;
            el2.style.color = len > max ? '#dc2626' : '#94a3b8';
        }
        function previewImage(input, previewId) {
            const reader = new FileReader();
            reader.onload = e => { document.getElementById(previewId).src = e.target.result; };
            if (input.files[0]) reader.readAsDataURL(input.files[0]);
        }
    </script>
@endpush
