@extends('layouts.public')

@section('meta')
<title>{{ $service->title }} — {{ setting('company_name') }}</title>
<meta name="description" content="{{ Str::limit($service->summary, 160) }}">
@endsection

@section('content')

@php
$heroImg = $service->image_path
    ? Storage::url($service->image_path)
    : 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1600&q=80';
@endphp

{{-- HERO --}}
<section style="
    min-height:380px;
    display:flex;
    align-items:flex-end;
    position:relative;
    background-color:#0d1b2a;
    background-image:url('{{ $heroImg }}');
    background-size:cover;
    background-position:center;">
    <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(10,20,40,.92) 35%,rgba(10,20,40,.45));"></div>
    <div class="container position-relative pb-5 pt-5" style="z-index:1;">
        <div class="col-lg-8">
            <nav class="mb-3" data-aos="fade-down">
                <ol class="breadcrumb mb-0" style="font-size:.8rem;">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none" style="color:rgba(255,255,255,.5);">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('services.index') }}" class="text-decoration-none" style="color:rgba(255,255,255,.5);">Dịch vụ</a>
                    </li>
                    <li class="breadcrumb-item active" style="color:rgba(255,255,255,.4);">{{ Str::limit($service->title, 40) }}</li>
                </ol>
            </nav>
            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;display:block;margin-bottom:.75rem;"
                  data-aos="fade-up">
                DỊCH VỤ
            </span>
            <h1 class="fw-bold text-white mb-3" style="font-size:clamp(1.8rem,4vw,2.8rem);line-height:1.2;"
                data-aos="fade-up" data-aos-delay="100">
                {{ $service->title }}
            </h1>
            <p style="color:rgba(255,255,255,.65);font-size:1rem;line-height:1.75;max-width:560px;"
               data-aos="fade-up" data-aos-delay="200">
                {{ $service->summary }}
            </p>
        </div>
    </div>
</section>

{{-- CONTENT --}}
<section style="background:#fff;padding:80px 0;">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8" data-aos="fade-right">
                @if($service->body)
                    <div class="article-body">{!! $service->body !!}</div>
                @else
                    <p style="color:#6c757d;font-size:1.05rem;line-height:1.85;">{{ $service->summary }}</p>
                @endif

                <div class="mt-5 pt-4" style="border-top:1px solid #e9ecef;">
                    <a href="{{ route('services.index') }}"
                       class="fw-semibold text-decoration-none d-inline-flex align-items-center gap-2"
                       style="color:#0d1b2a;border-bottom:2px solid #e8a020;padding-bottom:2px;font-size:.875rem;">
                        <i class="bi bi-arrow-left"></i> Quay lại dịch vụ
                    </a>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4" data-aos="fade-left">
                <div class="p-4 rounded-3 mb-4" style="background:#f8f9fa;border:1px solid #e9ecef;">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="d-flex align-items-center justify-content-center rounded"
                             style="width:48px;height:48px;background:rgba(13,27,42,.08);">
                            <i class="{{ $service->icon ?: 'bi-gear' }}" style="color:#0d1b2a;font-size:1.2rem;"></i>
                        </div>
                        <h5 class="fw-bold mb-0" style="color:#0d1b2a;font-size:.95rem;">{{ $service->title }}</h5>
                    </div>
                    <a href="{{ route('contact.index') }}"
                       class="btn w-100 fw-semibold py-2"
                       style="background:#0d1b2a;color:#fff;border-radius:6px;">
                        Yêu cầu tư vấn
                    </a>
                </div>

                <div class="p-4 rounded-3" style="background:#0d1b2a;">
                    <h6 class="fw-bold mb-3" style="color:#fff;font-size:.9rem;text-transform:uppercase;letter-spacing:1px;">
                        Dịch vụ khác
                    </h6>
                    @foreach(\App\Models\Service::published()->ordered()->where('id','!=',$service->id)->limit(5)->get() as $other)
                    <a href="{{ route('services.show', $other->slug) }}"
                       class="d-flex align-items-center gap-2 py-2 text-decoration-none"
                       style="border-bottom:1px solid rgba(255,255,255,.08);color:rgba(255,255,255,.65);font-size:.875rem;transition:color .2s;"
                       onmouseover="this.style.color='#e8a020'" onmouseout="this.style.color='rgba(255,255,255,.65)'">
                        <i class="bi bi-arrow-right-short" style="color:#e8a020;"></i>
                        {{ $other->title }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section style="background:#f4f5f7;padding:60px 0;">
    <div class="container">
        <div class="rounded-3 text-center text-white p-5" style="background:#0d1b2a;" data-aos="fade-up">
            <h2 class="fw-bold mb-3" style="font-size:clamp(1.4rem,2.5vw,1.9rem);">
                Bắt Đầu Dự Án Của Bạn
            </h2>
            <p style="color:rgba(255,255,255,.6);max-width:440px;margin:0 auto 2rem;line-height:1.7;font-size:.95rem;">
                Liên hệ với chúng tôi để được tư vấn giải pháp phù hợp nhất.
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('contact.index') }}"
                   class="btn fw-semibold px-5 py-2"
                   style="background:#e8a020;color:#fff;border-radius:6px;">
                    Liên hệ ngay
                </a>
                <a href="{{ route('services.index') }}"
                   class="btn fw-semibold px-5 py-2"
                   style="background:transparent;color:#fff;border:2px solid rgba(255,255,255,.3);border-radius:6px;">
                    Xem tất cả dịch vụ
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .article-body { font-size:1.05rem; line-height:1.85; color:#374151; }
    .article-body h2 { font-size:1.5rem; font-weight:700; color:#0d1b2a; margin-top:2.5rem; margin-bottom:1rem; }
    .article-body h3 { font-size:1.2rem; font-weight:700; color:#0d1b2a; margin-top:2rem; margin-bottom:.75rem; }
    .article-body p { margin-bottom:1.5rem; }
    .article-body ul, .article-body ol { padding-left:1.5rem; margin-bottom:1.5rem; }
    .article-body li { margin-bottom:.5rem; }
    .article-body img { max-width:100%; border-radius:10px; margin:1.5rem 0; }
    .article-body blockquote { border-left:4px solid #e8a020; padding:1rem 1.5rem; margin:2rem 0; background:#f8f9fa; border-radius:0 8px 8px 0; font-style:italic; }
</style>
@endpush
