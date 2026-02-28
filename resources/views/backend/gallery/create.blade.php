@extends('backend.layouts.app')
@section('page-title', 'Upload Image')

@section('content')
    <div
        style="margin-bottom:1.75rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
        <div>
            <h2 style="font-size:1.3rem;font-weight:800;letter-spacing:-0.025em;">Upload Image</h2>
            <p style="font-size:0.875rem;color:#64748b;margin-top:0.2rem;">Add a new photo to the gallery.</p>
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

    <form method="POST" action="{{ route('gallery.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">Image Details</div>
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

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">Photo <span style="color:#dc2626;">*</span></div>
                <div class="form-card-sub">Recommended: 800×600px. Max 3 MB.</div>
            </div>
            <div class="form-body">
                <div class="form-group">
                    <label>Upload Image</label>
                    <input type="file" name="image" accept="image/*" required
                        onchange="previewImage(this,'prev_image','img_preview_wrap')">
                    <div class="img-preview" id="img_preview_wrap" style="display:none;">
                        <img id="prev_image" src="" alt="Preview">
                        <span>Preview</span>
                    </div>
                </div>
            </div>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:.75rem;">
            <a href="{{ route('dashboard', ['panel' => 'gallery']) }}" class="btn-secondary"
                style="text-decoration:none;">Cancel</a>
            <button type="submit" class="btn-primary">Upload Image</button>
        </div>
    </form>

    <script>
        function previewImage(input, previewId, wrapId) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById(previewId).src = e.target.result;
                document.getElementById(wrapId).style.display = 'flex';
            };
            if (input.files[0]) reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection