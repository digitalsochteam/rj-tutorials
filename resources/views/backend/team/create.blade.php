@extends('backend.layouts.app')

@section('page-title', 'Add Team Member')

@section('content')

    <div style="margin-bottom:1.75rem;display:flex;align-items:center;justify-content:space-between;">
        <div>
            <h2 style="font-size:1.3rem;font-weight:800;letter-spacing:-0.025em;">Add Team Member</h2>
            <p style="font-size:0.875rem;color:#64748b;margin-top:0.2rem;">Add a new member to the team section.</p>
        </div>
        <a href="{{ route('dashboard', ['panel' => 'team']) }}" class="btn-secondary">← Back to Team</a>
    </div>

    @if($errors->any())
        <div class="alert-error">
            <strong>Please fix the following errors:</strong>
            <ul style="padding-left:1rem;margin-top:.3rem;">
                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('team.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">Member Details</div>
                <div class="form-card-sub">Fill in the team member's name, role and photo.</div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Dr. John Smith"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="designation">Designation / Role</label>
                        <input type="text" id="designation" name="designation" value="{{ old('designation') }}"
                            placeholder="e.g. Founder" required>
                    </div>
                    <div class="form-group">
                        <label for="sort_order">Sort Order</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <label
                            style="display:flex;align-items:center;gap:.5rem;font-size:.875rem;text-transform:none;letter-spacing:0;font-weight:500;color:var(--text);margin-top:.2rem;">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                            Show on website
                        </label>
                    </div>
                    <div class="form-group full">
                        <label for="photo">Photo</label>
                        <input type="file" id="photo" name="photo" accept="image/*"
                            onchange="previewImg(this,'prev_photo')">
                        <div class="img-preview" id="preview_box" style="display:none;">
                            <img id="prev_photo" src="" alt="Preview">
                            <span>Preview</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:.75rem;">
            <a href="{{ route('dashboard', ['panel' => 'team']) }}" class="btn-secondary">Cancel</a>
            <button type="submit" class="btn-primary">Add Member</button>
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