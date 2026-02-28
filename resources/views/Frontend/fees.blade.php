@extends('Frontend.layout.main')
@section('content')

    {{-- Page Header --}}
    <section class="page-header">
        <div class="page-header__bg"
            style="background-image: url({{ asset('assets/images/backgrounds/page-header-bg.jpg') }});">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <h3>Fees Structure</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span class="icon-arrow-angle-pointing-to-right"></span></li>
                        <li>Fees Structure</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Fees Section --}}
    <section style="linear-gradient(90deg, #66003b, #66003b);margin-top:60px;margin-bottom:80px;">
        <div class="container">

            {{-- Section Heading --}}
            <div class="section-title text-center sec-title-animation animation-style1" style="margin-bottom:50px;">
                <div class="section-title__tagline-box">
                    <span class="section-title__tagline">Transparent Pricing</span>
                </div>
                <h2 class="section-title__title title-animation">Our <span>Fees Structure</span></h2>
            </div>

            {{-- Optional intro notes --}}
            @if($feesContent->intro_content)
                <div
                    style="background:#fff;border-radius:12px;padding:24px 28px;margin-bottom:40px;
                                                                                                                    box-shadow:0 2px 12px rgba(0,0,0,.06);color:#475569;line-height:1.8;font-size:.97rem;">
                    {!! $feesContent->intro_content !!}
                </div>
            @endif

            {{-- Fee Tables grouped by course --}}
            @forelse($feeGroups as $courseName => $entries)
                <div class="wow fadeInUp" data-wow-delay="{{ ($loop->index % 3) * 100 }}ms" style="margin-bottom:40px;">

                    {{-- Course Heading --}}
                    <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
                        <div
                            style="width:4px;height:36px;background:linear-gradient(180deg,#ff6700,#ff9248);border-radius:4px;flex-shrink:0;">
                        </div>
                        <h4 style="margin:0;font-size:1.2rem;font-weight:800;color:#1e293b;letter-spacing:-.01em;">
                            {{ $courseName }}
                        </h4>
                    </div>

                    {{-- Responsive table --}}
                    <div
                        style="overflow-x:auto;-webkit-overflow-scrolling:touch;border-radius:14px;
                                                                                                                        box-shadow:0 4px 20px rgba(0,0,0,.08);">
                        <table style="width:100%;min-width:480px;border-collapse:collapse;background:#fff;font-size:.9rem;">
                            <thead>
                                <tr style="background:linear-gradient(90deg, #66003b, #66003b);">
                                    <th
                                        style="padding:15px 20px;text-align:left;font-weight:700;color:#fff;font-size:.82rem;text-transform:uppercase;letter-spacing:.04em;">
                                        Individual / Combo
                                    </th>
                                    <th
                                        style="padding:15px 20px;text-align:center;font-weight:700;color:#fff;font-size:.82rem;text-transform:uppercase;letter-spacing:.04em;">
                                        Fees (Rs.)
                                    </th>
                                    <th
                                        style="padding:15px 20px;text-align:center;font-weight:700;color:#fff;font-size:.82rem;text-transform:uppercase;letter-spacing:.04em;">
                                        Discount (Rs.)
                                    </th>
                                    <th
                                        style="padding:15px 20px;text-align:center;font-weight:700;color:#fff;font-size:.82rem;text-transform:uppercase;letter-spacing:.04em;">
                                        After Discount (Rs.)
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($entries as $fee)
                                    <tr style="border-bottom:1px solid #f1f5f9;{{ $loop->even ? 'background:#fafafa;' : 'background:#fff;' }}"
                                        onmouseover="this.style.background='#fff7f0'"
                                        onmouseout="this.style.background='{{ $loop->even ? '#fafafa' : '#fff' }}'">

                                        <td style="padding:15px 20px;font-weight:600;color:#1e293b;">
                                            <span style="display:inline-flex;align-items:center;gap:7px;">
                                                <span
                                                    style="display:inline-block;width:8px;height:8px;border-radius:50%;
                                                                                                                                                                                        background:{{ str_contains(strtolower($fee->type), 'combo') ? '#ff6700' : '#0369a1' }};"></span>
                                                {{ $fee->type }}
                                            </span>
                                        </td>

                                        <td style="padding:15px 20px;text-align:center;color:#64748b;">
                                            @if($fee->fees)
                                                <span
                                                    style="text-decoration:{{ $fee->discount ? 'line-through' : 'none' }};opacity:{{ $fee->discount ? '.5' : '1' }};">
                                                    Rs. {{ number_format($fee->fees, 0) }}
                                                </span>
                                            @else
                                                &mdash;
                                            @endif
                                        </td>

                                        <td style="padding:15px 20px;text-align:center;">
                                            @if($fee->discount)
                                                <span
                                                    style="background:#fef2f2;color:#dc2626;padding:.25rem .6rem;border-radius:6px;font-weight:700;font-size:.82rem;">
                                                    {{ number_format($fee->discount, 0) }}% Off
                                                </span>
                                            @else
                                                <span style="color:#94a3b8;">&mdash;</span>
                                            @endif
                                        </td>

                                        <td style="padding:15px 20px;text-align:center;">
                                            @if($fee->after_discount)
                                                <span
                                                    style="background:#f0fdf4;color:#15803d;padding:.3rem .8rem;border-radius:8px;font-weight:800;font-size:1rem;">
                                                    Rs. {{ number_format($fee->after_discount, 0) }}
                                                </span>
                                            @elseif($fee->fees)
                                                <span
                                                    style="background:#f0fdf4;color:#15803d;padding:.3rem .8rem;border-radius:8px;font-weight:800;font-size:1rem;">
                                                    Rs. {{ number_format($fee->fees, 0) }}
                                                </span>
                                            @else
                                                <span style="color:#94a3b8;">&mdash;</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @empty
                <div style="text-align:center;padding:60px 0;color:#94a3b8;">
                    <svg width="48" height="48" fill="none" viewBox="0 0 24 24"
                        style="margin:0 auto 16px;display:block;opacity:.35;">
                        <rect x="2" y="5" width="20" height="14" rx="2" stroke="currentColor" stroke-width="1.5" />
                        <path d="M2 10h20M8 5v14M16 5v14" stroke="currentColor" stroke-width="1.5" />
                    </svg>
                    <p style="font-size:1rem;margin-bottom:16px;">Fees structure will be updated shortly.</p>
                    <a href="{{ url('/contact') }}"
                        style="display:inline-block;padding:12px 32px;background:#ff6700;color:#fff;border-radius:8px;font-weight:600;text-decoration:none;">
                        Contact Us
                    </a>
                </div>
            @endforelse

        </div>
    </section>

@endsection