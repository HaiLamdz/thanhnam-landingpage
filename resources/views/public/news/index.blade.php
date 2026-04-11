@extends('layouts.public')

@section('meta')
<title>Tin tức — {{ setting('company_name') }}</title>
<meta name="description" content="{{ setting('meta_description_default') }}">
@endsection

@section('content')

@php
$allPosts   = $posts->getCollection();
$featured   = $allPosts->first();
$secondary  = $allPosts->skip(1)->take(3);   // 1 big left + 2 right
$bigLeft    = $secondary->first();
$twoRight   = $secondary->skip(1)->take(2);
$textLinks  = $allPosts->skip(4)->take(3);

$placeholders = [
    'https://images.unsplash.com/photo-1486325212027-8081e485255e?w=1200&q=80',
    'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&q=80',
    'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=800&q=80',
    'https://images.unsplash.com/photo-1590674899484-d5640e854abe?w=800&q=80',
    'https://images.unsplash.com/photo-1565008447742-97f6f38c985c?w=800&q=80',
    'https://images.unsplash.com/photo-1518770660439-4636190af475?w=800&q=80',
    'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800&q=80',
];
@endphp

{{-- ============================================================
     1. INTRO / HERO
     ============================================================ --}}
<section style="background:#f4f5f7;padding:60px 0 40px;">
    <div class="container">
        <div class="d-flex align-items-start justify-content-between flex-wrap gap-4">

            {{-- Left: badge + heading --}}
            <div>
                <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;display:inline-block;margin-bottom:1rem;">
                    THÔNG TIN &amp; CẬP NHẬT
                </span>
                <h1 class="fw-bold" style="font-size:clamp(2rem,5vw,3.2rem);color:#0d1b2a;line-height:1.1;max-width:480px;">
                    Tương Lai Của<br>Hạ Tầng.
                </h1>
            </div>

            {{-- Right: category filter pills --}}
            <div class="d-flex align-items-end pb-2">
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('news.index') }}"
                       class="btn btn-sm fw-semibold px-3"
                       style="background:#0d1b2a;color:#fff;border-radius:20px;font-size:.8rem;">
                        Tất cả
                    </a>
                    <a href="#"
                       class="btn btn-sm fw-semibold px-3"
                       style="background:#fff;color:#6c757d;border:1px solid #dee2e6;border-radius:20px;font-size:.8rem;">
                        Dự án
                    </a>
                    <a href="#"
                       class="btn btn-sm fw-semibold px-3"
                       style="background:#fff;color:#6c757d;border:1px solid #dee2e6;border-radius:20px;font-size:.8rem;">
                        Doanh nghiệp
                    </a>
                    <a href="#"
                       class="btn btn-sm fw-semibold px-3"
                       style="background:#fff;color:#6c757d;border:1px solid #dee2e6;border-radius:20px;font-size:.8rem;">
                        Sự kiện
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     2. FEATURED ARTICLE
     ============================================================ --}}
@if($featured)
<section style="background:#f4f5f7;padding:0 0 40px;">
    <div class="container">
        <div class="position-relative overflow-hidden rounded-3" style="height:420px;">
            {{-- Background image --}}
            @php $featImg = $featured->featured_image_path ? Storage::url($featured->featured_image_path) : $placeholders[0]; @endphp
            <img src="{{ $featImg }}" alt="{{ $featured->title }}"
                 class="w-100 h-100" style="object-fit:cover;">
            {{-- Dark gradient overlay --}}
            <div style="position:absolute;inset:0;background:linear-gradient(to right, rgba(10,20,40,.85) 45%, rgba(10,20,40,.2));"></div>

            {{-- Content card bottom-left --}}
            <div class="position-absolute" style="bottom:0;left:0;right:0;padding:2rem 2.5rem;" data-aos="fade-up">
                <div style="max-width:520px;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span style="font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#e8a020;">
                            BÀI VIẾT NỔI BẬT
                        </span>
                        <span style="font-size:.75rem;color:rgba(255,255,255,.5);">
                            {{ $featured->published_at?->format('d/m/Y') }}
                        </span>
                    </div>
                    <h2 class="fw-bold text-white mb-3" style="font-size:clamp(1.3rem,2.5vw,1.8rem);line-height:1.3;">
                        {{ $featured->title }}
                    </h2>
                    <p style="color:rgba(255,255,255,.65);font-size:.9rem;line-height:1.7;margin-bottom:1.25rem;">
                        {{ Str::limit($featured->excerpt ?? strip_tags($featured->body), 140) }}
                    </p>
                    <a href="{{ route('news.show', $featured->slug) }}"
                       class="d-inline-flex align-items-center gap-2 fw-semibold text-decoration-none"
                       style="color:#e8a020;font-size:.875rem;">
                        Đọc toàn bộ bài viết <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ============================================================
     3. SECONDARY GRID (1 big left + 2 stacked right)
     ============================================================ --}}
<section style="background:#f4f5f7;padding:0 0 40px;">
    <div class="container">
        <div class="row g-3">

            {{-- Big left --}}
            <div class="col-md-7" data-aos="fade-right">
                @if($bigLeft)
                @php $bigImg = $bigLeft->featured_image_path ? Storage::url($bigLeft->featured_image_path) : $placeholders[1]; @endphp
                <a href="{{ route('news.show', $bigLeft->slug) }}" class="text-decoration-none d-block h-100">
                    <div class="overflow-hidden rounded-3 position-relative h-100" style="min-height:420px;">
                        <img src="{{ $bigImg }}" alt="{{ $bigLeft->title }}"
                             class="w-100 h-100 position-absolute top-0 start-0" style="object-fit:cover;transition:transform .4s;"
                             onmouseover="this.style.transform='scale(1.03)'"
                             onmouseout="this.style.transform='scale(1)'">
                        <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(10,20,40,.8) 40%,transparent);"></div>
                        <div class="position-absolute bottom-0 start-0 p-4">
                            @if($bigLeft->category_tag)
                            <span style="font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#e8a020;display:block;margin-bottom:.5rem;">
                                {{ $bigLeft->category_tag }}
                            </span>
                            @endif
                            <h4 class="fw-bold text-white mb-0" style="line-height:1.3;">{{ $bigLeft->title }}</h4>
                            <p class="mt-2 mb-0" style="color:rgba(255,255,255,.65);font-size:.85rem;line-height:1.6;">
                                {{ Str::limit($bigLeft->excerpt ?? strip_tags($bigLeft->body), 100) }}
                            </p>
                        </div>
                    </div>
                </a>
                @endif
            </div>

            {{-- Two stacked right --}}
            <div class="col-md-5 d-flex flex-column gap-3" data-aos="fade-left">
                @foreach($twoRight as $idx => $post)
                @php $img = $post->featured_image_path ? Storage::url($post->featured_image_path) : $placeholders[$idx + 2]; @endphp
                <a href="{{ route('news.show', $post->slug) }}" class="text-decoration-none d-block flex-grow-1">
                    <div class="overflow-hidden rounded-3 position-relative" style="height:200px;">
                        <img src="{{ $img }}" alt="{{ $post->title }}"
                             class="w-100 h-100" style="object-fit:cover;transition:transform .4s;"
                             onmouseover="this.style.transform='scale(1.04)'"
                             onmouseout="this.style.transform='scale(1)'">
                        <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(10,20,40,.75) 50%,transparent);"></div>
                        <div class="position-absolute bottom-0 start-0 p-3">
                            @if($post->category_tag)
                            <span style="font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#e8a020;display:block;margin-bottom:.3rem;">
                                {{ $post->category_tag }}
                            </span>
                            @endif
                            <div class="fw-bold text-white" style="font-size:.9rem;line-height:1.3;">{{ $post->title }}</div>
                        </div>
                    </div>
                </a>
                @endforeach

                {{-- Fallback placeholders if not enough posts --}}
                @for($i = $twoRight->count(); $i < 2; $i++)
                <div class="overflow-hidden rounded-3 flex-grow-1" style="height:200px;background:#e9ecef;"></div>
                @endfor
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     4. EDITORIAL TEXT LINKS (3 columns)
     ============================================================ --}}
<section style="background:#f4f5f7;padding:20px 0 60px;">
    <div class="container">
        <div style="border-top:1px solid #dee2e6;padding-top:40px;">
            <div class="row g-5">
                @php
                $editorials = [
                    ['cat'=>'Công nghệ','title'=>'Tích hợp Digital Twin trong hạ tầng quy mô lớn','desc'=>'Cách Structura sử dụng dữ liệu thời gian thực để giám sát tính toàn vẹn kết cấu trên các dự án hạ tầng lớn.'],
                    ['cat'=>'Tin tức','title'=>'Tuyên bố CEO: Điều hướng thị trường thép toàn cầu 2025','desc'=>'Những hiểu biết chiến lược về quản lý chuỗi cung ứng và biến động giá cả trong năm tới.'],
                    ['cat'=>'Dự án','title'=>'Nền móng biển sâu: Kỹ thuật dưới áp suất','desc'=>'Phân tích kỹ thuật về các dự án nền móng biển sâu gần đây, tập trung vào hiệu quả lưu trữ năng lượng.'],
                ];
                @endphp

                @foreach($textLinks->count() >= 3 ? $textLinks : collect($editorials) as $i => $item)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    @if(is_array($item))
                        <span style="font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#e8a020;display:block;margin-bottom:.75rem;">
                            {{ $item['cat'] }}
                        </span>
                        <h5 class="fw-bold mb-2" style="color:#0d1b2a;line-height:1.35;font-size:1rem;">{{ $item['title'] }}</h5>
                        <p style="color:#6c757d;font-size:.875rem;line-height:1.7;margin-bottom:1rem;">{{ $item['desc'] }}</p>
                        <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#0d1b2a;border-bottom:2px solid #e8a020;padding-bottom:2px;cursor:pointer;">
                            ĐỌC THÊM
                        </span>
                    @else
                        <span style="font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#e8a020;display:block;margin-bottom:.75rem;">
                            {{ $item->category_tag ?? 'Tin tức' }}
                        </span>
                        <h5 class="fw-bold mb-2" style="color:#0d1b2a;line-height:1.35;font-size:1rem;">{{ $item->title }}</h5>
                        <p style="color:#6c757d;font-size:.875rem;line-height:1.7;margin-bottom:1rem;">
                            {{ Str::limit($item->excerpt ?? strip_tags($item->body), 100) }}
                        </p>
                        <a href="{{ route('news.show', $item->slug) }}"
                           style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#0d1b2a;border-bottom:2px solid #e8a020;padding-bottom:2px;text-decoration:none;">
                            ĐỌC THÊM
                        </a>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     5. NEWSLETTER SUBSCRIPTION
     ============================================================ --}}
<section style="background:#f4f5f7;padding:0 0 80px;">
    <div class="container">
        <div class="row g-0 overflow-hidden rounded-3" style="min-height:280px;">

            {{-- Left: form --}}
            <div class="col-md-6 p-5" style="background:#fff;" data-aos="fade-right">
                <h3 class="fw-bold mb-2" style="color:#0d1b2a;font-size:1.75rem;">Luôn Cập Nhật.</h3>
                <p style="color:#6c757d;font-size:.9rem;line-height:1.7;margin-bottom:1.5rem;">
                    Nhận những thông tin kỹ thuật và cập nhật dự án mới nhất trực tiếp vào hộp thư của bạn.
                </p>
                <div class="d-flex gap-2 mb-2">
                    <input type="email" placeholder="Địa chỉ email của bạn"
                           class="form-control"
                           style="border-radius:6px;border-color:#dee2e6;padding:.65rem 1rem;font-size:.9rem;">
                    <button class="btn fw-semibold px-4 flex-shrink-0"
                            style="background:#0d1b2a;color:#fff;border-radius:6px;white-space:nowrap;font-size:.875rem;">
                        Đăng ký
                    </button>
                </div>
                <p style="color:#adb5bd;font-size:.75rem;line-height:1.5;">
                    Bằng cách đăng ký, bạn đồng ý với chính sách bảo mật của chúng tôi. Bạn có thể hủy đăng ký bất kỳ lúc nào.
                </p>
            </div>

            {{-- Right: image --}}
            <div class="col-md-6 position-relative" style="min-height:240px;" data-aos="fade-left">
                <img src="https://images.unsplash.com/photo-1486325212027-8081e485255e?w=800&q=80"
                     alt="Newsletter"
                     class="w-100 h-100 position-absolute top-0 start-0"
                     style="object-fit:cover;">
                <div style="position:absolute;inset:0;background:rgba(13,27,42,.4);"></div>
            </div>

        </div>
    </div>
</section>

{{-- Pagination --}}
@if($posts->hasPages())
<section style="background:#f4f5f7;padding:0 0 60px;">
    <div class="container d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</section>
@endif

@endsection
