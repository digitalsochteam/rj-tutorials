@extends('backend.layouts.app')

@section('page-title', 'Add Fee Entry')

@section('content')

    <div style="margin-bottom:1.75rem;display:flex;align-items:center;justify-content:space-between;">
        <div>
            <h2 style="font-size:1.3rem;font-weight:800;letter-spacing:-0.025em;">Add Fee Entry</h2>
            <p style="font-size:0.875rem;color:#64748b;margin-top:0.2rem;">Add a new row to the fees structure table.</p>
        </div>
        <a href="{{ route('dashboard', ['panel' => 'fees']) }}" class="btn-secondary">← Back to Fees</a>
    </div>

    @if($errors->any())
        <div class="alert-error">
            <strong>Please fix the following errors:</strong>
            <ul style="padding-left:1rem;margin-top:.3rem;">
                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('fees.store') }}">
        @csrf

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">Course & Type</div>
                <div class="form-card-sub">Entries with the same Course Name are grouped under one heading on the website.
                </div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="course_name">Course Name <span style="color:#dc2626;">*</span></label>
                        <input type="text" id="course_name" name="course_name" value="{{ old('course_name') }}"
                            placeholder="e.g. Physics, Mathematics, JEE Combo" required>
                        <small style="color:#94a3b8;font-size:.75rem;">This becomes the table heading on the
                            website.</small>
                    </div>
                    <div class="form-group">
                        <label for="type">Individual / Combo <span style="color:#dc2626;">*</span></label>
                        <input type="text" id="type" name="type" value="{{ old('type') }}"
                            placeholder="e.g. Individual, Combo, Group" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">Fee Amounts (₹)</div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="fees">Fees (₹)</label>
                        <input type="number" id="fees" name="fees" value="{{ old('fees') }}" placeholder="e.g. 10000"
                            min="0" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="discount">Discount (₹)</label>
                        <input type="number" id="discount" name="discount" value="{{ old('discount') }}"
                            placeholder="e.g. 1000" min="0" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="after_discount">After Discount (₹)</label>
                        <input type="number" id="after_discount" name="after_discount" value="{{ old('after_discount') }}"
                            placeholder="e.g. 9000" min="0" step="0.01">
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
                </div>
            </div>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:.75rem;">
            <a href="{{ route('dashboard', ['panel' => 'fees']) }}" class="btn-secondary">Cancel</a>
            <button type="submit" class="btn-primary">Add Fee Entry</button>
        </div>

    </form>

@endsection