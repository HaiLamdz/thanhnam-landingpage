@extends('layouts.public')

@section('meta')
<title>Giới thiệu & Dịch vụ — {{ setting('company_name') }}</title>
<meta name="description" content="{{ setting('meta_description_default') }}">
@endsection

@section('content')

{{-- ============================================================
     1. HERO SECTION
     ============================================================ --}}
<section style="padding:60px 0 50px;background:#fff;">
    <div class="container">
        <div class="row align-items-center g-4 g-lg-5">

            {{-- Left: Text + Stats --}}
            <div class="col-lg-6">
                <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#e8a020;display:inline-block;margin-bottom:1rem;">
                    TINH HOA KỸ THUẬT
                </span>
                <h1 class="fw-bold mb-4" style="font-size:clamp(1.8rem,5vw,3rem);color:#0d1b2a;line-height:1.2;">
                    Định Hình Lại<br>
                    <span style="color:#e8a020;">Kiến Trúc</span><br>
                    Kết Cấu.
                </h1>
                <p style="color:#6c757d;line-height:1.8;font-size:.95rem;margin-bottom:2rem;">
                    Chúng tôi là đơn vị tiên phong trong lĩnh vực kỹ thuật công trình. Với đội ngũ chuyên gia giàu kinh nghiệm, chúng tôi cung cấp các giải pháp kỹ thuật toàn diện, đáp ứng mọi yêu cầu khắt khe nhất của thị trường.
                </p>

                {{-- Stats --}}
                <div class="row g-3">
                    <div class="col-4">
                        <div class="fw-bold" style="font-size:clamp(1.4rem,4vw,2rem);color:#0d1b2a;line-height:1;">250+</div>
                        <div style="font-size:.7rem;color:#adb5bd;margin-top:.3rem;text-transform:uppercase;letter-spacing:.5px;">Dự án</div>
                    </div>
                    <div class="col-4" style="border-left:1px solid #e9ecef;">
                        <div class="fw-bold" style="font-size:clamp(1.4rem,4vw,2rem);color:#0d1b2a;line-height:1;">15</div>
                        <div style="font-size:.7rem;color:#adb5bd;margin-top:.3rem;text-transform:uppercase;letter-spacing:.5px;">Giải thưởng</div>
                    </div>
                    <div class="col-4" style="border-left:1px solid #e9ecef;">
                        <div class="fw-bold" style="font-size:clamp(1.4rem,4vw,2rem);color:#0d1b2a;line-height:1;">40+</div>
                        <div style="font-size:.7rem;color:#adb5bd;margin-top:.3rem;text-transform:uppercase;letter-spacing:.5px;">Chuyên gia</div>
                    </div>
                </div>
            </div>

            {{-- Right: Image --}}
            <div class="col-lg-6">
                @if(setting('about_image'))
                    <img src="{{ Storage::url(setting('about_image')) }}"
                         alt="Về chúng tôi"
                         class="img-fluid rounded w-100"
                         style="max-height:420px;object-fit:cover;box-shadow:0 12px 40px rgba(0,0,0,.12);">
                @else
                    <img src="https://images.unsplash.com/photo-1486325212027-8081e485255e?w=900&q=80"
                         alt="Về chúng tôi"
                         class="img-fluid rounded w-100"
                         style="max-height:420px;object-fit:cover;box-shadow:0 12px 40px rgba(0,0,0,.12);">
                @endif
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     2. VISION & MISSION
     ============================================================ --}}
<section style="padding:80px 0;background:#f8f9fa;">
    <div class="container">

        {{-- Two cards --}}
        <div class="row g-4 mb-4">
            {{-- Vision card --}}
            <div class="col-md-6" data-aos="fade-right">
                <div class="h-100 p-5 rounded" style="background:#fff;border:1px solid #e9ecef;">
                    <div class="mb-3 d-flex align-items-center justify-content-center rounded"
                         style="width:48px;height:48px;background:rgba(232,160,32,.12);">
                        <i class="bi bi-eye" style="color:#e8a020;font-size:1.2rem;"></i>
                    </div>
                    <h4 class="fw-bold mb-3" style="color:#0d1b2a;">Tầm nhìn</h4>
                    <p style="color:#6c757d;line-height:1.8;margin-bottom:0;">
                        Trở thành đơn vị kỹ thuật công trình hàng đầu khu vực, tiên phong trong việc ứng dụng công nghệ tiên tiến để tạo ra những công trình bền vững, an toàn và thẩm mỹ cho thế hệ tương lai.
                    </p>
                </div>
            </div>

            {{-- Mission card --}}
            <div class="col-md-6" data-aos="fade-left">
                <div class="h-100 p-5 rounded" style="background:#0d1b2a;">
                    <div class="mb-3 d-flex align-items-center justify-content-center rounded"
                         style="width:48px;height:48px;background:rgba(232,160,32,.2);">
                        <i class="bi bi-bullseye" style="color:#e8a020;font-size:1.2rem;"></i>
                    </div>
                    <h4 class="fw-bold mb-3" style="color:#fff;">Sứ mệnh</h4>
                    <p style="color:rgba(255,255,255,.65);line-height:1.8;margin-bottom:0;">
                        Cung cấp các giải pháp kỹ thuật xuất sắc, đáp ứng và vượt kỳ vọng của khách hàng. Chúng tôi cam kết mang lại chất lượng tốt nhất, đúng tiến độ và trong ngân sách, đồng thời xây dựng mối quan hệ đối tác lâu dài.
                    </p>
                </div>
            </div>
        </div>

        {{-- 4 feature boxes --}}
        <div class="row g-3">
            @foreach([
                ['icon'=>'bi-shield-check','title'=>'Chính trực','desc'=>'Minh bạch và trung thực trong mọi giao dịch và quyết định.'],
                ['icon'=>'bi-lightbulb','title'=>'Đổi mới','desc'=>'Không ngừng tìm kiếm giải pháp sáng tạo cho mọi thách thức.'],
                ['icon'=>'bi-leaf','title'=>'Bền vững','desc'=>'Xây dựng với trách nhiệm với môi trường và cộng đồng.'],
                ['icon'=>'bi-crosshair','title'=>'Chính xác','desc'=>'Tỉ mỉ và chính xác trong từng chi tiết kỹ thuật.'],
            ] as $item)
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="p-4 rounded text-center h-100" style="background:#fff;border:1px solid #e9ecef;">
                    <i class="bi {{ $item['icon'] }} mb-2 d-block" style="color:#e8a020;font-size:1.4rem;"></i>
                    <div class="fw-bold mb-1" style="color:#0d1b2a;font-size:.95rem;">{{ $item['title'] }}</div>
                    <div style="color:#adb5bd;font-size:.8rem;line-height:1.5;">{{ $item['desc'] }}</div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

{{-- ============================================================
     3. EXPERTISE & SERVICES
     ============================================================ --}}
<section style="padding:80px 0;background:#fff;">
    <div class="container">

        {{-- Header row --}}
        <div class="d-flex align-items-end justify-content-between mb-5 flex-wrap gap-3" data-aos="fade-up">
            <div>
                <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;">
                    Chuyên môn
                </span>
                <h2 class="fw-bold mt-2 mb-1" style="font-size:clamp(1.6rem,3vw,2.2rem);color:#0d1b2a;">
                    Chuyên Môn &amp; Dịch Vụ
                </h2>
                <p style="color:#6c757d;font-size:.9rem;max-width:480px;margin:0;">
                    Chúng tôi cung cấp giải pháp kỹ thuật toàn diện, từ thiết kế đến thi công và quản lý dự án.
                </p>
            </div>
        </div>

        {{-- Service rows --}}
        <div class="d-flex flex-column gap-0">
            @foreach([
                ['num'=>'01','title'=>'Thiết kế & Phân tích kết cấu','desc'=>'Chúng tôi cung cấp giải pháp thiết kế kết cấu toàn diện, đảm bảo an toàn và tối ưu chi phí cho mọi loại công trình từ nhà ở đến tòa nhà thương mại.'],
                ['num'=>'02','title'=>'Kỹ thuật chống động đất','desc'=>'Phân tích và thiết kế hệ thống kháng chấn tiên tiến, bảo vệ công trình trước các tác động địa chấn và đảm bảo an toàn cho người sử dụng.'],
                ['num'=>'03','title'=>'Quản lý dự án','desc'=>'Điều phối toàn bộ quá trình từ lập kế hoạch đến nghiệm thu, đảm bảo dự án hoàn thành đúng tiến độ, trong ngân sách và đạt chất lượng cao nhất.'],
            ] as $i => $svc)
            <div class="d-flex align-items-start gap-4 py-4 {{ $i > 0 ? 'border-top' : '' }}"
                 style="border-color:#e9ecef !important;"
                 data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="fw-bold flex-shrink-0" style="font-size:1.5rem;color:#e9ecef;min-width:48px;">
                    {{ $svc['num'] }}
                </div>
                <div class="flex-grow-1">
                    <h5 class="fw-bold mb-2" style="color:#0d1b2a;">{{ $svc['title'] }}</h5>
                    <p class="mb-0" style="color:#6c757d;font-size:.9rem;line-height:1.7;">{{ $svc['desc'] }}</p>
                </div>
                <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle"
                     style="width:40px;height:40px;background:#f8f9fa;cursor:pointer;transition:.2s;"
                     onmouseover="this.style.background='#0d1b2a';this.querySelector('i').style.color='#fff'"
                     onmouseout="this.style.background='#f8f9fa';this.querySelector('i').style.color='#0d1b2a'">
                    <i class="bi bi-arrow-right" style="color:#0d1b2a;"></i>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

{{-- ============================================================
     4. PROCESS SECTION
     ============================================================ --}}
<section style="padding:80px 0;background:#0d1b2a;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;">
                Quy trình làm việc
            </span>
            <h2 class="fw-bold mt-2" style="font-size:clamp(1.6rem,3vw,2.2rem);color:#fff;">
                Quy Trình Của Chúng Tôi
            </h2>
        </div>

        <div class="row g-4">
            @foreach([
                ['icon'=>'bi-search','title'=>'Khảo sát','desc'=>'Tìm hiểu yêu cầu, phân tích địa điểm và đánh giá toàn diện các điều kiện kỹ thuật của dự án.'],
                ['icon'=>'bi-pencil-square','title'=>'Thiết kế','desc'=>'Phát triển các phương án thiết kế sáng tạo, tối ưu hóa kết cấu và đảm bảo tính khả thi.'],
                ['icon'=>'bi-calculator','title'=>'Phân tích','desc'=>'Kiểm tra và xác minh toàn bộ tính toán kỹ thuật, đảm bảo an toàn và tuân thủ tiêu chuẩn.'],
                ['icon'=>'bi-check2-circle','title'=>'Bàn giao','desc'=>'Hoàn thiện hồ sơ, giám sát thi công và bàn giao công trình đúng tiến độ, đạt chất lượng.'],
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
     5. INSIDE OUR WORLD (Projects grid)
     ============================================================ --}}
<section style="padding:80px 0;background:#fff;">
    <div class="container">
        <div class="mb-5">
            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;">
                Thế giới của chúng tôi
            </span>
            <h2 class="fw-bold mt-2" style="font-size:clamp(1.6rem,3vw,2.2rem);color:#0d1b2a;">
                Bên Trong Thế Giới Của Chúng Tôi
            </h2>
        </div>

        <div class="row g-3">
            {{-- Large image left --}}
            <div class="col-md-7" data-aos="fade-right">
                <div class="overflow-hidden rounded" style="height:420px;">
                    <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=900&q=80"
                         alt="Dự án 1" class="w-100 h-100" style="object-fit:cover;transition:transform .4s;"
                         onmouseover="this.style.transform='scale(1.04)'"
                         onmouseout="this.style.transform='scale(1)'">
                </div>
            </div>
            {{-- 2 stacked right --}}
            <div class="col-md-5 d-flex flex-column gap-3" data-aos="fade-left">
                <div class="overflow-hidden rounded flex-grow-1" style="height:200px;">
                    <img src="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=700&q=80"
                         alt="Dự án 2" class="w-100 h-100" style="object-fit:cover;transition:transform .4s;"
                         onmouseover="this.style.transform='scale(1.04)'"
                         onmouseout="this.style.transform='scale(1)'">
                </div>
                <div class="overflow-hidden rounded flex-grow-1" style="height:200px;">
                    <img src="https://images.unsplash.com/photo-1590674899484-d5640e854abe?w=700&q=80"
                         alt="Dự án 3" class="w-100 h-100" style="object-fit:cover;transition:transform .4s;"
                         onmouseover="this.style.transform='scale(1.04)'"
                         onmouseout="this.style.transform='scale(1)'">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     6. TEAM SECTION
     ============================================================ --}}
<section style="padding:80px 0;background:#f8f9fa;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;">
                Đội ngũ
            </span>
            <h2 class="fw-bold mt-2" style="font-size:clamp(1.6rem,3vw,2.2rem);color:#0d1b2a;">
                Những Người Đứng Sau Thành Công
            </h2>
            <p style="color:#6c757d;max-width:480px;margin:1rem auto 0;font-size:.95rem;line-height:1.7;">
                Đội ngũ chuyên gia tài năng, giàu kinh nghiệm và đam mê với nghề.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach([
                ['name'=>'Nguyễn Minh Tuấn','role'=>'Giám đốc điều hành','img'=>'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&q=80'],
                ['name'=>'Trần Thị Hương','role'=>'Giám đốc thiết kế','img'=>'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&q=80'],
                ['name'=>'Lê Văn Khoa','role'=>'Trưởng dự án','img'=>'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&q=80'],
                ['name'=>'Phạm Thu Nga','role'=>'Trưởng kỹ thuật','img'=>'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=400&q=80'],
            ] as $member)
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="text-center">
                    <div class="overflow-hidden rounded mb-3 mx-auto" style="width:100%;max-width:220px;height:240px;">
                        <img src="{{ $member['img'] }}" alt="{{ $member['name'] }}"
                             class="w-100 h-100" style="object-fit:cover;filter:grayscale(30%);transition:.3s;"
                             onmouseover="this.style.filter='grayscale(0%)';this.style.transform='scale(1.04)'"
                             onmouseout="this.style.filter='grayscale(30%)';this.style.transform='scale(1)'">
                    </div>
                    <div class="fw-bold" style="color:#0d1b2a;">{{ $member['name'] }}</div>
                    <div style="font-size:.8rem;color:#e8a020;font-weight:600;text-transform:uppercase;letter-spacing:1px;margin-top:.2rem;">
                        {{ $member['role'] }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     7. CTA SECTION
     ============================================================ --}}
<section style="padding:80px 0;background:#f8f9fa;">
    <div class="container">
        <div class="rounded-3 text-center text-white p-5 p-md-6"
             style="background:#0d1b2a;padding:80px 40px !important;"
             data-aos="fade-up">
            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;display:block;margin-bottom:1rem;">
                Bắt đầu ngay
            </span>
            <h2 class="fw-bold mb-3" style="font-size:clamp(1.6rem,3vw,2.2rem);">
                Sẵn Sàng Xây Dựng Tương Lai?
            </h2>
            <p style="color:rgba(255,255,255,.6);max-width:480px;margin:0 auto 2.5rem;line-height:1.7;">
                Hãy chia sẻ dự án của bạn với chúng tôi. Đội ngũ chuyên gia sẽ tư vấn giải pháp tối ưu nhất cho công trình của bạn.
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('contact.index') }}"
                   class="btn btn-lg fw-semibold px-5"
                   style="background:transparent;color:#fff;border:2px solid rgba(255,255,255,.3);border-radius:6px;">
                    Liên hệ tư vấn
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
