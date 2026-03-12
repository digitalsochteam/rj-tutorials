@extends('backend.layouts.app')

@section('page-title', 'About Us')

@section('content')

    <div style="margin-bottom:1.75rem;">
        <h2 style="font-size:1.3rem;font-weight:800;letter-spacing:-0.025em;">About Us Content</h2>
        <p style="font-size:0.875rem;color:#64748b;margin-top:0.2rem;">
            Edit the text, stats and images shown in the About Us section of your homepage.
        </p>
    </div>

    @if(session('success'))
        <div class="alert-success">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            <strong>Please fix the following errors:</strong>
            <ul style="padding-left:1rem;margin-top:.3rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('about-us.update') }}" enctype="multipart/form-data">
        @csrf

        {{-- Text Content --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">Text Content</div>
                <div class="form-card-sub">Edit the About Us tagline, heading and paragraphs shown on the homepage.</div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="tagline">Tagline</label>
                        <input type="text" id="tagline" name="tagline" value="{{ old('tagline', $about->tagline) }}"
                            placeholder="About Us">
                    </div>
                    <div class="form-group full">
                        <label for="title">Section Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $about->title) }}"
                            placeholder="Section heading">
                    </div>
                    <div class="form-group full">
                        <label for="paragraph_1">Paragraph 1</label>
                        <textarea id="paragraph_1" name="paragraph_1" rows="4"
                            class="wysiwyg">{!! old('paragraph_1', $about->paragraph_1) !!}</textarea>
                    </div>
                    <div class="form-group full">
                        <label for="paragraph_2">Paragraph 2</label>
                        <textarea id="paragraph_2" name="paragraph_2" rows="4"
                            class="wysiwyg">{!! old('paragraph_2', $about->paragraph_2) !!}</textarea>
                    </div>
                    <div class="form-group full">
                        <label for="paragraph_3">Paragraph 3</label>
                        <textarea id="paragraph_3" name="paragraph_3" rows="5"
                            class="wysiwyg">{!! old('paragraph_3', $about->paragraph_3) !!}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Stats --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">Stats</div>
                <div class="form-card-sub">Numbers shown on the About Us section.</div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="years_experience">Years of Experience</label>
                        <input type="number" id="years_experience" name="years_experience" min="0"
                            value="{{ old('years_experience', $about->years_experience) }}">
                    </div>
                    <div class="form-group">
                        <label for="students_count">Satisfied Students (K)</label>
                        <input type="number" id="students_count" name="students_count" min="0"
                            value="{{ old('students_count', $about->students_count) }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- Images --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">Images</div>
                <div class="form-card-sub">Upload images for the About Us section. Leave blank to keep the current image.
                </div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="main_image">Main Image</label>
                        <input type="file" id="main_image" name="main_image" accept="image/*"
                            onchange="previewImage(this,'prev_main')">
                        <div class="img-preview">
                            <img id="prev_main"
                                src="{{ $about->main_image ? asset('storage/' . $about->main_image) : asset('assets/images/resources/about-one-img-1.jpg') }}"
                                alt="Main Image">
                            <span>Current main image</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="secondary_image">Secondary Image</label>
                        <input type="file" id="secondary_image" name="secondary_image" accept="image/*"
                            onchange="previewImage(this,'prev_secondary')">
                        <div class="img-preview">
                            <img id="prev_secondary"
                                src="{{ $about->secondary_image ? asset('storage/' . $about->secondary_image) : asset('assets/images/resources/about-one-img-2.jpg') }}"
                                alt="Secondary Image">
                            <span>Current secondary image</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SEO --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">SEO / Meta Tags</div>
                <div class="form-card-sub">Control how the About Us page appears in search engines. Leave blank to use sensible defaults.</div>
            </div>
            <div class="form-body">
                <div class="form-grid">
                    <div class="form-group full">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" id="meta_title" name="meta_title"
                            value="{{ old('meta_title', $about->meta_title) }}"
                            placeholder="e.g. About RJ Tutorials | Expert Coaching Since 2000">
                    </div>
                    <div class="form-group full">
                        <label for="meta_description">Meta Description</label>
                        <textarea id="meta_description" name="meta_description" rows="3"
                            placeholder="Brief description shown in Google search results...">{{ old('meta_description', $about->meta_description) }}</textarea>
                    </div>
                    <div class="form-group full">
                        <label for="meta_keywords">Meta Keywords <small style="color:#94a3b8;">(comma-separated)</small></label>
                        <input type="text" id="meta_keywords" name="meta_keywords"
                            value="{{ old('meta_keywords', $about->meta_keywords) }}"
                            placeholder="about us, RJ tutorials, coaching institute, science coaching">
                    </div>
                </div>
            </div>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:.75rem;">
            <a href="{{ route('dashboard') }}" class="btn-secondary">← Back to Dashboard</a>
            <button type="submit" class="btn-primary">Save Changes</button>
        </div>

    </form>

@endsection

@push('scripts')
    <script>
        function previewImage(input, previewId) {
            const reader = new FileReader();
            reader.onload = e => { document.getElementById(previewId).src = e.target.result; };
            if (input.files[0]) reader.readAsDataURL(input.files[0]);
        }

        function countChars(el, counterId, warn) {
            const len = el.value.length;
            const counter = document.getElementById(counterId);
            if (!counter) return;
            counter.textContent = len + ' / ' + warn;
            counter.style.color = len > warn ? '#ef4444' : '#94a3b8';
        }
    </script>
@endpush