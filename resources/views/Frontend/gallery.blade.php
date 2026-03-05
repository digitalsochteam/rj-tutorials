@extends('Frontend.layout.main')
@section('title', 'Gallery | RJ TUTORIALS')
@push('meta')
    <meta name="description" content="Browse photos from RJ Tutorials — classrooms, events, achievements and campus life.">
@endpush

@section('content')

    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg.jpg);">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Gallery</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>Gallery</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!-- Gallery Section Start -->
    <section class="gallery-page py-5" style="background:#f8f9fb;">
        <div class="container py-4">

            <!-- Section Title -->
            <div class="section-title text-center sec-title-animation animation-style1 mb-4">
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">Our Gallery</span>
                </div>
                <h2 class="section-title__title title-animation">Moments &amp; <span>Memories</span></h2>
            </div>

            <!-- Filter Tabs -->
            @php
                $categories = $images->pluck('category')->unique()->filter()->values();
            @endphp
            <div class="gallery-filters d-flex flex-wrap justify-content-center gap-2 mb-5">
                <button class="gallery-filter-btn active" data-filter="all">All</button>
                @foreach($categories as $cat)
                    <button class="gallery-filter-btn" data-filter="{{ Str::lower($cat) }}">{{ $cat }}</button>
                @endforeach
            </div>

            <!-- Gallery Grid -->
            <div class="gallery-grid row g-3" id="galleryGrid">

                @forelse($images as $image)
                    @if($image->isVideo())
                        {{-- Video card --}}
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 gallery-item"
                            data-category="{{ Str::lower($image->category) }}" data-type="video"
                            data-embed="{{ $image->embed_url }}" data-video-src="{{ $image->video_src }}"
                            data-title="{{ $image->title }}" data-cat="{{ $image->category }}">
                            <div class="gallery-card" onclick="openVideoLightbox(this)">
                                <img src="{{ $image->thumbnail }}" alt="{{ $image->title }}" class="gallery-card__img">
                                <div class="gallery-card__overlay">
                                    <div class="gallery-card__overlay-inner">
                                        <span class="gallery-card__zoom gallery-card__play"><i class="fas fa-play"></i></span>
                                        <div class="gallery-card__label">{{ $image->title }}</div>
                                        <div class="gallery-card__cat">{{ $image->category }}</div>
                                    </div>
                                </div>
                                <span class="gallery-video-badge"><i class="fas fa-play-circle"></i> Video</span>
                            </div>
                        </div>
                    @else
                        {{-- Image card --}}
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 gallery-item"
                            data-category="{{ Str::lower($image->category) }}" data-type="image">
                            <div class="gallery-card">
                                <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $image->title }}"
                                    class="gallery-card__img">
                                <div class="gallery-card__overlay">
                                    <div class="gallery-card__overlay-inner">
                                        <span class="gallery-card__zoom"><i class="fas fa-search-plus"></i></span>
                                        <div class="gallery-card__label">{{ $image->title }}</div>
                                        <div class="gallery-card__cat">{{ $image->category }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="col-12 text-center py-5">
                        <p style="color:#94a3b8;font-size:1rem;">No gallery images have been added yet.</p>
                    </div>
                @endforelse

                <!-- No Results Message (shown by JS when filter matches 0 items) -->
                <div class="col-12 text-center py-5 d-none" id="noResults">
                    <p style="color:#94a3b8;font-size:1rem;">No photos found in this category.</p>
                </div>

            </div>{{-- /gallery-grid --}}

        </div>
    </section>
    <!-- Gallery Section End -->

    <!-- ══ LIGHTBOX MODAL ══ -->
    <div id="galleryLightbox" class="gallery-lightbox" role="dialog" aria-modal="true" aria-label="Image viewer">
        <div class="gallery-lightbox__backdrop" onclick="closeLightbox()"></div>
        <div class="gallery-lightbox__box">

            <!-- Close -->
            <button class="gallery-lightbox__close" onclick="closeLightbox()" title="Close">
                <i class="fas fa-times"></i>
            </button>

            <!-- Prev -->
            <button class="gallery-lightbox__nav gallery-lightbox__nav--prev" id="lbPrev" onclick="shiftLightbox(-1)"
                title="Previous">
                <i class="fas fa-chevron-left"></i>
            </button>

            <!-- Image -->
            <div class="gallery-lightbox__img-wrap" id="lb-img-wrap">
                <img id="lbImage" src="" alt="" class="gallery-lightbox__img">
            </div>

            <!-- Video iframe (YouTube/Vimeo) -->
            <div class="gallery-lightbox__video-wrap" id="lb-video-wrap" style="display:none;">
                <iframe id="lbIframe" src="" frameborder="0" allowfullscreen allow="autoplay; encrypted-media"
                    style="width:80vw;max-width:900px;height:50.625vw;max-height:506px;border-radius:12px;"></iframe>
            </div>

            <!-- Local video (HTML5) -->
            <div id="lb-local-video-wrap" style="display:none;">
                <video id="lbLocalVideo" controls autoplay
                    style="width:80vw;max-width:900px;max-height:68vh;border-radius:12px;background:#000;"></video>
            </div>
        </div>

        <!-- Next -->
        <button class="gallery-lightbox__nav gallery-lightbox__nav--next" id="lbNext" onclick="shiftLightbox(1)"
            title="Next">
            <i class="fas fa-chevron-right"></i>
        </button>

        <!-- Caption -->
        <div class="gallery-lightbox__caption">
            <div id="lbTitle" class="gallery-lightbox__caption-title"></div>
            <div id="lbCat" class="gallery-lightbox__caption-cat"></div>
            <div id="lbCounter" class="gallery-lightbox__caption-counter"></div>
        </div>

    </div>
    <!-- /Lightbox -->

    <style>
        /* ── Video badge ── */
        .gallery-video-badge {
            position: absolute;
            top: 8px;
            left: 8px;
            background: rgba(0, 0, 0, .65);
            color: #fff;
            font-size: .68rem;
            font-weight: 700;
            padding: .2rem .55rem;
            border-radius: 20px;
            pointer-events: none;
            backdrop-filter: blur(4px);
        }

        /* ── Gallery filter buttons ── */
        .gallery-filter-btn {
            padding: .45rem 1.3rem;
            border: 2px solid #e2e8f0;
            border-radius: 30px;
            background: #fff;
            color: #475569;
            font-size: .82rem;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all .25s ease;
        }

        .gallery-filter-btn:hover,
        .gallery-filter-btn.active {
            background: var(--thm-base, #e8232a);
            border-color: var(--thm-base, #e8232a);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(232, 35, 42, .22);
        }

        /* ── Gallery card ── */
        .gallery-card {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            background: #000;
            box-shadow: 0 4px 18px rgba(0, 0, 0, .09);
            transition: transform .3s ease, box-shadow .3s ease;
        }

        .gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, .16);
        }

        .gallery-card__img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
            transition: transform .4s ease, opacity .35s ease;
        }

        .gallery-card:hover .gallery-card__img {
            transform: scale(1.08);
            opacity: .55;
        }

        .gallery-card__overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: flex-end;
            padding: 1rem;
            background: linear-gradient(to top, rgba(20, 20, 40, .82) 0%, transparent 55%);
            opacity: 0;
            transition: opacity .35s ease;
        }

        .gallery-card:hover .gallery-card__overlay {
            opacity: 1;
        }

        .gallery-card__overlay-inner {
            width: 100%;
        }

        .gallery-card__zoom {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(.5);
            width: 48px;
            height: 48px;
            background: var(--thm-base, #e8232a);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.1rem;
            opacity: 0;
            transition: transform .35s cubic-bezier(.34, 1.56, .64, 1), opacity .3s ease;
        }

        .gallery-card:hover .gallery-card__zoom {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
        }

        .gallery-card__label {
            font-size: .875rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.3;
        }

        .gallery-card__cat {
            font-size: .72rem;
            color: var(--thm-base, #e8232a);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-top: .2rem;
        }

        /* ── Filter animation ── */
        .gallery-item {
            transition: opacity .35s ease, transform .35s ease;
        }

        .gallery-item.hidden {
            opacity: 0;
            transform: scale(.92);
            pointer-events: none;
            position: absolute;
            visibility: hidden;
        }

        /* ── Lightbox ── */
        .gallery-lightbox {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity .3s ease;
        }

        .gallery-lightbox.open {
            opacity: 1;
            pointer-events: all;
        }

        .gallery-lightbox__backdrop {
            position: absolute;
            inset: 0;
            background: rgba(5, 5, 15, .92);
            backdrop-filter: blur(6px);
        }

        .gallery-lightbox__box {
            position: relative;
            z-index: 1;
            max-width: 88vw;
            max-height: 88vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            transform: scale(.85);
            transition: transform .35s cubic-bezier(.34, 1.2, .64, 1);
        }

        .gallery-lightbox.open .gallery-lightbox__box {
            transform: scale(1);
        }

        .gallery-lightbox__img-wrap {
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 24px 80px rgba(0, 0, 0, .6);
            line-height: 0;
        }

        .gallery-lightbox__img {
            display: block;
            max-width: 82vw;
            max-height: 68vh;
            width: auto;
            height: auto;
            object-fit: contain;
            border-radius: 14px;
            transition: opacity .25s ease;
        }

        .gallery-lightbox__img.fading {
            opacity: 0;
        }

        /* Close button */
        .gallery-lightbox__close {
            position: absolute;
            top: -44px;
            right: 0;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .15);
            border: 1.5px solid rgba(255, 255, 255, .3);
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .2s;
        }

        .gallery-lightbox__close:hover {
            background: var(--thm-base, #e8232a);
            border-color: transparent;
        }

        /* Nav arrows */
        .gallery-lightbox__nav {
            position: fixed;
            top: 50%;
            transform: translateY(-50%);
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .12);
            border: 1.5px solid rgba(255, 255, 255, .25);
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .2s, transform .2s;
            z-index: 2;
        }

        .gallery-lightbox__nav:hover {
            background: var(--thm-base, #e8232a);
            border-color: transparent;
        }

        .gallery-lightbox__nav--prev {
            left: clamp(10px, 3vw, 40px);
        }

        .gallery-lightbox__nav--next {
            right: clamp(10px, 3vw, 40px);
        }

        .gallery-lightbox__nav:hover {
            transform: translateY(-50%) scale(1.1);
        }

        .gallery-lightbox__nav:disabled {
            opacity: .3;
            cursor: default;
        }

        .gallery-lightbox__nav:disabled:hover {
            background: rgba(255, 255, 255, .12);
            border-color: rgba(255, 255, 255, .25);
            transform: translateY(-50%) scale(1);
        }

        /* Caption */
        .gallery-lightbox__caption {
            text-align: center;
            padding: .9rem .5rem 0;
        }

        .gallery-lightbox__caption-title {
            font-size: 1rem;
            font-weight: 700;
            color: #f1f5f9;
        }

        .gallery-lightbox__caption-cat {
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: var(--thm-base, #e8232a);
            margin-top: .2rem;
        }

        .gallery-lightbox__caption-counter {
            font-size: .72rem;
            color: rgba(255, 255, 255, .4);
            margin-top: .3rem;
        }

        @media (max-width: 576px) {
            .gallery-card__img {
                height: 180px;
            }

            .gallery-lightbox__img {
                max-width: 95vw;
                max-height: 55vh;
            }

            .gallery-lightbox__nav--prev {
                left: 6px;
            }

            .gallery-lightbox__nav--next {
                right: 6px;
            }

            .gallery-lightbox__nav {
                width: 38px;
                height: 38px;
                font-size: .85rem;
            }
        }
    </style>

    <script>
        /* ─── Video lightbox ─── */
        function openVideoLightbox(cardEl) {
            const item = cardEl.closest('.gallery-item');
            const videoSrc = item.dataset.videoSrc;
            const embed = item.dataset.embed;
            const title = item.dataset.title;
            const cat = item.dataset.cat;

            document.getElementById('lb-img-wrap').style.display = 'none';
            document.getElementById('lb-video-wrap').style.display = 'none';
            document.getElementById('lb-local-video-wrap').style.display = 'none';
            document.getElementById('lbPrev').style.display = 'none';
            document.getElementById('lbNext').style.display = 'none';

            if (videoSrc) {
                const vid = document.getElementById('lbLocalVideo');
                vid.src = videoSrc;
                document.getElementById('lb-local-video-wrap').style.display = '';
            } else {
                document.getElementById('lbIframe').src = embed || '';
                document.getElementById('lb-video-wrap').style.display = '';
            }

            document.getElementById('lbTitle').textContent = title || '';
            document.getElementById('lbCat').textContent = cat || '';
            document.getElementById('lbCounter').textContent = '';
            document.getElementById('galleryLightbox').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        /* ─── Gallery data built from DOM ─── */
        const galleryItems = [];

        function buildGalleryData() {
            document.querySelectorAll('.gallery-item[data-type="image"]:not(.d-none)').forEach(el => {
                const img = el.querySelector('.gallery-card__img');
                const label = el.querySelector('.gallery-card__label');
                const cat = el.querySelector('.gallery-card__cat');
                galleryItems.push({
                    src: img ? img.src : '',
                    alt: img ? img.alt : '',
                    label: label ? label.textContent : '',
                    cat: cat ? cat.textContent : '',
                });
                const idx = galleryItems.length - 1;
                el.querySelector('.gallery-card').setAttribute('onclick', `openLightbox(${idx})`);
            });
        }

        /* ─── Filter ─── */
        document.querySelectorAll('.gallery-filter-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.gallery-filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filter = this.dataset.filter;
                let visible = 0;
                document.querySelectorAll('.gallery-item').forEach(item => {
                    const match = filter === 'all' || item.dataset.category === filter;
                    item.classList.toggle('hidden', !match);
                    if (match) visible++;
                });
                document.getElementById('noResults').classList.toggle('d-none', visible > 0);
            });
        });

        /* ─── Lightbox ─── */
        let lbIndex = 0;
        const lightbox = document.getElementById('galleryLightbox');
        const lbImg = document.getElementById('lbImage');

        function getVisibleItems() {
            return [...document.querySelectorAll('.gallery-item[data-type="image"]:not(.hidden):not(.d-none)')];
        }

        function openLightbox(index) {
            const items = getVisibleItems();
            if (!items[index]) return;
            lbIndex = index;
            // Ensure image wrap is visible (may have been hidden by a previous video)
            document.getElementById('lb-img-wrap').style.display = '';
            document.getElementById('lb-video-wrap').style.display = 'none';
            document.getElementById('lb-local-video-wrap').style.display = 'none';
            document.getElementById('lbPrev').style.display = '';
            document.getElementById('lbNext').style.display = '';
            updateLightbox(items);
            lightbox.classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            lightbox.classList.remove('open');
            document.body.style.overflow = '';
            // Stop all video on close
            document.getElementById('lbIframe').src = '';
            const localVid = document.getElementById('lbLocalVideo');
            localVid.pause(); localVid.src = '';
            document.getElementById('lb-img-wrap').style.display = '';
            document.getElementById('lb-video-wrap').style.display = 'none';
            document.getElementById('lb-local-video-wrap').style.display = 'none';
        }

        function shiftLightbox(dir) {
                const items = getVisibleItems();
                const next = lbIndex + dir;
                if (next < 0 || next >= items.length) return;
                lbIndex = next;
                lbImg.classList.add('fading');
                setTimeout(() => {
                    updateLightbox(items);
                    lbImg.classList.remove('fading');
                }, 220);
            }

            function updateLightbox(items) {
                const el = items[lbIndex];
                const img = el.querySelector('.gallery-card__img');
                const label = el.querySelector('.gallery-card__label');
                const cat = el.querySelector('.gallery-card__cat');

                lbImg.src = img ? img.src : '';
                lbImg.alt = img ? img.alt : '';
                document.getElementById('lbTitle').textContent = label ? label.textContent : '';
                document.getElementById('lbCat').textContent = cat ? cat.textContent : '';
                document.getElementById('lbCounter').textContent = (lbIndex + 1) + ' / ' + items.length;

                document.getElementById('lbPrev').disabled = lbIndex === 0;
                document.getElementById('lbNext').disabled = lbIndex === items.length - 1;
            }

            /* ─── Keyboard navigation ─── */
            document.addEventListener('keydown', e => {
                if (!lightbox.classList.contains('open')) return;
                if (e.key === 'ArrowLeft') shiftLightbox(-1);
                if (e.key === 'ArrowRight') shiftLightbox(1);
                if (e.key === 'Escape') closeLightbox();
            });

            /* Re-index onclick after filter already ran once on load */
            document.addEventListener('DOMContentLoaded', () => {
                getVisibleItems().forEach((el, i) => {
                    el.querySelector('.gallery-card').setAttribute('onclick', `openLightbox(${i})`);
                });
                /* Also re-index when filter changes */
                document.querySelectorAll('.gallery-filter-btn').forEach(btn => {
                    btn.addEventListener('click', () => {
                        setTimeout(() => {
                            getVisibleItems().forEach((el, i) => {
                                el.querySelector('.gallery-card').setAttribute('onclick', `openLightbox(${i})`);
                            });
                        }, 50);
                    });
                });
            });
    </script>

@endsection