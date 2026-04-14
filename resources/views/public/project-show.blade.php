@extends('layouts.public')

@section('meta')
<title>{{ $project->title }} — {{ setting('company_name') }}</title>
<meta name="description" content="{{ Str::limit(strip_tags($project->description), 160) }}">
@endsection

@section('content')

@php
$heroImg = $project->image_path
    ? Storage::url($project->image_path)
    : 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1600&q=80';

$galleryImgs = [
    'https://images.unsplash.com/photo-1486325212027-8081e485255e?w=900&q=80',
    'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=600&q=80',
    'https://images.unsplash.com/photo-1590674899484-d5640e854abe?w=600&q=80',
];
@endphp

{{-- ============================================================
     1. HERO
     ============================================================ --}}
<section style="
    min-height:480px;
    display:flex;
    align-items:flex-end;
    position:relative;
    background-color:#0d1b2a;
    background-image:url('{{ $heroImg }}');
    background-size:cover;
    background-position:center;">
    <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(10,20,40,.92) 40%,rgba(10,20,40,.45));"></div>
    <div class="container position-relative pb-5 pt-5" style="z-index:1;">
        <div class="col-lg-8">
            <span class="d-inline-block mb-3" style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;border:1px solid rgba(232,160,32,.4);padding:.3rem .8rem;border-radius:2px;"
                  data-aos="fade-down">
                Dự án hạ tầng
            </span>
            <h1 class="fw-bold text-white mb-4" style="font-size:clamp(1.8rem,4vw,3rem);line-height:1.15;"
                data-aos="fade-up" data-aos-delay="100">
                {{ $project->title }}
            </h1>
            <p style="color:rgba(255,255,255,.65);font-size:1rem;line-height:1.75;max-width:560px;margin-bottom:2rem;"
               data-aos="fade-up" data-aos-delay="200">
                {{ Str::limit(strip_tags($project->description), 180) }}
            </p>
        </div>
    </div>
</section>

{{-- ============================================================
     2. PROJECT OVERVIEW
     ============================================================ --}}
<section style="padding:80px 0;background:#fff;">
    <div class="container">
        <div class="row g-5">

            {{-- Left: Description --}}
            <div class="col-lg-7" data-aos="fade-right">
                <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;display:block;margin-bottom:.75rem;">
                    Tổng quan dự án
                </span>
                <h2 class="fw-bold mb-4" style="font-size:clamp(1.4rem,2.5vw,1.9rem);color:#0d1b2a;">
                    Mô tả chi tiết
                </h2>
                <div class="prose" style="color:#6c757d;line-height:1.85;font-size:.95rem;">
                    @if($project->body)
                        {!! $project->body !!}
                    @else
                        {!! nl2br(e($project->description)) !!}
                    @endif
                </div>
            </div>

            {{-- Right: Info card --}}
            <div class="col-lg-5" data-aos="fade-left">
                <div class="p-4 rounded-3" style="background:#f8f9fa;border:1px solid #e9ecef;">
                    <h5 class="fw-bold mb-4" style="color:#0d1b2a;font-size:1rem;text-transform:uppercase;letter-spacing:1px;">
                        Thông tin dự án
                    </h5>
                    <div class="d-flex flex-column gap-3">
                        @foreach([
                            ['icon'=>'bi-person-fill','label'=>'Chủ đầu tư','value'=>$project->client ?: setting('company_name', 'Thành Nam TFC.,JSC')],
                            ['icon'=>'bi-geo-alt-fill','label'=>'Địa điểm','value'=>$project->location ?: setting('contact_address', 'Hà Nội, Việt Nam')],
                            ['icon'=>'bi-tag-fill','label'=>'Danh mục','value'=>$project->category ?: 'Hạ tầng & Nền móng'],
                            ['icon'=>'bi-tools','label'=>'Dịch vụ','value'=>$project->services ?: 'Thi công, Giám sát, Tư vấn'],
                            ['icon'=>'bi-check-circle-fill','label'=>'Trạng thái','value'=>$project->completion_status ?: 'Hoàn thành'],
                        ] as $info)
                        <div class="d-flex align-items-start gap-3 pb-3" style="border-bottom:1px solid #e9ecef;">
                            <div class="d-flex align-items-center justify-content-center rounded flex-shrink-0"
                                 style="width:36px;height:36px;background:rgba(13,27,42,.06);">
                                <i class="bi {{ $info['icon'] }}" style="color:#0d1b2a;font-size:.85rem;"></i>
                            </div>
                            <div>
                                <div style="font-size:.7rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#adb5bd;margin-bottom:.15rem;">
                                    {{ $info['label'] }}
                                </div>
                                <div style="font-size:.875rem;color:#0d1b2a;font-weight:500;">{{ $info['value'] }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     3. GALLERY
     ============================================================ --}}
<section style="padding:0 0 80px;background:#fff;">
    <div class="container">
        <h2 class="fw-bold mb-4" style="font-size:clamp(1.4rem,2.5vw,1.9rem);color:#0d1b2a;" data-aos="fade-up">
            Hình ảnh dự án
        </h2>
        <div class="row g-3">
            {{-- Large image --}}
            <div class="col-md-7" data-aos="fade-right">
                <div class="img-overlay-wrap rounded-3" style="height:380px;">
                    <img src="{{ $heroImg }}" alt="{{ $project->title }}"
                         class="w-100 h-100" style="object-fit:cover;">
                </div>
            </div>
            {{-- 2 stacked --}}
            <div class="col-md-5 d-flex flex-column gap-3" data-aos="fade-left">
                @foreach($galleryImgs as $i => $img)
                <div class="img-overlay-wrap rounded-3 flex-grow-1" style="height:182px;">
                    <img src="{{ $img }}" alt="Gallery {{ $i+1 }}"
                         class="w-100 h-100" style="object-fit:cover;">
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     4. ENGINEERING HIGHLIGHTS
     ============================================================ --}}
<section style="padding:80px 0;background:#f8f9fa;">
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-lg-5" data-aos="fade-right">
                <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;display:block;margin-bottom:.75rem;">
                    Chi tiết kỹ thuật
                </span>
                <h2 class="fw-bold mb-3" style="font-size:clamp(1.4rem,2.5vw,1.9rem);color:#0d1b2a;">
                    Điểm nổi bật kỹ thuật
                </h2>
                <p style="color:#6c757d;line-height:1.8;font-size:.95rem;">
                    Dự án được thực hiện với các tiêu chuẩn kỹ thuật cao nhất, áp dụng công nghệ tiên tiến và vật liệu chất lượng để đảm bảo độ bền và an toàn lâu dài.
                </p>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="d-flex flex-column gap-3">
                    @foreach([
                        ['icon'=>'bi-building','title'=>'Hệ thống kết cấu','desc'=>'Sử dụng hệ thống cọc bê tông cốt thép dự ứng lực, đảm bảo khả năng chịu tải cao và độ ổn định tối ưu.'],
                        ['icon'=>'bi-layers','title'=>'Vật liệu sử dụng','desc'=>'Bê tông cường độ cao B30-B40, thép cường độ cao ASTM A416, đáp ứng tiêu chuẩn TCVN và quốc tế.'],
                        ['icon'=>'bi-exclamation-triangle','title'=>'Thách thức kỹ thuật','desc'=>'Địa chất phức tạp với lớp đất yếu dày, yêu cầu giải pháp nền móng đặc biệt và kiểm soát lún chặt chẽ.'],
                        ['icon'=>'bi-lightbulb','title'=>'Giải pháp áp dụng','desc'=>'Kết hợp phương pháp ép cọc tĩnh và khoan nhồi, tối ưu hóa chi phí trong khi vẫn đảm bảo chất lượng.'],
                    ] as $i => $item)
                    <div class="d-flex gap-4 p-4 rounded-3 bg-white" style="border:1px solid #e9ecef;"
                         data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                        <div class="d-flex align-items-center justify-content-center rounded flex-shrink-0"
                             style="width:44px;height:44px;background:rgba(13,27,42,.06);">
                            <i class="bi {{ $item['icon'] }}" style="color:#0d1b2a;font-size:1rem;"></i>
                        </div>
                        <div>
                            <div class="fw-bold mb-1" style="color:#0d1b2a;font-size:.95rem;">{{ $item['title'] }}</div>
                            <div style="color:#6c757d;font-size:.875rem;line-height:1.65;">{{ $item['desc'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     5. STATISTICS
     ============================================================ --}}
<section style="padding:80px 0;background:#0d1b2a;">
    <div class="container">
        <div class="row g-4 text-center">
            @foreach([
                ['value'=>'2,500 m²','label'=>'Diện tích công trình'],
                ['value'=>'8 tháng','label'=>'Thời gian hoàn thành'],
                ['value'=>'12','label'=>'Kỹ sư tham gia'],
                ['value'=>'5 tỷ+','label'=>'Giá trị hợp đồng'],
            ] as $i => $stat)
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                @if($i > 0)
                <div style="border-left:1px solid rgba(255,255,255,.1);padding-left:1rem;">
                @else
                <div>
                @endif
                    <div class="fw-bold" style="font-size:2.2rem;color:#fff;line-height:1;">{{ $stat['value'] }}</div>
                    <div style="font-size:.8rem;color:rgba(255,255,255,.5);margin-top:.5rem;text-transform:uppercase;letter-spacing:1px;">{{ $stat['label'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     6. RELATED PROJECTS
     ============================================================ --}}
@if($related->count() > 0)
<section style="padding:80px 0;background:#fff;">
    <div class="container">
        <div class="d-flex align-items-end justify-content-between mb-5" data-aos="fade-up">
            <div>
                <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;display:block;margin-bottom:.5rem;">
                    Xem thêm
                </span>
                <h2 class="fw-bold mb-0" style="font-size:clamp(1.4rem,2.5vw,1.9rem);color:#0d1b2a;">
                    Dự án liên quan
                </h2>
            </div>
            <a href="{{ route('projects.index') }}"
               class="fw-semibold text-decoration-none d-inline-flex align-items-center gap-1"
               style="color:#0d1b2a;font-size:.875rem;white-space:nowrap;">
                Xem tất cả <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="row g-4">
            @foreach($related as $i => $rel)
            @php
            $relImg = $rel->image_path
                ? Storage::url($rel->image_path)
                : ['https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=600&q=80',
                   'https://images.unsplash.com/photo-1565008447742-97f6f38c985c?w=600&q=80',
                   'https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&q=80'][$i % 3];
            @endphp
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="rounded-3 overflow-hidden h-100 card-lift" style="border:1px solid #e9ecef;">
                    <div class="img-overlay-wrap" style="height:200px;">
                        <img src="{{ $relImg }}" alt="{{ $rel->title }}"
                             class="w-100 h-100" style="object-fit:cover;">
                    </div>
                    <div class="p-4">
                        <span style="font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#e8a020;display:block;margin-bottom:.5rem;">
                            Hạ tầng
                        </span>
                        <h6 class="fw-bold mb-2" style="color:#0d1b2a;line-height:1.4;">{{ $rel->title }}</h6>
                        <p style="color:#6c757d;font-size:.85rem;line-height:1.6;margin-bottom:1.25rem;">
                            {{ Str::limit($rel->description, 80) }}
                        </p>
                        <a href="{{ route('projects.show', $rel) }}"
                           class="d-inline-flex align-items-center gap-2 fw-semibold text-decoration-none"
                           style="font-size:.8rem;color:#0d1b2a;border-bottom:2px solid #e8a020;padding-bottom:2px;">
                            Xem dự án <i class="bi bi-arrow-right"></i>
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
     7. CTA
     ============================================================ --}}
<section style="padding:80px 0;background:#f8f9fa;">
    <div class="container">
        <div class="rounded-3 text-center text-white p-5"
             style="background:#0d1b2a;"
             data-aos="fade-up">
            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;display:block;margin-bottom:1rem;">
                Hợp tác cùng chúng tôi
            </span>
            <h2 class="fw-bold mb-3" style="font-size:clamp(1.6rem,3vw,2.2rem);">
                Bắt Đầu Dự Án Tiếp Theo
            </h2>
            <p style="color:rgba(255,255,255,.6);max-width:480px;margin:0 auto 2.5rem;line-height:1.7;">
                Hãy chia sẻ ý tưởng của bạn với chúng tôi. Đội ngũ kỹ sư sẽ tư vấn giải pháp tối ưu nhất.
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
