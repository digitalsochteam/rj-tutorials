@extends('backend.layouts.app')
@section('page-title', 'Edit Image')

@section('content')
    <div style="margin-bottom:1.75rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
        <div>
            <h2 style="font-size:1.3rem;font-weight:800;letter-spacing:-0.025em;">Edit Image</h2>
            <p style="font-size:0.875rem;color:#64748b;margin-top:0.2rem;">Update gallery image details.</p>
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
