@extends('backend.layouts.app')
@section('page-title', 'New Course')

@section('content')
    <div
        style="margin-bottom:1.75rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
        <div>
            <h2 style="font-size:1.3rem;font-weight:800;letter-spacing:-0.025em;">New Course</h2>
            <p style="font-size:0.875rem;color:#64748b;margin-top:0.2rem;">Add a new course to the website.</p>
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

    <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">Course Details</div>
                <div class="form-card-sub">Title, category, tagline and descriptions.</div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group full">
                        <label>Title <span style="color:#dc2626;">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            placeholder="e.g. Science Preparation" required oninput="autoSlug(this.value,'slug_field')">
                    </div>
                    <div class="form-group">
                        <label>Category <span style="color:#dc2626;">*</span></label>
                        <input type="text" name="category" value="{{ old('category', 'General') }}"
                            placeholder="e.g. Science, Commerce, SSC" required>
                    </div>
                    <div class="form-group">
                        <label>Tagline</label>
                        <input type="text" name="tagline" value="{{ old('tagline') }}"
                            placeholder="Short one-liner for the card">
                    </div>
                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                    </div>
                    <div class="form-group" style="display:flex;align-items:center;gap:.75rem;padding-top:1.5rem;">
                        <label style="display:flex;align-items:center;gap:.6rem;cursor:pointer;">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}
                                style="width:16px;height:16px;accent-color:var(--brand);">
                            <span style="font-size:.875rem;font-weight:600;color:#1e293b;">Active (visible on site)</span>
                        </label>
                    </div>
                    <div class="form-group full">
                        <label>Short Description <small style="color:#94a3b8;">(shown on card)</small></label>
                        <textarea name="short_description" rows="2"
                            placeholder="Brief description for the course listing card...">{{ old('short_description') }}</textarea>
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
                    <textarea name="description" rows="12" class="wysiwyg"
                        placeholder="Write full course details here...">{!! old('description') !!}</textarea>
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">Course Image</div>
                <div class="form-card-sub">Recommended: 800×600px.</div>
            </div>
            <div class="form-body">
                <div class="form-group">
                    <label>Upload Image</label>
                    <input type="file" name="image" accept="image/*" onchange="previewImage(this,'prev_image')">
                    <div class="img-preview" id="img_preview_wrap" style="display:none;">
                        <img id="prev_image" src="" alt="Preview">
                        <span>Preview</span>
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
                        <label>URL Slug <small style="color:#94a3b8;">(auto-filled from title — you can
                                customise)</small></label>
                        <div style="display:flex;align-items:stretch;">
                            <span
                                style="background:#f1f5f9;border:1px solid #e2e8f0;border-right:none;border-radius:8px 0 0 8px;padding:.55rem .85rem;font-size:.82rem;color:#64748b;line-height:1.6;white-space:nowrap;">rjtutorials.in/courses/</span>
                            <input type="text" id="slug_field" name="slug" value="{{ old('slug') }}"
                                placeholder="my-course-title" style="border-radius:0 8px 8px 0;"
                                oninput="this.value=slugify(this.value)">
                        </div>
                    </div>
                    <div class="form-group full">
                        <label>Meta Title <small style="color:#94a3b8;">(leave blank to use course title)</small></label>
                        <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}"
                            placeholder="e.g. Science Preparation Course | RJ Tutorials">
                    </div>
                    <div class="form-group full">
                        <label>Meta Description <small style="color:#94a3b8;">(leave blank to use short description)</small></label>
                        <textarea name="meta_description" rows="3"
                            placeholder="Brief description shown in Google search results...">{{ old('meta_description') }}</textarea>
                    </div>
                    <div class="form-group full">
                        <label>Meta Keywords <small style="color:#94a3b8;">(comma-separated)</small></label>
                        <input type="text" name="meta_keywords" value="{{ old('meta_keywords') }}"
                            placeholder="science course, RJ tutorials, preparation">
                    </div>
                </div>
            </div>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:.75rem;">
            <a href="{{ route('dashboard', ['panel' => 'courses']) }}" class="btn-secondary"
                style="text-decoration:none;">Cancel</a>
            <button type="submit" class="btn-primary">Create Course</button>
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
        let slugEdited = false;
        document.getElementById('slug_field').addEventListener('input', () => slugEdited = true);
        function autoSlug(val, fieldId) {
            if (!slugEdited) document.getElementById(fieldId).value = slugify(val);
        }
        function countChars(el, countId, max) {
            const len = el.value.length;
            const el2 = document.getElementById(countId);
            el2.textContent = len + ' / ' + max;
            el2.style.color = len > max ? '#dc2626' : '#94a3b8';
        }
        function previewImage(input, previewId) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById(previewId).src = e.target.result;
                document.getElementById('img_preview_wrap').style.display = 'flex';
            };
            if (input.files[0]) reader.readAsDataURL(input.files[0]);
        }
    </script>
@endpush