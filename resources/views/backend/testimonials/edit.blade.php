@extends('backend.layouts.app')

@section('page-title', 'Edit Testimonial')

@section('content')

    <div style="margin-bottom:1.75rem;display:flex;align-items:center;justify-content:space-between;">
        <div>
            <h2 style="font-size:1.3rem;font-weight:800;letter-spacing:-0.025em;">Edit Testimonial</h2>
            <p style="font-size:0.875rem;color:#64748b;margin-top:0.2rem;">Update the testimonial from
                {{ $testimonial->name }}.</p>
        </div>
        <a href="{{ route('dashboard', ['panel' => 'testimonials']) }}" class="btn-secondary">← Back to Testimonials</a>
    </div>

    @if($errors->any())
        <div class="alert-error">
            <strong>Please fix the following errors:</strong>
            <ul style="padding-left:1rem;margin-top:.3rem;">
                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('testimonials.update', $testimonial) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">Reviewer Details</div>
                <div class="form-card-sub">Name, designation and photo of the person giving the review.</div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">Full Name <span style="color:#dc2626;">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $testimonial->name) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="designation">Designation / Label</label>
                        <input type="text" id="designation" name="designation"
                            value="{{ old('designation', $testimonial->designation) }}" placeholder="e.g. Our Students">
                    </div>
                    <div class="form-group">
                        <label for="rating">Star Rating</label>
                        <select id="rating" name="rating"
                            style="width:100%;padding:.55rem .75rem;border:1px solid var(--border);border-radius:9px;font-size:.875rem;background:var(--white);color:var(--text);">
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>
                                    {{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sort_order">Sort Order</label>
                        <input type="number" id="sort_order" name="sort_order"
                            value="{{ old('sort_order', $testimonial->sort_order) }}" min="0">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <label
                            style="display:flex;align-items:center;gap:.5rem;font-size:.875rem;text-transform:none;letter-spacing:0;font-weight:500;color:var(--text);margin-top:.2rem;">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                            Show on website
                        </label>
                    </div>
                    <div class="form-group full">
                        <label for="photo">Photo <small style="color:#94a3b8;">(leave blank to keep current)</small></label>
                        @if($testimonial->photo)
                            <div style="margin-bottom:.75rem;display:flex;align-items:center;gap:.75rem;">
                                <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}"
                                    style="width:56px;height:56px;object-fit:cover;border-radius:50%;border:2px solid var(--border);">
                                <span style="font-size:.8rem;color:#64748b;">Current photo</span>
                            </div>
                        @endif
                        <input type="file" id="photo" name="photo" accept="image/*"
                            onchange="previewImg(this,'prev_photo')">
                        <div class="img-preview" id="preview_box" style="display:none;">
                            <img id="prev_photo" src="" alt="Preview">
                            <span>New Preview</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">Review Message</div>
                <div class="form-card-sub">The testimonial text shown on the website.</div>
            </div>
            <div class="form-body">
                <div class="form-group full">
                    <label for="message">Message <span style="color:#dc2626;">*</span></label>
                    <textarea id="message" name="message" rows="5">{{ old('message', $testimonial->message) }}</textarea>
                </div>
            </div>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:.75rem;">
            <a href="{{ route('dashboard', ['panel' => 'testimonials']) }}" class="btn-secondary">Cancel</a>
            <button type="submit" class="btn-primary">Update Testimonial</button>
        </div>

    </form>

@endsection

@push('scripts')
    <script>
        function previewImg(input, id) {
            const r = new FileReader();
            r.onload = e => {
                document.getElementById(id).src = e.target.result;
                document.getElementById('preview_box').style.display = 'flex';
            };
            if (input.files[0]) r.readAsDataURL(input.files[0]);
        }
    </script>
@endpush