@extends('backend.layouts.app')
@section('page-title', $gallery->isVideo() ? 'Edit Video' : 'Edit Image')

@section('content')
    <div style="margin-bottom:1.75rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
        <div>
            <h2 style="font-size:1.3rem;font-weight:800;letter-spacing:-0.025em;" id="page-heading">
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

    @php
        $currentVSrc = old('video_source', $gallery->video_file ? 'file' : 'url');
    @endphp

    <form method="POST" action="{{ route('gallery.update', $gallery) }}" enctype="multipart/form-data" id="gallery-form">
        @csrf
        @method('PUT')
        <input type="hidden" name="media_type"   id="media_type_input"   value="{{ old('media_type', $gallery->media_type ?? 'image') }}">
        <input type="hidden" name="video_source" id="video_source_input" value="{{ $currentVSrc }}">

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

                    {{-- Video source sub-toggle --}}
                    <div id="video-source-toggle" style="display:none;margin-left:.5rem;border-left:2px solid #e2e8f0;padding-left:.75rem;display:flex;gap:.4rem;align-items:center;">
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
                <div class="form-card-title">Details</div>
                <div class="form-card-sub">Title and category.</div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group full">
                        <label>Title <span style="color:#dc2626;">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $gallery->title) }}"
                            placeholder="e.g. Annual Day 2025" required>
                    </div>
                    <div class="form-group full">
                        <label>Category <span style="color:#dc2626;">*</span></label>
                        @php
                            $cats = ['Student Achievement','General','Events','Classroom','Campus','Competitions','Annual Day'];
                            $oldCat = old('category', $gallery->category);
                        @endphp
                        <select name="category" id="category-select" required
                            onchange="toggleCustomCategory(this)"
                            style="width:100%;padding:.55rem .75rem;border:1.5px solid #e2e8f0;border-radius:8px;font-size:.875rem;background:#fff;color:#1e293b;">
                            @foreach($cats as $cat)
                                <option value="{{ $cat }}" {{ $oldCat === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                            <option value="__other__" {{ !in_array($oldCat, $cats) ? 'selected' : '' }}>Other (custom)…</option>
                        </select>
                        <input type="text" name="category_custom" id="category-custom"
                            value="{{ !in_array($oldCat, $cats) ? $oldCat : '' }}"
                            placeholder="Type custom category name"
                            style="margin-top:.5rem;width:100%;padding:.55rem .75rem;border:1.5px solid #e2e8f0;border-radius:8px;font-size:.875rem;{{ in_array($oldCat, $cats) ? 'display:none;' : '' }}">
                    </div>
                    <div class="form-group" style="display:flex;align-items:center;gap:.75rem;padding-top:1rem;">
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
                <div class="form-card-sub">Leave blank to keep the current photo.</div>
            </div>
            <div class="form-body">
                <div class="form-group">
                    <label>Upload New Image</label>
                    <input type="file" name="image" id="image-input" accept="image/*"
                        onchange="previewFile(this,'prev_image','img_preview_wrap','img')">
                    <div class="img-preview" id="img_preview_wrap">
                        @if($gallery->image)
                            <img id="prev_image" src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}">
                            <span>Current image</span>
                        @else
                            <img id="prev_image" src="" alt="Preview" style="display:none;">
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- VIDEO — Upload File --}}
        <div class="form-card" id="section-video-file">
            <div class="form-card-header">
                <div class="form-card-title">Video File</div>
                <div class="form-card-sub">Leave blank to keep the current video. MP4, WebM, MOV. Max 100 MB.</div>
            </div>
            <div class="form-body">
                <div class="form-group">
                    @if($gallery->video_file)
                        <label>Current Video</label>
                        <video src="{{ asset('storage/' . $gallery->video_file) }}" controls
                            style="width:100%;max-width:480px;border-radius:10px;background:#000;margin-bottom:.75rem;display:block;"></video>
                    @endif
                    <label>{{ $gallery->video_file ? 'Replace Video' : 'Select Video' }}</label>
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
        <div class="form-card" id="section-video-url">
            <div class="form-card-header">
                <div class="form-card-title">Video URL</div>
                <div class="form-card-sub">YouTube or Vimeo link.</div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group full">
                        <label>YouTube / Vimeo URL</label>
                        <input type="url" name="video_url" id="video_url_input"
                            value="{{ old('video_url', $gallery->video_url) }}"
                            placeholder="https://www.youtube.com/watch?v=...">
                        <small style="color:#94a3b8;margin-top:.3rem;display:block;">
                            Supports: youtube.com/watch?v=ID &nbsp;|&nbsp; youtu.be/ID &nbsp;|&nbsp; vimeo.com/ID
                        </small>
                    </div>
                    <div class="form-group full" id="yt-preview-wrap"
                         style="{{ ($gallery->video_url && !$gallery->video_file) ? '' : 'display:none;' }}">
                        <label>Current Preview</label>
                        <div style="position:relative;padding-bottom:56.25%;height:0;border-radius:10px;overflow:hidden;background:#000;">
                            <iframe id="yt-preview-iframe" src="{{ $gallery->embed_url ?? '' }}"
                                frameborder="0" allowfullscreen
                                style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>
                        </div>
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
        function toggleCustomCategory(sel) {
            const custom = document.getElementById('category-custom');
            if (sel.value === '__other__') {
                custom.style.display = '';
                custom.required = true;
            } else {
                custom.style.display = 'none';
                custom.required = false;
                custom.value = '';
            }
        }

        const initialType = '{{ old('media_type', $gallery->media_type ?? 'image') }}';
        const initialVSrc = '{{ $currentVSrc }}';
        setMediaType(initialType, initialVSrc);

        function setMediaType(type, vSrc) {
            vSrc = vSrc || document.getElementById('video_source_input').value || 'file';
            const isVideo = type === 'video';
            document.getElementById('media_type_input').value = type;

            document.getElementById('section-image').style.display      = (!isVideo) ? '' : 'none';
            document.getElementById('section-video-file').style.display = (isVideo && vSrc === 'file') ? '' : 'none';
            document.getElementById('section-video-url').style.display  = (isVideo && vSrc === 'url')  ? '' : 'none';

            const vsToggle = document.getElementById('video-source-toggle');
            vsToggle.style.display = isVideo ? 'flex' : 'none';

            const vuInput = document.getElementById('video_url_input');
            if (vuInput) vuInput.required = (isVideo && vSrc === 'url');

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
            const active   = `background:${brand};color:#fff;border-color:${brand};`;
            const inactive = 'background:#f1f5f9;color:#475569;border-color:#e2e8f0;';
            document.getElementById('btn-vsrc-file').style.cssText = src === 'file' ? active : inactive;
            document.getElementById('btn-vsrc-url').style.cssText  = src === 'url'  ? active : inactive;
        }

        document.getElementById('video_url_input').addEventListener('input', function () {
            const url = this.value;
            let embed = null;
            const yt = url.match(/youtube\.com\/watch\?v=([^&\s]+)/) || url.match(/youtu\.be\/([^?&\s]+)/);
            if (yt) embed = 'https://www.youtube.com/embed/' + yt[1];
            const vim = url.match(/vimeo\.com\/(\d+)/);
            if (vim) embed = 'https://player.vimeo.com/video/' + vim[1];
            const wrap = document.getElementById('yt-preview-wrap');
            if (embed) { document.getElementById('yt-preview-iframe').src = embed; wrap.style.display = ''; }
            else        { document.getElementById('yt-preview-iframe').src = '';    wrap.style.display = 'none'; }
        });

        function previewFile(input, previewId, wrapId, kind) {
            if (!input.files[0]) return;
            if (kind === 'video') {
                document.getElementById(previewId).src = URL.createObjectURL(input.files[0]);
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
