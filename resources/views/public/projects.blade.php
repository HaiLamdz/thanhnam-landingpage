@extends('layouts.public')

@section('meta')
<title>Dự án — {{ setting('company_name') }}</title>
<meta name="description" content="Khám phá danh mục dự án kỹ thuật, kết cấu và hạ tầng của chúng tôi.">
@endsection

@section('content')

@php
$placeholders = [
    'https://images.unsplash.com/photo-1486325212027-8081e485255e?w=1200&q=80',
    'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&q=80',
    'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=800&q=80',
    'https://images.unsplash.com/photo-1590674899484-d5640e854abe?w=800&q=80',
    'https://images.unsplash.com/photo-1565008447742-97f6f38c985c?w=800&q=80',
    'https://images.unsplash.com/photo-1518770660439-4636190af475?w=800&q=80',
    'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800&q=80',
];
$featured   = $projects->first();
$secondary  = $projects->skip(1)->take(3);
$bigLeft    = $secondary->first();
$twoRight   = $secondary->skip(1)->take(2);
$remaining  = $projects->skip(4);
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
            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;display:block;margin-bottom:1rem;">
                DANH MỤC CÔNG TRÌNH
            </span>
            <h1 class="fw-bold text-white mb-3" style="font-size:clamp(2rem,4vw,3rem);line-height:1.15;">
                Dự Án Của Chúng Tôi
            </h1>
            <p style="color:rgba(255,255,255,.65);font-size:1.05rem;line-height:1.75;max-width:520px;margin:0;">
                Khám phá danh mục các dự án kỹ thuật, kết cấu và hạ tầng được thực hiện với độ chính xác cao, an toàn và hiệu suất lâu dài.
            </p>
        </div>
    </div>
</section>

{{-- ============================================================
     2. INTRO + FILTER PILLS
     ============================================================ --}}
<section style="background:#f4f5f7;padding:60px 0 40px;">
    <div class="container">
        <div data-aos="fade-up">
            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;display:block;margin-bottom:.75rem;">
                DANH MỤC DỰ ÁN
            </span>
            <h2 class="fw-bold mb-2" style="font-size:clamp(1.6rem,3vw,2.2rem);color:#0d1b2a;">
                Xây Dựng Vì Hiệu Suất
            </h2>
            <p style="color:#6c757d;font-size:.95rem;line-height:1.7;max-width:520px;margin:0 0 1.5rem;">
                Mỗi dự án là minh chứng cho cam kết của chúng tôi về chất lượng kỹ thuật, đổi mới sáng tạo và xây dựng bền vững.
            </p>

            {{-- Filter pills --}}
            <div>
                <div class="d-flex gap-2 flex-wrap" id="filterPills">
                    <a href="{{ route('projects.index') }}"
                       class="btn btn-sm fw-semibold px-3"
                       style="background:{{ !request('service') ? '#0d1b2a' : '#fff' }};color:{{ !request('service') ? '#fff' : '#6c757d' }};border:1px solid {{ !request('service') ? '#0d1b2a' : '#dee2e6' }};border-radius:20px;font-size:.8rem;white-space:nowrap;">
                        Tất cả
                    </a>
                    @foreach($services as $i => $service)
                    <a href="{{ route('projects.index', ['service' => $service->id]) }}"
                       class="btn btn-sm fw-semibold px-3 filter-pill-extra {{ $i >= 0 ? 'd-none' : '' }}"
                       style="background:{{ request('service') == $service->id ? '#0d1b2a' : '#fff' }};color:{{ request('service') == $service->id ? '#fff' : '#6c757d' }};border:1px solid {{ request('service') == $service->id ? '#0d1b2a' : '#dee2e6' }};border-radius:20px;font-size:.8rem;white-space:nowrap;">
                        {{ $service->title }}
                    </a>
                    @endforeach

                    @if($services->count() > 5)
                    <button type="button" id="showMoreFilters"
                            class="btn btn-sm fw-semibold px-3"
                            style="background:#fff;color:#e8a020;border:1px solid #e8a020;border-radius:20px;font-size:.8rem;white-space:nowrap;">
                        + Xem thêm
                    </button>
                    @endif
                </div>
            </div>

            <script>
                (function() {
                    var btn = document.getElementById('showMoreFilters');
                    if (!btn) return;
                    var expanded = false;
                    btn.addEventListener('click', function() {
                        expanded = !expanded;
                        document.querySelectorAll('.filter-pill-extra').forEach(function(el) {
                            el.classList.toggle('d-none', !expanded);
                        });
                        btn.textContent = expanded ? '− Thu lại' : '+ Xem thêm';
                    });
                })();
            </script>
        </div>
    </div>
</section>

{{-- ============================================================
     3. FEATURED PROJECT
     ============================================================ --}}
@if($featured)
<section style="background:#f4f5f7;padding:0 0 40px;">
    <div class="container">
        @php $featImg = $featured->image_path ? Storage::url($featured->image_path) : $placeholders[0]; @endphp
        <div class="position-relative overflow-hidden rounded-3" style="height:440px;">
            <img src="{{ $featImg }}" alt="{{ $featured->title }}"
                 class="w-100 h-100" style="object-fit:cover;">
            <div style="position:absolute;inset:0;background:linear-gradient(to right,rgba(10,20,40,.85) 45%,rgba(10,20,40,.15));"></div>
            <div class="position-absolute" style="bottom:0;left:0;right:0;padding:2.5rem;" data-aos="fade-up">
                <div style="max-width:540px;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span style="font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#e8a020;">
                            DỰ ÁN NỔI BẬT
                        </span>
                        <span style="font-size:.75rem;color:rgba(255,255,255,.5);">
                            {{ $featured->created_at?->format('d/m/Y') }}
                        </span>
                    </div>
                    <h2 class="fw-bold text-white mb-3" style="font-size:clamp(1.3rem,2.5vw,1.9rem);line-height:1.3;">
                        {{ $featured->title }}
                    </h2>
                    <p style="color:rgba(255,255,255,.65);font-size:.9rem;line-height:1.7;margin-bottom:1.5rem;">
                        {{ Str::limit($featured->description, 160) }}
                    </p>
                    <a href="{{ route('projects.show', $featured) }}"
                       class="d-inline-flex align-items-center gap-2 fw-semibold text-decoration-none px-4 py-2 rounded"
                       style="background:#e8a020;color:#fff;font-size:.875rem;">
                        Xem chi tiết dự án <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ============================================================
     4. SECONDARY GRID (1 big left + 2 stacked right)
     ============================================================ --}}
<section style="background:#f4f5f7;padding:0 0 40px;">
    <div class="container">
        <div class="row g-3">

            {{-- Big left --}}
            <div class="col-md-7" data-aos="fade-right">
                @if($bigLeft)
                @php $bigImg = $bigLeft->image_path ? Storage::url($bigLeft->image_path) : $placeholders[1]; @endphp
                <a href="{{ route('projects.show', $bigLeft) }}" class="text-decoration-none d-block h-100">
                <div class="overflow-hidden rounded-3 position-relative h-100" style="min-height:420px;">
                    <img src="{{ $bigImg }}" alt="{{ $bigLeft->title }}"
                         class="w-100 h-100 position-absolute top-0 start-0" style="object-fit:cover;transition:transform .4s;"
                         onmouseover="this.style.transform='scale(1.03)'"
                         onmouseout="this.style.transform='scale(1)'">
                    <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(10,20,40,.8) 40%,transparent);"></div>
                    <div class="position-absolute bottom-0 start-0 p-4">
                        <span style="font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#e8a020;display:block;margin-bottom:.5rem;">
                            Hạ tầng
                        </span>
                        <h4 class="fw-bold text-white mb-2" style="line-height:1.3;">{{ $bigLeft->title }}</h4>
                        <p style="color:rgba(255,255,255,.65);font-size:.85rem;line-height:1.6;margin:0;">
                            {{ Str::limit($bigLeft->description, 100) }}
                        </p>
                    </div>
                </div>
                </a>
                @endif
            </div>

            {{-- Two stacked right --}}
            <div class="col-md-5 d-flex flex-column gap-3" data-aos="fade-left">
                @foreach($twoRight as $idx => $proj)
                @php $img = $proj->image_path ? Storage::url($proj->image_path) : $placeholders[$idx + 2]; @endphp
                <a href="{{ route('projects.show', $proj) }}" class="text-decoration-none d-block flex-grow-1">
                <div class="overflow-hidden rounded-3 position-relative" style="height:200px;">
                    <img src="{{ $img }}" alt="{{ $proj->title }}"
                         class="w-100 h-100" style="object-fit:cover;transition:transform .4s;"
                         onmouseover="this.style.transform='scale(1.04)'"
                         onmouseout="this.style.transform='scale(1)'">
                    <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(10,20,40,.75) 50%,transparent);"></div>
                    <div class="position-absolute bottom-0 start-0 p-3">
                        <span style="font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#e8a020;display:block;margin-bottom:.3rem;">
                            Thương mại
                        </span>
                        <div class="fw-bold text-white" style="font-size:.9rem;line-height:1.3;">{{ $proj->title }}</div>
                    </div>
                </div>
                </a>
                @endforeach
                @for($i = $twoRight->count(); $i < 2; $i++)
                <div class="overflow-hidden rounded-3 flex-grow-1" style="height:200px;background:#e9ecef;"></div>
                @endfor
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     5. REMAINING PROJECTS GRID
     ============================================================ --}}
@if($remaining->count() > 0)
<section style="background:#f4f5f7;padding:0 0 60px;">
    <div class="container">
        <div class="row g-3">
            @foreach($remaining as $idx => $proj)
            @php $img = $proj->image_path ? Storage::url($proj->image_path) : $placeholders[$idx % count($placeholders)]; @endphp
            <div class="col-md-4">
                <div class="bg-white rounded-3 overflow-hidden h-100" style="border:1px solid #e9ecef;">
                    <div style="height:200px;overflow:hidden;">
                        <img src="{{ $img }}" alt="{{ $proj->title }}"
                             class="w-100 h-100" style="object-fit:cover;transition:transform .4s;"
                             onmouseover="this.style.transform='scale(1.05)'"
                             onmouseout="this.style.transform='scale(1)'">
                    </div>
                    <div class="p-4">
                        <span style="font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#e8a020;display:block;margin-bottom:.5rem;">
                            Công nghiệp
                        </span>
                        <h6 class="fw-bold mb-2" style="color:#0d1b2a;line-height:1.4;">{{ $proj->title }}</h6>
                        <p class="mb-3" style="color:#6c757d;font-size:.85rem;line-height:1.65;">
                            {{ Str::limit($proj->description, 90) }}
                        </p>
                        <a href="{{ route('projects.show', $proj) }}" class="fw-semibold text-decoration-none d-inline-flex align-items-center gap-1"
                           style="font-size:.8rem;color:#0d1b2a;border-bottom:2px solid #e8a020;padding-bottom:2px;">
                            Xem chi tiết <i class="bi bi-arrow-right"></i>
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
     6. STATISTICS
     ============================================================ --}}
<section style="background:#fff;padding:80px 0;">
    <div class="container">
        <div class="row g-4 text-center justify-content-center">
            @foreach([
                ['value'=>'250+','label'=>'Dự án hoàn thành'],
                ['value'=>'10+','label'=>'Năm kinh nghiệm'],
                ['value'=>'40+','label'=>'Kỹ sư & Chuyên gia'],
                ['value'=>'98%','label'=>'Khách hàng hài lòng'],
            ] as $i => $stat)
            <div class="col-6 col-md-3 {{ $i > 0 ? 'border-start' : '' }}" style="border-color:#e9ecef !important;"
                 data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="fw-bold" style="font-size:2.5rem;color:#0d1b2a;line-height:1;">{{ $stat['value'] }}</div>
                <div style="font-size:.8rem;color:#adb5bd;margin-top:.5rem;text-transform:uppercase;letter-spacing:1px;">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     7. HOW WE DELIVER (Process)
     ============================================================ --}}
<section style="background:#0d1b2a;padding:80px 0;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;">
                Quy trình
            </span>
            <h2 class="fw-bold mt-2" style="font-size:clamp(1.6rem,3vw,2.2rem);color:#fff;">
                Cách Chúng Tôi Thực Hiện Dự Án
            </h2>
        </div>
        <div class="row g-4">
            @foreach([
                ['num'=>'01','icon'=>'bi-search','title'=>'Lập kế hoạch','desc'=>'Phân tích yêu cầu, đánh giá địa điểm và xây dựng kế hoạch tổng thể cho dự án.'],
                ['num'=>'02','icon'=>'bi-pencil-square','title'=>'Thiết kế','desc'=>'Phát triển giải pháp thiết kế tối ưu, đảm bảo tính khả thi và hiệu quả kinh tế.'],
                ['num'=>'03','icon'=>'bi-gear','title'=>'Thi công','desc'=>'Triển khai thi công với đội ngũ chuyên nghiệp, giám sát chặt chẽ từng giai đoạn.'],
                ['num'=>'04','icon'=>'bi-check2-circle','title'=>'Bàn giao','desc'=>'Nghiệm thu, bàn giao công trình đúng tiến độ và đảm bảo chất lượng cam kết.'],
            ] as $step)
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="text-center p-4">
                    <div class="d-flex align-items-center justify-content-center rounded-circle mx-auto mb-3"
                         style="width:60px;height:60px;background:rgba(232,160,32,.15);border:1px solid rgba(232,160,32,.3);">
                        <i class="bi {{ $step['icon'] }}" style="color:#e8a020;font-size:1.3rem;"></i>
                    </div>
                    <h5 class="fw-bold mb-2" style="color:#fff;">{{ $step['title'] }}</h5>
                    <p style="color:rgba(255,255,255,.5);font-size:.875rem;line-height:1.7;margin:0;">{{ $step['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     8. CTA
     ============================================================ --}}
<section style="background:#f4f5f7;padding:80px 0;">
    <div class="container">
        <div class="rounded-3 text-center text-white p-5"
             style="background:#0d1b2a;padding:80px 40px !important;"
             data-aos="fade-up">
            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;display:block;margin-bottom:1rem;">
                Bắt đầu ngay
            </span>
            <h2 class="fw-bold mb-3" style="font-size:clamp(1.6rem,3vw,2.2rem);">
                Sẵn Sàng Khởi Động Dự Án Tiếp Theo?
            </h2>
            <p style="color:rgba(255,255,255,.6);max-width:480px;margin:0 auto 2.5rem;line-height:1.7;">
                Hãy chia sẻ ý tưởng của bạn với chúng tôi. Đội ngũ kỹ sư sẽ tư vấn giải pháp tối ưu nhất cho công trình của bạn.
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('contact.index') }}"
                   class="btn btn-lg fw-semibold px-5"
                   style="background:#e8a020;color:#fff;border-radius:6px;">
                    Liên hệ ngay
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
