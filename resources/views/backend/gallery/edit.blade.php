@extends('backend.layouts.app')
@section('page-title', $gallery->isVideo() ? 'Edit Video' : 'Edit Image')

@section('content')
    <div style="margin-bottom:1.75rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
        <div>
            <h2 style="font-size:1.3rem;font-weight:800;letter-spacing:-0.025em;">
                {{ $gallery->isVideo() ? 'Edit Video' : 'Edit Image' }}
            </h2>
            <p style="font-size:0.875rem;color:#64748b;margin-top:0.2rem;">
                {{ $gallery->isVideo() ? 'Update gallery video details.' : 'Update gallery image details.' }}
            </p>
        </div>
        <a href="{{ route('dashboard', ['panel' => 'gallery']) }}" class="btn-secondary" style="text-decoration:none;">
            ← Back to Gallery
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

    <form method="POST" action="{{ route('gallery.update', $gallery) }}" enctype="multipart/form-data" id="gallery-form">
        @csrf
        @method('PUT')

        {{-- Media type selector --}}
        <div class="form-card" style="margin-bottom:1.25rem;">
            <div class="form-body" style="padding:.75rem 1.25rem;">
                <div style="display:flex;align-items:center;gap:.6rem;">
                    <span style="font-size:.875rem;font-weight:600;color:#475569;">Type:</span>
                    <div style="display:flex;gap:.5rem;">
                        <button type="button" id="btn-type-image" onclick="setMediaType('image')"
                            style="padding:.35rem 1rem;border-radius:20px;border:2px solid transparent;font-size:.8rem;font-weight:700;cursor:pointer;transition:all .2s;">
                            📷 Image
                        </button>
                        <button type="button" id="btn-type-video" onclick="setMediaType('video')"
                            style="padding:.35rem 1rem;border-radius:20px;border:2px solid transparent;font-size:.8rem;font-weight:700;cursor:pointer;transition:all .2s;">
                            🎬 Video
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="media_type" id="media_type_input" value="{{ old('media_type', $gallery->media_type ?? 'image') }}">

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">Details</div>
                <div class="form-card-sub">Title, category and caption.</div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group full">
                        <label>Title <span style="color:#dc2626;">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $gallery->title) }}"
                            placeholder="e.g. Annual Day 2025" required>
                    </div>
                    <div class="form-group">
                        <label>Category <span style="color:#dc2626;">*</span></label>
                        <input type="text" name="category" value="{{ old('category', $gallery->category) }}"
                            placeholder="e.g. Classroom, Events, Achievements, Campus" required>
                    </div>
                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $gallery->sort_order) }}" min="0">
                    </div>
                    <div class="form-group full">
                        <label>Caption <small style="color:#94a3b8;">(optional short description)</small></label>
                        <input type="text" name="caption" value="{{ old('caption', $gallery->caption) }}"
                            placeholder="Brief caption shown in lightbox">
                    </div>
                    <div class="form-group" style="display:flex;align-items:center;gap:.75rem;padding-top:1.5rem;">
                        <label style="display:flex;align-items:center;gap:.6rem;cursor:pointer;">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}
                                style="width:16px;height:16px;accent-color:var(--brand);">
                            <span style="font-size:.875rem;font-weight:600;color:#1e293b;">Active (visible on site)</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- IMAGE section --}}
        <div class="form-card" id="section-image">
            <div class="form-card-header">
                <div class="form-card-title">Photo</div>
                <div class="form-card-sub">Leave blank to keep the current image.</div>
            </div>
            <div class="form-body">
                <div class="form-group">
                    <label>Upload New Image</label>
                    <input type="file" name="image" id="image-input" accept="image/*"
                        onchange="previewImage(this,'prev_image')">
                    <div class="img-preview">
                        @if($gallery->image)
                            <img id="prev_image" src="{{ asset('storage/' . $gallery->image) }}"
                                alt="{{ $gallery->title }}">
                        @else
                            <img id="prev_image" src="" alt="Preview" style="display:none;">
                        @endif
                        <span>Current image</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- VIDEO section --}}
        <div class="form-card" id="section-video">
            <div class="form-card-header">
                <div class="form-card-title">Video URL <span style="color:#dc2626;">*</span></div>
                <div class="form-card-sub">YouTube or Vimeo link.</div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group full">
                        <label>YouTube / Vimeo URL <span style="color:#dc2626;">*</span></label>
                        <input type="url" name="video_url" id="video_url_input"
                            value="{{ old('video_url', $gallery->video_url) }}"
                            placeholder="https://www.youtube.com/watch?v=...">
                        <small style="color:#94a3b8;margin-top:.3rem;display:block;">
                            Supports: youtube.com/watch?v=ID, youtu.be/ID, vimeo.com/ID
                        </small>
                    </div>
                    <div class="form-group full" id="yt-preview-wrap"
                         style="{{ $gallery->video_url ? '' : 'display:none;' }}">
                        <label>Current Video Preview</label>
                        <div style="position:relative;padding-bottom:56.25%;height:0;border-radius:10px;overflow:hidden;background:#000;">
                            <iframe id="yt-preview-iframe"
                                src="{{ $gallery->embed_url ?? '' }}"
                                frameborder="0" allowfullscreen
                                style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>
                        </div>
                    </div>
                    <div class="form-group full">
                        <label>Custom Thumbnail <small style="color:#94a3b8;">(optional — YouTube auto-thumbnail used if blank)</small></label>
                        <input type="file" name="image" accept="image/*"
                            onchange="previewThumb(this)">
                        @if($gallery->image)
                            <div class="img-preview" id="thumb_preview_wrap">
                                <img id="prev_thumb" src="{{ asset('storage/' . $gallery->image) }}"
                                    alt="Current thumbnail">
                                <span>Current thumbnail</span>
                            </div>
                        @else
                            <div class="img-preview" id="thumb_preview_wrap" style="display:none;">
                                <img id="prev_thumb" src="" alt="Thumbnail Preview">
                                <span>Thumbnail Preview</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:.75rem;">
            <a href="{{ route('dashboard', ['panel' => 'gallery']) }}" class="btn-secondary"
                style="text-decoration:none;">Cancel</a>
            <button type="submit" class="btn-primary" id="submit-btn">Save Changes</button>
        </div>
    </form>

    <script>
        const initialType = '{{ old('media_type', $gallery->media_type ?? 'image') }}';
        setMediaType(initialType);

        function setMediaType(type) {
            const isVideo = type === 'video';
            document.getElementById('media_type_input').value = type;

            document.getElementById('section-image').style.display = isVideo ? 'none' : '';
            document.getElementById('section-video').style.display = isVideo ? '' : 'none';

            const vInput = document.getElementById('video_url_input');
            if (vInput) vInput.required = isVideo;

            const brandColor = getComputedStyle(document.documentElement).getPropertyValue('--brand') || '#6366f1';
            const activeStyle = `background:${brandColor};color:#fff;border-color:${brandColor};`;
            const inactiveStyle = 'background:#f1f5f9;color:#475569;border-color:#e2e8f0;';
            document.getElementById('btn-type-image').style.cssText = (!isVideo ? activeStyle : inactiveStyle);
            document.getElementById('btn-type-video').style.cssText = (isVideo ? activeStyle : inactiveStyle);
        }

        document.getElementById('video_url_input').addEventListener('input', function () {
            const url = this.value;
            let embedUrl = null;
            const ytMatch = url.match(/youtube\.com\/watch\?v=([^&\s]+)/) || url.match(/youtu\.be\/([^?&\s]+)/);
            if (ytMatch) embedUrl = 'https://www.youtube.com/embed/' + ytMatch[1];
            const vimeoMatch = url.match(/vimeo\.com\/(\d+)/);
            if (vimeoMatch) embedUrl = 'https://player.vimeo.com/video/' + vimeoMatch[1];

            const wrap = document.getElementById('yt-preview-wrap');
            if (embedUrl) {
                document.getElementById('yt-preview-iframe').src = embedUrl;
                wrap.style.display = '';
            } else {
                document.getElementById('yt-preview-iframe').src = '';
                wrap.style.display = 'none';
            }
        });

        function previewImage(input, previewId) {
            const reader = new FileReader();
            reader.onload = e => { document.getElementById(previewId).src = e.target.result; };
            if (input.files[0]) reader.readAsDataURL(input.files[0]);
        }

        function previewThumb(input) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('prev_thumb').src = e.target.result;
                document.getElementById('prev_thumb').style.display = '';
                document.getElementById('thumb_preview_wrap').style.display = 'flex';
            };
            if (input.files[0]) reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection

        <a href="{{ route('dashboard', ['panel' => 'gallery']) }}" class="btn-secondary" style="text-decoration:none;">
            ← Back to Gallery
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

    <form method="POST" action="{{ route('gallery.update', $gallery) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">Image Details</div>
                <div class="form-card-sub">Title, category and caption.</div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group full">
                        <label>Title <span style="color:#dc2626;">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $gallery->title) }}"
                            placeholder="e.g. Annual Day 2025" required>
                    </div>
                    <div class="form-group">
                        <label>Category <span style="color:#dc2626;">*</span></label>
                        <input type="text" name="category" value="{{ old('category', $gallery->category) }}"
                            placeholder="e.g. Classroom, Events, Achievements, Campus" required>
                    </div>
                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $gallery->sort_order) }}" min="0">
                    </div>
                    <div class="form-group full">
                        <label>Caption <small style="color:#94a3b8;">(optional short description)</small></label>
                        <input type="text" name="caption" value="{{ old('caption', $gallery->caption) }}"
                            placeholder="Brief caption shown in lightbox">
                    </div>
                    <div class="form-group" style="display:flex;align-items:center;gap:.75rem;padding-top:1.5rem;">
                        <label style="display:flex;align-items:center;gap:.6rem;cursor:pointer;">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}
                                style="width:16px;height:16px;accent-color:var(--brand);">
                            <span style="font-size:.875rem;font-weight:600;color:#1e293b;">Active (visible on site)</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">Photo</div>
                <div class="form-card-sub">Leave blank to keep the current image.</div>
            </div>
            <div class="form-body">
                <div class="form-group">
                    <label>Upload New Image</label>
                    <input type="file" name="image" accept="image/*"
                        onchange="previewImage(this,'prev_image')">
                    <div class="img-preview">
                        <img id="prev_image" src="{{ asset('storage/' . $gallery->image) }}"
                            alt="{{ $gallery->title }}">
                        <span>Current image</span>
                    </div>
                </div>
            </div>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:.75rem;">
            <a href="{{ route('dashboard', ['panel' => 'gallery']) }}" class="btn-secondary"
                style="text-decoration:none;">Cancel</a>
            <button type="submit" class="btn-primary">Save Changes</button>
        </div>
    </form>

    <script>
        function previewImage(input, previewId) {
            const reader = new FileReader();
            reader.onload = e => { document.getElementById(previewId).src = e.target.result; };
            if (input.files[0]) reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection
