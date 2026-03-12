@extends('backend.layouts.app')
@section('page-title', 'Edit Blog Post')

@section('content')
    <div style="margin-bottom:1.75rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
        <div>
            <h2 style="font-size:1.3rem;font-weight:800;letter-spacing:-0.025em;">Edit Blog Post</h2>
            <p style="font-size:0.875rem;color:#64748b;margin-top:0.2rem;">Update post content and settings.</p>
        </div>
        <a href="{{ route('dashboard', ['panel' => 'blog']) }}" class="btn-secondary" style="text-decoration:none;">
            ← Back to Blog
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

    <form method="POST" action="{{ route('blog.update', $blog) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">Post Details</div>
                <div class="form-card-sub">Title, category, author and excerpt.</div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group full">
                        <label for="title">Title <span style="color:#dc2626;">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title', $blog->title) }}"
                            placeholder="Enter post title" required oninput="autoSlug(this.value,'slug_field')">
                    </div>
                    <div class="form-group full">
                        <label>URL Slug <small style="color:#94a3b8;">(customise to change the page URL)</small></label>
                        <div style="display:flex;align-items:stretch;">
                            <span style="background:#f1f5f9;border:1px solid #e2e8f0;border-right:none;border-radius:8px 0 0 8px;padding:.55rem .85rem;font-size:.82rem;color:#64748b;line-height:1.6;white-space:nowrap;">rjtutorials.in/blog/</span>
                            <input type="text" id="slug_field" name="slug" value="{{ old('slug', $blog->slug) }}"
                                style="border-radius:0 8px 8px 0;" oninput="this.value=slugify(this.value)">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category">Category <span style="color:#dc2626;">*</span></label>
                        <input type="text" id="category" name="category"
                            value="{{ old('category', $blog->category) }}" placeholder="e.g. Exam Tips" required>
                    </div>
                    <div class="form-group">
                        <label for="author">Author <span style="color:#dc2626;">*</span></label>
                        <input type="text" id="author" name="author" value="{{ old('author', $blog->author) }}"
                            placeholder="Author name" required>
                    </div>
                    <div class="form-group full">
                        <label for="excerpt">Excerpt</label>
                        <textarea id="excerpt" name="excerpt" rows="2" class="wysiwyg">{!! old('excerpt', $blog->excerpt) !!}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">Content</div>
                <div class="form-card-sub">Full article body.</div>
            </div>
            <div class="form-body">
                <div class="form-group full">
                    <label for="content">Body</label>
                    <textarea id="content" name="content" rows="12" class="wysiwyg">{!! old('content', $blog->content) !!}</textarea>
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">Featured Image</div>
                <div class="form-card-sub">Leave blank to keep the current image.</div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="image">Upload New Image</label>
                        <input type="file" id="image" name="image" accept="image/*"
                            onchange="previewImage(this,'prev_image')">
                        <div class="img-preview">
                            <img id="prev_image"
                                src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('assets/images/blog/default.jpg') }}"
                                alt="Current image">
                            <span>Current featured image</span>
                        </div>
                    </div>
                    <div class="form-group" style="display:flex;align-items:center;gap:.75rem;padding-top:1.5rem;">
                        <label class="toggle-label" style="display:flex;align-items:center;gap:.6rem;cursor:pointer;">
                            <input type="hidden" name="is_published" value="0">
                            <input type="checkbox" name="is_published" value="1"
                                {{ old('is_published', $blog->is_published) ? 'checked' : '' }}
                                style="width:16px;height:16px;accent-color:var(--brand);">
                            <span style="font-size:.875rem;font-weight:600;color:#1e293b;">Published</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- SEO --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">SEO</div>
                <div class="form-card-sub">Search engine optimisation — helps Google rank this post.</div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group full">
                        <label>Meta Title <small style="color:#94a3b8;">(leave blank to use post title)</small></label>
                        <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $blog->meta_title) }}"
                            placeholder="e.g. Science Exam Tips | RJ Tutorials">
                    </div>
                    <div class="form-group full">
                        <label>Meta Description <small style="color:#94a3b8;">(leave blank to use excerpt)</small></label>
                        <textarea name="meta_description" rows="3"
                            placeholder="Brief description shown in Google search results...">{{ old('meta_description', $blog->meta_description) }}</textarea>
                    </div>
                    <div class="form-group full">
                        <label>Meta Keywords <small style="color:#94a3b8;">(comma-separated)</small></label>
                        <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $blog->meta_keywords) }}"
                            placeholder="science preparation, SSC, RJ tutorials">
                    </div>
                </div>
            </div>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:.75rem;">
            <a href="{{ route('dashboard', ['panel' => 'blog']) }}" class="btn-secondary"
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
