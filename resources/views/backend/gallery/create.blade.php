@extends('backend.layouts.app')
@section('page-title', $type === 'video' ? 'Add Video' : 'Upload Image')

@section('content')
    <div
        style="margin-bottom:1.75rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
        <div>
            <h2 style="font-size:1.3rem;font-weight:800;letter-spacing:-0.025em;" id="page-heading">
                {{ $type === 'video' ? 'Add Video' : 'Upload Image' }}
            </h2>
            <p style="font-size:0.875rem;color:#64748b;margin-top:0.2rem;" id="page-sub">
                {{ $type === 'video' ? 'Add a video to the gallery.' : 'Add a new photo to the gallery.' }}
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

    <form method="POST" action="{{ route('gallery.store') }}" enctype="multipart/form-data" id="gallery-form">
        @csrf
        <input type="hidden" name="media_type" id="media_type_input" value="{{ old('media_type', $type) }}">
        <input type="hidden" name="video_source" id="video_source_input" value="{{ old('video_source', 'file') }}">

        {{-- Image / Video toggle --}}
        <div class="form-card" style="margin-bottom:1.25rem;">
            <div class="form-body" style="padding:.75rem 1.25rem;">
                <div style="display:flex;align-items:center;gap:.6rem;flex-wrap:wrap;">
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

                    {{-- Video source sub-toggle (visible only for video) --}}
                    <div id="video-source-toggle"
                        style="display:none;margin-left:.5rem;border-left:2px solid #e2e8f0;padding-left:.75rem;display:flex;gap:.4rem;align-items:center;">
                        <span style="font-size:.8rem;font-weight:600;color:#94a3b8;">Source:</span>
                        <button type="button" id="btn-vsrc-file" onclick="setVideoSource('file')"
                            style="padding:.3rem .85rem;border-radius:20px;border:2px solid transparent;font-size:.78rem;font-weight:700;cursor:pointer;transition:all .2s;">
                            📁 Upload File
                        </button>
                        <button type="button" id="btn-vsrc-url" onclick="setVideoSource('url')"
                            style="padding:.3rem .85rem;border-radius:20px;border:2px solid transparent;font-size:.78rem;font-weight:700;cursor:pointer;transition:all .2s;">
                            🌐 YouTube / Vimeo
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Basic info --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title" id="details-card-title">Details</div>
                <div class="form-card-sub">Title and category.</div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group full">
                        <label>Title <span style="color:#dc2626;">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Annual Day 2025"
                            required>
                    </div>
                    <div class="form-group full">
                        <label>Category <span style="color:#dc2626;">*</span></label>
                        <input type="text" name="category" value="{{ old('category', 'General') }}"
                            placeholder="e.g. Events, Classroom, Achievements" required>
                    </div>
                    <div class="form-group" style="display:flex;align-items:center;gap:.75rem;padding-top:1rem;">
                        <label style="display:flex;align-items:center;gap:.6rem;cursor:pointer;">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}
                                style="width:16px;height:16px;accent-color:var(--brand);">
                            <span style="font-size:.875rem;font-weight:600;color:#1e293b;">Active (visible on site)</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- IMAGE file section --}}
        <div class="form-card" id="section-image">
            <div class="form-card-header">
                <div class="form-card-title">Photo <span style="color:#dc2626;">*</span></div>
                <div class="form-card-sub">Select one or multiple images. Max 3 MB each.</div>
            </div>
            <div class="form-body">
                <div class="form-group">
                    <label>Upload Image(s)</label>
                    <input type="file" name="images[]" id="image-input" accept="image/*" multiple
                        onchange="previewImages(this)">
                    <div id="multi-preview-wrap"
                        style="display:none;margin-top:.75rem;display:flex;flex-wrap:wrap;gap:.75rem;"></div>
                </div>
            </div>
        </div>

        {{-- VIDEO — Upload File --}}
        <div class="form-card" id="section-video-file" style="display:none;">
            <div class="form-card-header">
                <div class="form-card-title">Video File <span style="color:#dc2626;">*</span></div>
                <div class="form-card-sub">MP4, WebM, MOV. Max 100 MB. (Ensure your server allows large uploads.)</div>
            </div>
            <div class="form-body">
                <div class="form-group">
                    <label>Select Video</label>
                    <input type="file" name="video_file" id="video-file-input"
                        accept="video/mp4,video/webm,video/ogg,video/quicktime,video/x-msvideo"
                        onchange="previewFile(this,'prev_video','video_preview_wrap','video')">
                    <div id="video_preview_wrap" style="display:none;margin-top:.75rem;">
                        <video id="prev_video" controls
                            style="width:100%;max-width:480px;border-radius:10px;background:#000;"></video>
                    </div>
                </div>
            </div>
        </div>

        {{-- VIDEO — YouTube / Vimeo URL --}}
        <div class="form-card" id="section-video-url" style="display:none;">
            <div class="form-card-header">
                <div class="form-card-title">Video URL <span style="color:#dc2626;">*</span></div>
                <div class="form-card-sub">Paste a YouTube or Vimeo link.</div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group full">
                        <label>YouTube / Vimeo URL</label>
                        <input type="url" name="video_url" id="video_url_input" value="{{ old('video_url') }}"
                            placeholder="https://www.youtube.com/watch?v=...">
                        <small style="color:#94a3b8;margin-top:.3rem;display:block;">
                            Supports: youtube.com/watch?v=ID &nbsp;|&nbsp; youtu.be/ID &nbsp;|&nbsp; vimeo.com/ID
                        </small>
                    </div>
                    <div class="form-group full" id="yt-preview-wrap" style="display:none;">
                        <label>Preview</label>
                        <div
                            style="position:relative;padding-bottom:56.25%;height:0;border-radius:10px;overflow:hidden;background:#000;">
                            <iframe id="yt-preview-iframe" src="" frameborder="0" allowfullscreen
                                style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:.75rem;">
            <a href="{{ route('dashboard', ['panel' => 'gallery']) }}" class="btn-secondary"
                style="text-decoration:none;">Cancel</a>
            <button type="submit" class="btn-primary" id="submit-btn">Upload Image</button>
        </div>
    </form>

    <script>
        const initialType = '{{ old('media_type', $type) }}';
        const initialVSrc = '{{ old('video_source', 'file') }}';
        setMediaType(initialType, initialVSrc);

        function setMediaType(type, vSrc) {
            vSrc = vSrc || document.getElementById('video_source_input').value || 'file';
            const isVideo = type === 'video';
            document.getElementById('media_type_input').value = type;

            document.getElementById('section-image').style.display = (!isVideo) ? '' : 'none';
            document.getElementById('section-video-file').style.display = (isVideo && vSrc === 'file') ? '' : 'none';
            document.getElementById('section-video-url').style.display = (isVideo && vSrc === 'url') ? '' : 'none';

            const vsToggle = document.getElementById('video-source-toggle');
            vsToggle.style.display = isVideo ? 'flex' : 'none';

            // required fields
            document.getElementById('image-input').required = !isVideo;
            document.getElementById('video-file-input').required = (isVideo && vSrc === 'file');
            const vuInput = document.getElementById('video_url_input');
            if (vuInput) vuInput.required = (isVideo && vSrc === 'url');

            document.getElementById('submit-btn').textContent = isVideo ? 'Add Video' : 'Upload Image';
            document.getElementById('page-heading').textContent = isVideo ? 'Add Video' : 'Upload Image';
            document.getElementById('page-sub').textContent = isVideo
                ? 'Add a video to the gallery.'
                : 'Add a new photo to the gallery.';

            styleTypeBtn('btn-type-image', !isVideo);
            styleTypeBtn('btn-type-video', isVideo);
            if (isVideo) styleVsrcBtns(vSrc);
        }

        function setVideoSource(src) {
            document.getElementById('video_source_input').value = src;
            const type = document.getElementById('media_type_input').value;
            setMediaType(type, src);
        }

        function styleTypeBtn(id, active) {
            const brand = getComputedStyle(document.documentElement).getPropertyValue('--brand') || '#6366f1';
            document.getElementById(id).style.cssText = active
                ? `background:${brand};color:#fff;border-color:${brand};`
                : 'background:#f1f5f9;color:#475569;border-color:#e2e8f0;';
        }

        function styleVsrcBtns(src) {
            const brand = getComputedStyle(document.documentElement).getPropertyValue('--brand') || '#6366f1';
            const active = `background:${brand};color:#fff;border-color:${brand};`;
            const inactive = 'background:#f1f5f9;color:#475569;border-color:#e2e8f0;';
            document.getElementById('btn-vsrc-file').style.cssText = src === 'file' ? active : inactive;
            document.getElementById('btn-vsrc-url').style.cssText = src === 'url' ? active : inactive;
        }

        // Live YouTube/Vimeo preview
        document.getElementById('video_url_input').addEventListener('input', function () {
            const url = this.value;
            let embed = null;
            const yt = url.match(/youtube\.com\/watch\?v=([^&\s]+)/) || url.match(/youtu\.be\/([^?&\s]+)/);
            if (yt) embed = 'https://www.youtube.com/embed/' + yt[1];
            const vim = url.match(/vimeo\.com\/(\d+)/);
            if (vim) embed = 'https://player.vimeo.com/video/' + vim[1];
            const wrap = document.getElementById('yt-preview-wrap');
            if (embed) { document.getElementById('yt-preview-iframe').src = embed; wrap.style.display = ''; }
            else { document.getElementById('yt-preview-iframe').src = ''; wrap.style.display = 'none'; }
        });

        function previewFile(input, previewId, wrapId, kind) {
            if (!input.files[0]) return;
            if (kind === 'video') {
                const url = URL.createObjectURL(input.files[0]);
                document.getElementById(previewId).src = url;
                document.getElementById(wrapId).style.display = '';
            } else {
                const reader = new FileReader();
                reader.onload = e => {
                    document.getElementById(previewId).src = e.target.result;
                    document.getElementById(wrapId).style.display = 'flex';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection

@section('content')
    <div
        style="margin-bottom:1.75rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
        <div>
            <h2 style="font-size:1.3rem;font-weight:800;letter-spacing:-0.025em;" id="page-heading">
                {{ $type === 'video' ? 'Add Video' : 'Upload Image' }}
            </h2>
            <p style="font-size:0.875rem;color:#64748b;margin-top:0.2rem;" id="page-sub">
                {{ $type === 'video' ? 'Add a YouTube / Vimeo video to the gallery.' : 'Add a new photo to the gallery.' }}
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

    <form method="POST" action="{{ route('gallery.store') }}" enctype="multipart/form-data" id="gallery-form">
        @csrf

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
        <input type="hidden" name="media_type" id="media_type_input" value="{{ old('media_type', $type) }}">

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title" id="details-card-title">Details</div>
                <div class="form-card-sub">Title, category and caption.</div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group full">
                        <label>Title <span style="color:#dc2626;">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Annual Day 2025"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Category <span style="color:#dc2626;">*</span></label>
                        <input type="text" name="category" value="{{ old('category', 'General') }}"
                            placeholder="e.g. Classroom, Events, Achievements, Campus" required>
                    </div>
                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                    </div>
                    <div class="form-group full">
                        <label>Caption <small style="color:#94a3b8;">(optional short description)</small></label>
                        <input type="text" name="caption" value="{{ old('caption') }}"
                            placeholder="Brief caption shown in lightbox">
                    </div>
                    <div class="form-group" style="display:flex;align-items:center;gap:.75rem;padding-top:1.5rem;">
                        <label style="display:flex;align-items:center;gap:.6rem;cursor:pointer;">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}
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
                <div class="form-card-title">Photo <span style="color:#dc2626;">*</span></div>
                <div class="form-card-sub">Select one or multiple images. Max 3 MB each.</div>
            </div>
            <div class="form-body">
                <div class="form-group">
                    <label>Upload Image(s)</label>
                    <input type="file" name="images[]" id="image-input" accept="image/*" multiple
                        onchange="previewImages(this)">
                    <div id="multi-preview-wrap"
                        style="display:none;margin-top:.75rem;display:flex;flex-wrap:wrap;gap:.75rem;"></div>
                </div>
            </div>
        </div>

        {{-- VIDEO section --}}
        <div class="form-card" id="section-video" style="display:none;">
            <div class="form-card-header">
                <div class="form-card-title">Video URL <span style="color:#dc2626;">*</span></div>
                <div class="form-card-sub">Paste a YouTube or Vimeo link.</div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group full">
                        <label>YouTube / Vimeo URL <span style="color:#dc2626;">*</span></label>
                        <input type="url" name="video_url" id="video_url_input" value="{{ old('video_url') }}"
                            placeholder="https://www.youtube.com/watch?v=... or https://vimeo.com/...">
                        <small style="color:#94a3b8;margin-top:.3rem;display:block;">
                            Supports: youtube.com/watch?v=ID, youtu.be/ID, vimeo.com/ID
                        </small>
                    </div>
                    <div class="form-group full" id="yt-preview-wrap" style="display:none;">
                        <label>Preview</label>
                        <div
                            style="position:relative;padding-bottom:56.25%;height:0;border-radius:10px;overflow:hidden;background:#000;">
                            <iframe id="yt-preview-iframe" src="" frameborder="0" allowfullscreen
                                style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:.75rem;">
            <a href="{{ route('dashboard', ['panel' => 'gallery']) }}" class="btn-secondary"
                style="text-decoration:none;">Cancel</a>
            <button type="submit" class="btn-primary" id="submit-btn">Upload Image</button>
        </div>
    </form>

    <script>
        const initialType = '{{ old('media_type', $type) }}';
        setMediaType(initialType);

        function setMediaType(type) {
            const isVideo = type === 'video';
            document.getElementById('media_type_input').value = type;

            // Toggle sections
            document.getElementById('section-image').style.display = isVideo ? 'none' : '';
            document.getElementById('section-video').style.display = isVideo ? '' : 'none';

            // No required toggle needed — server validates images[]

            // Toggle video_url required
            const vInput = document.getElementById('video_url_input');
            if (vInput) vInput.required = isVideo;

            // Update button & heading
            document.getElementById('submit-btn').textContent = isVideo ? 'Add Video' : 'Upload Image';
            document.getElementById('page-heading').textContent = isVideo ? 'Add Video' : 'Upload Image';
            document.getElementById('page-sub').textContent = isVideo
                ? 'Add a YouTube / Vimeo video to the gallery.'
                : 'Add a new photo to the gallery.';

            // Style toggle buttons
            const brandColor = getComputedStyle(document.documentElement).getPropertyValue('--brand') || '#6366f1';
            const activeStyle = `background:${brandColor};color:#fff;border-color:${brandColor};`;
            const inactiveStyle = 'background:#f1f5f9;color:#475569;border-color:#e2e8f0;';
            document.getElementById('btn-type-image').style.cssText = (!isVideo ? activeStyle : inactiveStyle);
            document.getElementById('btn-type-video').style.cssText = (isVideo ? activeStyle : inactiveStyle);
        }

        // YouTube preview on URL paste
        document.getElementById('video_url_input').addEventListener('input', function () {
            const url = this.value;
            let embedUrl = null;
            let ytId = null;
            const ytMatch = url.match(/youtube\.com\/watch\?v=([^&\s]+)/) || url.match(/youtu\.be\/([^?&\s]+)/);
            if (ytMatch) { ytId = ytMatch[1]; embedUrl = 'https://www.youtube.com/embed/' + ytId; }
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

        function previewImages(input) {
            const wrap = document.getElementById('multi-preview-wrap');
            wrap.innerHTML = '';
            if (!input.files.length) { wrap.style.display = 'none'; return; }
            wrap.style.display = 'flex';
            Array.from(input.files).forEach((file, i) => {
                const reader = new FileReader();
                reader.onload = e => {
                    const box = document.createElement('div');
                    box.style.cssText = 'text-align:center;';
                    box.innerHTML = `<img src="${e.target.result}" style="width:120px;height:90px;object-fit:cover;border-radius:8px;border:2px solid #e2e8f0;">
                        <div style="font-size:.72rem;color:#64748b;margin-top:.3rem;">${file.name}</div>`;
                    wrap.appendChild(box);
                };
                reader.readAsDataURL(file);
            });
        }
    </script>
@endsection