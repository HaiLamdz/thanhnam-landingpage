@extends('layouts.public')

@section('meta')
<title>Dịch vụ — {{ setting('company_name') }}</title>
<meta name="description" content="{{ setting('meta_description_default') }}">
@endsection

@section('content')

@php
$featured = $services->take(2);
$rest     = $services->skip(2);
@endphp

{{-- ============================================================
     1. HERO
     ============================================================ --}}
<section style="
    min-height:320px;
    display:flex;
    align-items:center;
    background-color:#0d1b2a;
    background-image:url('https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1600&q=80');
    background-size:cover;
    background-position:center;
    position:relative;">
    <div style="position:absolute;inset:0;background:rgba(10,20,40,.78);"></div>
    <div class="container position-relative py-5" style="z-index:1;">
        <div class="col-lg-7">
            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;display:block;margin-bottom:1rem;"
                  data-aos="fade-down">
                DỊCH VỤ KỸ THUẬT
            </span>
            <h1 class="fw-bold text-white mb-3" style="font-size:clamp(2rem,4vw,3rem);line-height:1.15;"
                data-aos="fade-up" data-aos-delay="100">
                Dịch Vụ Của Chúng Tôi
            </h1>
            <p style="color:rgba(255,255,255,.65);font-size:1.05rem;line-height:1.75;max-width:520px;margin:0;"
               data-aos="fade-up" data-aos-delay="200">
                Chúng tôi cung cấp các giải pháp kỹ thuật, kết cấu và xây dựng chuyên biệt, được thiết kế để đảm bảo hiệu suất, an toàn và giá trị lâu dài.
            </p>
        </div>
    </div>
</section>

{{-- ============================================================
     2. INTRO + FILTER
     ============================================================ --}}
<section style="background:#f4f5f7;padding:60px 0 40px;">
    <div class="container">
        <div class="d-flex align-items-start justify-content-between flex-wrap gap-4">
            <div data-aos="fade-right">
                <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;display:block;margin-bottom:.75rem;">
                    Chuyên môn
                </span>
                <h2 class="fw-bold mb-2" style="font-size:clamp(1.6rem,3vw,2.2rem);color:#0d1b2a;">
                    Chuyên Môn Bạn Có Thể Tin Tưởng
                </h2>
                <p style="color:#6c757d;font-size:.95rem;line-height:1.7;max-width:520px;margin:0;">
                    Từ thiết kế kết cấu đến quản lý dự án, chúng tôi mang đến giải pháp toàn diện cho mọi công trình.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     3. SERVICES GRID
     ============================================================ --}}
<section style="background:#f4f5f7;padding:0 0 60px;">
    <div class="container">
        @if($services->isEmpty())
        <div class="text-center py-5" style="color:#adb5bd;">
            <i class="bi bi-tools" style="font-size:3rem;display:block;margin-bottom:1rem;"></i>
            <p>Chưa có dịch vụ nào.</p>
        </div>
        @else
        <div class="row g-4">
            @foreach($services as $i => $service)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 100 }}">
                <div class="bg-white rounded-3 p-4 h-100 card-lift" style="border:1px solid #e9ecef;">
                    {{-- Icon --}}
                    <div class="mb-4 d-flex align-items-center justify-content-center rounded"
                         style="width:56px;height:56px;background:rgba(13,27,42,.06);">
                        <i class="{{ $service->icon ?: 'bi-gear' }} icon-hover" style="color:#0d1b2a;font-size:1.4rem;"></i>
                    </div>

                    {{-- Meta label --}}
                    <span style="font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#e8a020;display:block;margin-bottom:.5rem;">
                        Dịch vụ
                    </span>

                    {{-- Title --}}
                    <h5 class="fw-bold mb-2" style="color:#0d1b2a;line-height:1.3;">{{ $service->title }}</h5>

                    {{-- Summary --}}
                    <p style="color:#6c757d;font-size:.875rem;line-height:1.7;margin-bottom:1.5rem;flex-grow:1;">
                        {{ Str::limit($service->summary, 120) }}
                    </p>

                    {{-- CTA --}}
                    <a href="{{ route('services.show', $service->slug) }}"
                       class="d-inline-flex align-items-center gap-2 fw-semibold text-decoration-none"
                       style="font-size:.8rem;color:#0d1b2a;border-bottom:2px solid #e8a020;padding-bottom:2px;">
                        Xem chi tiết <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- ============================================================
     4. FEATURED SERVICES (2 horizontal cards)
     ============================================================ --}}
@if($featured->count() >= 2)
<section style="background:#fff;padding:80px 0;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;display:block;margin-bottom:.5rem;">
                Nổi bật
            </span>
            <h2 class="fw-bold" style="font-size:clamp(1.6rem,3vw,2.2rem);color:#0d1b2a;">
                Dịch Vụ Tiêu Biểu
            </h2>
        </div>
        <div class="row g-4">
            @foreach($featured as $i => $svc)
            @php
            $imgs = [
                'https://images.unsplash.com/photo-1486325212027-8081e485255e?w=800&q=80',
                'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=800&q=80',
            ];
            $img = $svc->image_path ? Storage::url($svc->image_path) : $imgs[$i % 2];
            @endphp
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ $i * 150 }}">
                <div class="rounded-3 overflow-hidden h-100 card-lift" style="border:1px solid #e9ecef;">
                    <div class="img-overlay-wrap" style="height:220px;">
                        <img src="{{ $img }}" alt="{{ $svc->title }}" class="w-100 h-100" style="object-fit:cover;">
                    </div>
                    <div class="p-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="d-flex align-items-center justify-content-center rounded"
                                 style="width:36px;height:36px;background:rgba(13,27,42,.06);">
                                <i class="{{ $svc->icon ?: 'bi-gear' }}" style="color:#0d1b2a;font-size:.9rem;"></i>
                            </div>
                            <span style="font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#e8a020;">
                                Dịch vụ nổi bật
                            </span>
                        </div>
                        <h5 class="fw-bold mb-2" style="color:#0d1b2a;">{{ $svc->title }}</h5>
                        <p style="color:#6c757d;font-size:.9rem;line-height:1.7;margin-bottom:1.25rem;">
                            {{ Str::limit($svc->summary, 140) }}
                        </p>
                        <a href="{{ route('services.show', $svc->slug) }}"
                           class="fw-semibold text-decoration-none d-inline-flex align-items-center gap-2"
                           style="color:#0d1b2a;border-bottom:2px solid #e8a020;padding-bottom:2px;font-size:.875rem;">
                            Tìm hiểu thêm <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ============================================================
     5. WHY CHOOSE US
     ============================================================ --}}
<section style="background:#0d1b2a;padding:80px 0;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;display:block;margin-bottom:.5rem;">
                Lý do chọn chúng tôi
            </span>
            <h2 class="fw-bold" style="font-size:clamp(1.6rem,3vw,2.2rem);color:#fff;">
                Tại Sao Khách Hàng Tin Tưởng Chúng Tôi
            </h2>
        </div>
        <div class="row g-4">
            @foreach([
                ['icon'=>'bi-award','title'=>'Chuyên môn kỹ thuật','desc'=>'Đội ngũ kỹ sư được đào tạo bài bản với nhiều năm kinh nghiệm thực tiễn trong các dự án lớn.'],
                ['icon'=>'bi-shield-check','title'=>'An toàn là ưu tiên','desc'=>'Mọi dự án đều tuân thủ nghiêm ngặt các tiêu chuẩn an toàn quốc gia và quốc tế.'],
                ['icon'=>'bi-check2-all','title'=>'Cam kết tiến độ','desc'=>'Chúng tôi có hồ sơ thực hiện dự án đúng hạn và trong ngân sách được kiểm chứng.'],
                ['icon'=>'bi-graph-up','title'=>'Hiệu suất lâu dài','desc'=>'Các giải pháp của chúng tôi được thiết kế để tối ưu hóa hiệu suất và độ bền theo thời gian.'],
            ] as $i => $item)
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="text-center p-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle mx-auto mb-3"
                         style="width:60px;height:60px;background:rgba(232,160,32,.15);border:1px solid rgba(232,160,32,.3);">
                        <i class="bi {{ $item['icon'] }}" style="color:#e8a020;font-size:1.3rem;"></i>
                    </div>
                    <h5 class="fw-bold mb-2" style="color:#fff;font-size:1rem;">{{ $item['title'] }}</h5>
                    <p style="color:rgba(255,255,255,.5);font-size:.875rem;line-height:1.7;margin:0;">{{ $item['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     6. CTA
     ============================================================ --}}
<section style="background:#f4f5f7;padding:80px 0;">
    <div class="container">
        <div class="rounded-3 text-center text-white p-5"
             style="background:#0d1b2a;"
             data-aos="fade-up">
            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;display:block;margin-bottom:1rem;">
                Hợp tác
            </span>
            <h2 class="fw-bold mb-3" style="font-size:clamp(1.6rem,3vw,2.2rem);">
                Cần Dịch Vụ Phù Hợp Với Dự Án Của Bạn?
            </h2>
            <p style="color:rgba(255,255,255,.6);max-width:480px;margin:0 auto 2.5rem;line-height:1.7;">
                Hãy liên hệ với chúng tôi để được tư vấn giải pháp kỹ thuật tối ưu nhất cho công trình của bạn.
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('contact.index') }}"
                   class="btn btn-lg fw-semibold px-5 btn-accent-anim"
                   style="background:#e8a020;color:#fff;border-radius:6px;">
                    Liên hệ ngay
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
