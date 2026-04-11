@extends('layouts.public')

@section('meta')
<title>{{ $post->title }} — {{ setting('company_name') }}</title>
<meta name="description" content="{{ Str::limit($post->excerpt ?? strip_tags($post->body), 160) }}">
<meta property="og:title" content="{{ $post->title }}">
<meta property="og:description" content="{{ Str::limit($post->excerpt ?? strip_tags($post->body), 160) }}">
@if($post->featured_image_path)
<meta property="og:image" content="{{ Storage::url($post->featured_image_path) }}">
@endif
@endsection

@section('content')

@php
$heroImg = $post->featured_image_path
    ? Storage::url($post->featured_image_path)
    : 'https://images.unsplash.com/photo-1486325212027-8081e485255e?w=1600&q=80';

$readTime = max(1, (int) ceil(str_word_count(strip_tags($post->body ?? '')) / 200));

$placeholders = [
    'https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&q=80',
    'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80',
    'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=600&q=80',
];
@endphp

{{-- ============================================================
     1. HERO
     ============================================================ --}}
<section style="
    min-height:520px;
    display:flex;
    align-items:flex-end;
    position:relative;
    background-color:#0d1b2a;
    background-image:url('{{ $heroImg }}');
    background-size:cover;
    background-position:center;">
    <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(10,20,40,.95) 30%,rgba(10,20,40,.4));"></div>
    <div class="container position-relative pb-5 pt-5" style="z-index:1;">
        <div class="col-lg-9 mx-auto">
            {{-- Breadcrumb --}}
            <nav class="mb-4" data-aos="fade-down">
                <ol class="breadcrumb mb-0" style="font-size:.8rem;">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none" style="color:rgba(255,255,255,.5);">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('news.index') }}" class="text-decoration-none" style="color:rgba(255,255,255,.5);">Tin tức</a>
                    </li>
                    <li class="breadcrumb-item active" style="color:rgba(255,255,255,.4);">{{ Str::limit($post->title, 40) }}</li>
                </ol>
            </nav>

            {{-- Category badge --}}
            @if($post->category_tag)
            <div class="mb-3" data-aos="fade-up">
                <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;border:1px solid rgba(232,160,32,.4);padding:.3rem .8rem;border-radius:2px;">
                    {{ $post->category_tag }}
                </span>
            </div>
            @endif

            {{-- Title --}}
            <h1 class="fw-bold text-white mb-4" style="font-size:clamp(1.8rem,4vw,2.8rem);line-height:1.2;"
                data-aos="fade-up" data-aos-delay="100">
                {{ $post->title }}
            </h1>

            {{-- Meta row --}}
            <div class="d-flex flex-wrap align-items-center gap-4" data-aos="fade-up" data-aos-delay="200">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-calendar3" style="color:#e8a020;font-size:.85rem;"></i>
                    <span style="font-size:.85rem;color:rgba(255,255,255,.65);">
                        {{ $post->published_at?->format('d/m/Y') ?? $post->created_at->format('d/m/Y') }}
                    </span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-clock" style="color:#e8a020;font-size:.85rem;"></i>
                    <span style="font-size:.85rem;color:rgba(255,255,255,.65);">{{ $readTime }} phút đọc</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-person" style="color:#e8a020;font-size:.85rem;"></i>
                    <span style="font-size:.85rem;color:rgba(255,255,255,.65);">{{ setting('company_name', 'Thành Nam TFC') }}</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     2. ARTICLE CONTENT
     ============================================================ --}}
<section style="background:#fff;padding:70px 0;">
    <div class="container">
        <div class="col-lg-8 mx-auto">

            {{-- Excerpt / Lead --}}
            @if($post->excerpt)
            <p class="mb-5" style="font-size:1.15rem;color:#374151;line-height:1.85;font-weight:500;border-left:4px solid #e8a020;padding-left:1.5rem;"
               data-aos="fade-up">
                {{ $post->excerpt }}
            </p>
            @endif

            {{-- Body content --}}
            <div class="article-body" data-aos="fade-up" data-aos-delay="50">
                {!! $post->body !!}
            </div>

            {{-- Share section --}}
            <div class="mt-5 pt-4" style="border-top:1px solid #e9ecef;" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <span style="font-size:.8rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#adb5bd;">
                        Chia sẻ:
                    </span>
                    @php $shareUrl = urlencode(request()->url()); $shareTitle = urlencode($post->title); @endphp
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}"
                       target="_blank" rel="noopener"
                       class="d-inline-flex align-items-center gap-2 fw-semibold text-decoration-none px-3 py-2 rounded"
                       style="background:#1877f2;color:#fff;font-size:.8rem;">
                        <i class="bi bi-facebook"></i> Facebook
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}"
                       target="_blank" rel="noopener"
                       class="d-inline-flex align-items-center gap-2 fw-semibold text-decoration-none px-3 py-2 rounded"
                       style="background:#0a66c2;color:#fff;font-size:.8rem;">
                        <i class="bi bi-linkedin"></i> LinkedIn
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}"
                       target="_blank" rel="noopener"
                       class="d-inline-flex align-items-center gap-2 fw-semibold text-decoration-none px-3 py-2 rounded"
                       style="background:#1da1f2;color:#fff;font-size:.8rem;">
                        <i class="bi bi-twitter-x"></i> Twitter
                    </a>
                    <a href="{{ route('news.index') }}"
                       class="d-inline-flex align-items-center gap-2 fw-semibold text-decoration-none ms-auto"
                       style="color:#0d1b2a;font-size:.875rem;border-bottom:2px solid #e8a020;padding-bottom:2px;">
                        <i class="bi bi-arrow-left"></i> Quay lại tin tức
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     3. RELATED ARTICLES
     ============================================================ --}}
@if($related->count() > 0)
<section style="background:#f8f9fa;padding:80px 0;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;display:block;margin-bottom:.5rem;">
                Đọc thêm
            </span>
            <h2 class="fw-bold" style="font-size:clamp(1.4rem,2.5vw,1.9rem);color:#0d1b2a;">
                Bài viết liên quan
            </h2>
        </div>

        <div class="row g-4">
            @foreach($related as $i => $rel)
            @php
            $relImg = $rel->featured_image_path
                ? Storage::url($rel->featured_image_path)
                : $placeholders[$i % 3];
            @endphp
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <a href="{{ route('news.show', $rel->slug) }}" class="text-decoration-none">
                    <div class="bg-white rounded-3 overflow-hidden h-100 card-lift" style="border:1px solid #e9ecef;">
                        <div class="img-overlay-wrap" style="height:200px;">
                            <img src="{{ $relImg }}" alt="{{ $rel->title }}"
                                 class="w-100 h-100" style="object-fit:cover;">
                        </div>
                        <div class="p-4">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                @if($rel->category_tag)
                                <span style="font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;padding:.2rem .6rem;background:#e8a020;color:#fff;border-radius:3px;">
                                    {{ $rel->category_tag }}
                                </span>
                                @endif
                                <span style="font-size:.75rem;color:#adb5bd;">
                                    {{ $rel->published_at?->format('d/m/Y') }}
                                </span>
                            </div>
                            <h6 class="fw-bold mb-3" style="color:#0d1b2a;line-height:1.4;">{{ $rel->title }}</h6>
                            <span class="fw-semibold d-inline-flex align-items-center gap-1"
                                  style="font-size:.8rem;color:#0d1b2a;border-bottom:2px solid #e8a020;padding-bottom:2px;">
                                Đọc thêm <i class="bi bi-arrow-right"></i>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ============================================================
     4. NEWSLETTER
     ============================================================ --}}
<section style="background:#fff;padding:80px 0;">
    <div class="container">
        <div class="col-lg-6 mx-auto text-center" data-aos="fade-up">
            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;display:block;margin-bottom:.75rem;">
                Bản tin
            </span>
            <h2 class="fw-bold mb-3" style="font-size:clamp(1.4rem,2.5vw,1.9rem);color:#0d1b2a;">
                Luôn Cập Nhật
            </h2>
            <p style="color:#6c757d;font-size:.95rem;line-height:1.7;margin-bottom:2rem;">
                Nhận những thông tin kỹ thuật và cập nhật dự án mới nhất trực tiếp vào hộp thư của bạn.
            </p>
            <div class="d-flex gap-2 justify-content-center">
                <input type="email" placeholder="Địa chỉ email của bạn"
                       class="form-control"
                       style="max-width:320px;border-radius:6px;border-color:#dee2e6;padding:.65rem 1rem;">
                <button class="btn fw-semibold px-4 flex-shrink-0"
                        style="background:#0d1b2a;color:#fff;border-radius:6px;white-space:nowrap;">
                    Đăng ký
                </button>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* Article body typography */
    .article-body {
        font-size: 1.05rem;
        line-height: 1.85;
        color: #374151;
    }
    .article-body h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0d1b2a;
        margin-top: 2.5rem;
        margin-bottom: 1rem;
    }
    .article-body h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: #0d1b2a;
        margin-top: 2rem;
        margin-bottom: .75rem;
    }
    .article-body p {
        margin-bottom: 1.5rem;
    }
    .article-body ul, .article-body ol {
        padding-left: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .article-body li {
        margin-bottom: .5rem;
    }
    .article-body img {
        max-width: 100%;
        border-radius: 10px;
        margin: 1.5rem 0;
    }
    .article-body blockquote {
        border-left: 4px solid #e8a020;
        padding: 1rem 1.5rem;
        margin: 2rem 0;
        background: #f8f9fa;
        border-radius: 0 8px 8px 0;
        font-style: italic;
        color: #374151;
    }
    .article-body a {
        color: #0d1b2a;
        text-decoration: underline;
        text-decoration-color: #e8a020;
    }
    .article-body strong {
        color: #0d1b2a;
    }
</style>
@endpush
