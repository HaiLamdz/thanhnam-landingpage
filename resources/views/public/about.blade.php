@extends('layouts.public')

@section('meta')
<title>Giới thiệu — {{ setting('company_name', 'Thành Nam TFC') }}</title>
<meta name="description" content="Công ty Cổ phần Thương mại Xây dựng Nền Móng Thành Nam - Chuyên thi công ép cọc, nền móng, thí nghiệm vật liệu xây dựng.">
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
                    Công Ty CPTM<br>
                    <span style="color:#e8a020;">Xây Dựng Nền Móng</span><br>
                    Thành Nam
                </h1>
                <p style="color:#6c757d;line-height:1.8;font-size:.95rem;margin-bottom:2rem;">
                    Thành lập năm 2014, chúng tôi chuyên hoạt động trong lĩnh vực xây dựng và nền móng với đội ngũ cán bộ chuyên ngành nhiều năm kinh nghiệm. Cam kết thực hiện dự án theo tiêu chí: <strong>An toàn – Tiến độ – Chất lượng – Giá cả cạnh tranh.</strong>
                </p>

                {{-- Stats --}}
                <div class="row g-3 mb-4">
                    <div class="col-4">
                        <div class="fw-bold" style="font-size:clamp(1.4rem,4vw,2rem);color:#0d1b2a;line-height:1;">10+</div>
                        <div style="font-size:.7rem;color:#adb5bd;margin-top:.3rem;text-transform:uppercase;letter-spacing:.5px;">Năm kinh nghiệm</div>
                    </div>
                    <div class="col-4" style="border-left:1px solid #e9ecef;">
                        <div class="fw-bold" style="font-size:clamp(1.4rem,4vw,2rem);color:#0d1b2a;line-height:1;">15+</div>
                        <div style="font-size:.7rem;color:#adb5bd;margin-top:.3rem;text-transform:uppercase;letter-spacing:.5px;">Dự án tiêu biểu</div>
                    </div>
                    <div class="col-4" style="border-left:1px solid #e9ecef;">
                        <div class="fw-bold" style="font-size:clamp(1.4rem,4vw,2rem);color:#0d1b2a;line-height:1;">10+</div>
                        <div style="font-size:.7rem;color:#adb5bd;margin-top:.3rem;text-transform:uppercase;letter-spacing:.5px;">Chuyên gia</div>
                    </div>
                </div>

                {{-- Download button --}}
                <a href="{{ asset('pdf/ho-so-nang-luc.pdf') }}"
                   download
                   class="d-inline-flex align-items-center gap-2 fw-semibold text-decoration-none px-4 py-2 rounded"
                   style="background:#e8a020;color:#fff;font-size:.9rem;border:2px solid #e8a020;transition:.2s;"
                   onmouseover="this.style.background='#cf8c18';this.style.borderColor='#cf8c18'"
                   onmouseout="this.style.background='#e8a020';this.style.borderColor='#e8a020'">
                    <i class="bi bi-download"></i> Tải hồ sơ năng lực (PDF)
                </a>
            </div>

            {{-- Right: Image --}}
            <div class="col-lg-6">
                @if(setting('about_image'))
                    <img src="{{ Storage::url(setting('about_image')) }}"
                         alt="Về chúng tôi"
                         class="img-fluid rounded w-100"
                         style="max-height:420px;object-fit:cover;box-shadow:0 12px 40px rgba(0,0,0,.12);">
                @else
                    <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=900&q=80"
                         alt="Về chúng tôi"
                         class="img-fluid rounded w-100"
                         style="max-height:420px;object-fit:cover;box-shadow:0 12px 40px rgba(0,0,0,.12);">
                @endif
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     2. THÔNG TIN CHUNG
     ============================================================ --}}
<section style="padding:80px 0;background:#f8f9fa;">
    <div class="container">
        <div class="row g-4">
            {{-- Info cards --}}
            <div class="col-lg-7" data-aos="fade-right">
                <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;">
                    Thông tin công ty
                </span>
                <h2 class="fw-bold mt-2 mb-4" style="font-size:clamp(1.4rem,3vw,2rem);color:#0d1b2a;">
                    Thông Tin Chung
                </h2>
                <div class="row g-3">
                    @foreach([
                        ['icon'=>'bi-building','label'=>'Tên công ty',   'value'=>'Công ty Cổ phần Thương mại Xây dựng Nền Móng Thành Nam'],
                        ['icon'=>'bi-tag',     'label'=>'Tên viết tắt',  'value'=>'Thành Nam TFC., JSC.'],
                        ['icon'=>'bi-geo-alt', 'label'=>'Địa chỉ',       'value'=>'Số 12/3/33 ngõ 2 phố Văn Trì, Phường Tây Tựu, TP. Hà Nội'],
                        ['icon'=>'bi-file-text','label'=>'Mã số thuế',   'value'=>'0201574928'],
                        ['icon'=>'bi-envelope','label'=>'Email',          'value'=>'Thanhnam.tfc@gmail.com'],
                        ['icon'=>'bi-telephone','label'=>'Điện thoại',   'value'=>'0972.428.939'],
                        ['icon'=>'bi-bank',    'label'=>'Số tài khoản',  'value'=>'19037066281010 — Techcombank CN Nguyễn Cơ Thạch'],
                    ] as $info)
                    <div class="col-12">
                        <div class="d-flex align-items-start gap-3 p-3 rounded bg-white" style="border:1px solid #e9ecef;">
                            <div class="d-flex align-items-center justify-content-center rounded flex-shrink-0"
                                 style="width:38px;height:38px;background:rgba(232,160,32,.1);">
                                <i class="bi {{ $info['icon'] }}" style="color:#e8a020;font-size:1rem;"></i>
                            </div>
                            <div>
                                <div style="font-size:.72rem;color:#adb5bd;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.15rem;">{{ $info['label'] }}</div>
                                <div style="color:#0d1b2a;font-weight:500;font-size:.9rem;">{{ $info['value'] }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Giá trị cốt lõi --}}
            <div class="col-lg-5" data-aos="fade-left">
                <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;">
                    Cam kết
                </span>
                <h2 class="fw-bold mt-2 mb-4" style="font-size:clamp(1.4rem,3vw,2rem);color:#0d1b2a;">
                    Giá Trị Cốt Lõi
                </h2>
                <div class="row g-3">
                    @foreach([
                        ['icon'=>'bi-shield-check','title'=>'An toàn','desc'=>'Đặt an toàn lao động và công trình lên hàng đầu trong mọi dự án.'],
                        ['icon'=>'bi-clock','title'=>'Tiến độ','desc'=>'Cam kết hoàn thành đúng hạn, không để khách hàng chờ đợi.'],
                        ['icon'=>'bi-award','title'=>'Chất lượng','desc'=>'Tiêu chuẩn kỹ thuật cao, vật liệu đạt chuẩn, thi công chuyên nghiệp.'],
                        ['icon'=>'bi-currency-dollar','title'=>'Giá cạnh tranh','desc'=>'Chi phí hợp lý, minh bạch, tối ưu giá trị cho khách hàng.'],
                    ] as $item)
                    <div class="col-6">
                        <div class="p-3 rounded h-100" style="background:#fff;border:1px solid #e9ecef;">
                            <i class="bi {{ $item['icon'] }} mb-2 d-block" style="color:#e8a020;font-size:1.3rem;"></i>
                            <div class="fw-bold mb-1" style="color:#0d1b2a;font-size:.9rem;">{{ $item['title'] }}</div>
                            <div style="color:#adb5bd;font-size:.8rem;line-height:1.5;">{{ $item['desc'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     3. LĨNH VỰC HOẠT ĐỘNG
     ============================================================ --}}
<section style="padding:80px 0;background:#fff;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;">
                Chuyên môn
            </span>
            <h2 class="fw-bold mt-2" style="font-size:clamp(1.6rem,3vw,2.2rem);color:#0d1b2a;">
                Lĩnh Vực Hoạt Động
            </h2>
        </div>

        <div class="d-flex flex-column gap-0">
            @foreach([
                [
                    'num' => '01',
                    'title' => 'Thi công ép cọc bê tông',
                    'desc' => 'Thi công nền móng công trình các loại. Sản xuất và thi công ép cọc bê tông cốt thép (200×200, 250×250, 300×300, 400×400 mm). Sản xuất và thi công ép cọc bê tông ly tâm dự ứng lực (D300, D400, D500, D600 mm). Cho thuê máy khoan cọc nhồi và Robot thi công ép cọc từ 100 đến 680 tấn.',
                    'icon' => 'bi-hammer'
                ],
                [
                    'num' => '02',
                    'title' => 'Kiểm tra & tư vấn nền móng công trình',
                    'desc' => 'Thí nghiệm sức chịu tải cọc bằng phương pháp ép tĩnh dọc trục, nhổ dọc trục, đẩy ngang, siêu âm, PDA, PIT. Kiểm tra nền đất bằng phương pháp xác định Modun biến dạng tấm nén phẳng. Khoan khảo sát địa chất công trình.',
                    'icon' => 'bi-search'
                ],
                [
                    'num' => '03',
                    'title' => 'Xây dựng công trình',
                    'desc' => 'Cung cấp và ép các loại cọc bê tông cốt thép, bê tông dự ứng lực. Xây dựng các công trình nhà văn hóa, trường học, thủy lợi và hạ tầng kỹ thuật.',
                    'icon' => 'bi-building'
                ],
                [
                    'num' => '04',
                    'title' => 'Thí nghiệm vật liệu xây dựng',
                    'desc' => 'Thí nghiệm vật liệu xây dựng dân dụng tại phòng thí nghiệm và ngoài hiện trường. Thí nghiệm vật liệu chuyên ngành cầu đường. Được Bộ Xây dựng cấp phép hoạt động thí nghiệm chuyên ngành xây dựng LAXD 1780 (cấp ngày 25/06/2021).',
                    'icon' => 'bi-clipboard-data'
                ],
            ] as $i => $svc)
            <div class="d-flex align-items-start gap-4 py-4 {{ $i > 0 ? 'border-top' : '' }}"
                 style="border-color:#e9ecef !important;"
                 data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                <div class="fw-bold flex-shrink-0" style="font-size:1.5rem;color:#e9ecef;min-width:48px;">
                    {{ $svc['num'] }}
                </div>
                <div class="flex-grow-1">
                    <h5 class="fw-bold mb-2" style="color:#0d1b2a;">
                        <i class="bi {{ $svc['icon'] }} me-2" style="color:#e8a020;"></i>{{ $svc['title'] }}
                    </h5>
                    <p class="mb-0" style="color:#6c757d;font-size:.9rem;line-height:1.7;">{{ $svc['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     4. BỘ MÁY QUẢN LÝ
     ============================================================ --}}
<section style="padding:80px 0;background:#0d1b2a;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;">
                Đội ngũ
            </span>
            <h2 class="fw-bold mt-2" style="font-size:clamp(1.6rem,3vw,2.2rem);color:#fff;">
                Nhân Lực Chính
            </h2>
            <p style="color:rgba(255,255,255,.5);max-width:480px;margin:.5rem auto 0;font-size:.9rem;">
                Đội ngũ kỹ sư và chuyên gia giàu kinh nghiệm, tận tâm với nghề.
            </p>
        </div>

        <div class="row g-3 justify-content-center">
            @foreach([
                ['name'=>'KS. Trịnh Viết Dũng',    'role'=>'Giám đốc',              'degree'=>'Kỹ sư xây dựng'],
                ['name'=>'KS. Vũ Thái Bảo',         'role'=>'Phó Giám đốc',          'degree'=>'Kỹ sư xây dựng'],
                ['name'=>'Đặng Thị Thu Hằng',        'role'=>'Kế toán trưởng',        'degree'=>'Cử nhân'],
                ['name'=>'Trần Thị Hoài Linh',       'role'=>'Kế toán',               'degree'=>'Cử nhân'],
                ['name'=>'KS. Nguyễn Cao Cường',     'role'=>'Trưởng phòng kỹ thuật', 'degree'=>'Kỹ sư địa chất'],
                ['name'=>'KS. Trần Văn Biên',        'role'=>'Cán bộ kỹ thuật',       'degree'=>'Kỹ sư địa chất'],
                ['name'=>'KS. Phan Thị Phương',      'role'=>'Cán bộ kỹ thuật',       'degree'=>'Kỹ sư xây dựng'],
                ['name'=>'KS. Đặng Ngọc Cương',      'role'=>'Cán bộ kỹ thuật',       'degree'=>'Kỹ sư xây dựng'],
                ['name'=>'KS. Đặng Công Thành',      'role'=>'Cán bộ kỹ thuật',       'degree'=>'Kỹ sư cấp thoát nước'],
                ['name'=>'KS. Nguyễn Văn Cường',     'role'=>'Cán bộ kỹ thuật',       'degree'=>'Kỹ sư xây dựng'],
            ] as $i => $member)
            <div class="col-md-2 col-sm-4 col-6" data-aos="fade-up" data-aos-delay="{{ ($i % 5) * 80 }}">
                <div class="text-center p-3 rounded" style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);">
                    <div class="d-flex align-items-center justify-content-center rounded-circle mx-auto mb-2"
                         style="width:48px;height:48px;background:rgba(232,160,32,.15);border:1px solid rgba(232,160,32,.3);">
                        <i class="bi bi-person" style="color:#e8a020;font-size:1.2rem;"></i>
                    </div>
                    <div class="fw-bold" style="color:#fff;font-size:.85rem;">{{ $member['name'] }}</div>
                    <div style="font-size:.75rem;color:#e8a020;font-weight:600;margin-top:.2rem;">{{ $member['role'] }}</div>
                    <div style="font-size:.7rem;color:rgba(255,255,255,.4);margin-top:.1rem;">{{ $member['degree'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     5. THIẾT BỊ NỀN MÓNG & THÍ NGHIỆM
     ============================================================ --}}
<section style="padding:80px 0;background:#f8f9fa;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;">
                Năng lực thiết bị
            </span>
            <h2 class="fw-bold mt-2" style="font-size:clamp(1.6rem,3vw,2.2rem);color:#0d1b2a;">
                Thiết Bị & Máy Móc
            </h2>
        </div>

        {{-- Bảng 1: Thiết bị nền móng --}}
        <div class="mb-5" data-aos="fade-up">
            <h5 class="fw-bold mb-3" style="color:#0d1b2a;">
                <i class="bi bi-gear-fill me-2" style="color:#e8a020;"></i>Thiết bị hoạt động lĩnh vực nền móng, địa chất công trình
            </h5>
            <div class="table-responsive rounded" style="border:1px solid #e9ecef;">
                <table class="table table-hover mb-0" style="font-size:.875rem;">
                    <thead style="background:#0d1b2a;color:#fff;">
                        <tr>
                            <th class="py-3 px-4">Thiết bị</th>
                            <th class="py-3 px-3 text-center">Công suất</th>
                            <th class="py-3 px-3 text-center">Số lượng</th>
                            <th class="py-3 px-3 text-center">Chất lượng còn lại</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach([
                            ['name'=>'Máy robot ép cọc (sản xuất tại Trung Quốc)',          'power'=>'320, 420, 680 tấn', 'qty'=>'15',       'quality'=>'92%'],
                            ['name'=>'Kích thủy lực KN1000 (sản xuất tại Mỹ)',              'power'=>'1.000 tấn',         'qty'=>'02',       'quality'=>'97%'],
                            ['name'=>'Cẩu Kato (sản xuất tại Nhật)',                        'power'=>'25 tấn',            'qty'=>'01',       'quality'=>'85%'],
                            ['name'=>'Máy khoan địa chất XY-1, XY1A-4',                    'power'=>'—',                 'qty'=>'05',       'quality'=>'90%'],
                            ['name'=>'Kích thủy lực KN800, 500, 300, 200, 100 (TQ, VN)',   'power'=>'800 tấn',           'qty'=>'20',       'quality'=>'95%'],
                            ['name'=>'Máy phát điện (sản xuất tại Nhật Bản)',               'power'=>'5–15 kW',           'qty'=>'05',       'quality'=>'95%'],
                            ['name'=>'Máy toàn đạc điện tử Nikon DTM-350 (Nhật Bản)',      'power'=>'—',                 'qty'=>'05',       'quality'=>'95%'],
                            ['name'=>'Máy thủy chuẩn AL 32 (sản xuất tại Nhật Bản)',       'power'=>'—',                 'qty'=>'05',       'quality'=>'95%'],
                            ['name'=>'Đối trọng đúc sẵn (sản xuất tại Việt Nam)',           'power'=>'—',                 'qty'=>'2.000 tấn','quality'=>'95%'],
                            ['name'=>'Dầm chính I (sản xuất tại Việt Nam)',                 'power'=>'—',                 'qty'=>'20',       'quality'=>'99%'],
                            ['name'=>'Dầm phụ I (sản xuất tại Việt Nam)',                   'power'=>'—',                 'qty'=>'10',       'quality'=>'99%'],
                            ['name'=>'Tôn gối kê (sản xuất tại Việt Nam)',                  'power'=>'—',                 'qty'=>'10',       'quality'=>'98%'],
                            ['name'=>'Đồng hồ áp suất (sản xuất tại Trung Quốc)',           'power'=>'60 MPa',            'qty'=>'15',       'quality'=>'99%'],
                            ['name'=>'Đồng hồ đo lún (sản xuất tại Trung Quốc)',            'power'=>'50 mm',             'qty'=>'30',       'quality'=>'99%'],
                            ['name'=>'Máy PDA (sản xuất tại Trung Quốc)',                   'power'=>'—',                 'qty'=>'02',       'quality'=>'99%'],
                            ['name'=>'Máy PIT',                                             'power'=>'—',                 'qty'=>'04',       'quality'=>'98%'],
                        ] as $row)
                        <tr>
                            <td class="px-4 py-2">{{ $row['name'] }}</td>
                            <td class="px-3 py-2 text-center" style="color:#6c757d;">{{ $row['power'] }}</td>
                            <td class="px-3 py-2 text-center fw-bold" style="color:#0d1b2a;">{{ $row['qty'] }}</td>
                            <td class="px-3 py-2 text-center">
                                <span class="fw-bold" style="color:#e8a020;">{{ $row['quality'] }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Bảng 2: Thiết bị thí nghiệm vật liệu --}}
        <div data-aos="fade-up">
            <h5 class="fw-bold mb-3" style="color:#0d1b2a;">
                <i class="bi bi-flask me-2" style="color:#e8a020;"></i>Thiết bị thí nghiệm vật liệu & kiểm định công trình
            </h5>
            <div class="table-responsive rounded" style="border:1px solid #e9ecef;">
                <table class="table table-hover mb-0" style="font-size:.875rem;">
                    <thead style="background:#0d1b2a;color:#fff;">
                        <tr>
                            <th class="py-3 px-4">Tên thiết bị</th>
                            <th class="py-3 px-3 text-center">Đơn vị</th>
                            <th class="py-3 px-3 text-center">Số lượng</th>
                            <th class="py-3 px-4">Chức năng sử dụng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background:#f8f9fa;">
                            <td colspan="4" class="px-4 py-2 fw-bold" style="color:#0d1b2a;">I. Thiết bị kiểm tra kết cấu công trình</td>
                        </tr>
                        @foreach([
                            ['name'=>'Máy siêu âm chiều dày lớp bê tông, bảo vệ đường kính cốt thép','unit'=>'Chiếc','qty'=>'01','func'=>'Kiểm tra đánh giá chất lượng kết cấu BTCT'],
                            ['name'=>'Súng bật nẩy, máy siêu âm bê tông',                            'unit'=>'Chiếc','qty'=>'01','func'=>'Kiểm tra chất lượng bê tông'],
                            ['name'=>'Máy siêu âm khuyết tật mối hàn',                               'unit'=>'Chiếc','qty'=>'01','func'=>'Kiểm tra chất lượng mối hàn'],
                        ] as $row)
                        <tr>
                            <td class="px-4 py-2">{{ $row['name'] }}</td>
                            <td class="px-3 py-2 text-center" style="color:#6c757d;">{{ $row['unit'] }}</td>
                            <td class="px-3 py-2 text-center fw-bold" style="color:#0d1b2a;">{{ $row['qty'] }}</td>
                            <td class="px-4 py-2" style="color:#6c757d;">{{ $row['func'] }}</td>
                        </tr>
                        @endforeach
                        <tr style="background:#f8f9fa;">
                            <td colspan="4" class="px-4 py-2 fw-bold" style="color:#0d1b2a;">II. Thiết bị thí nghiệm vật liệu xây dựng</td>
                        </tr>
                        @foreach([
                            ['name'=>'Cân phân tích 0.001g',                'unit'=>'Chiếc','qty'=>'01','func'=>'Cân mẫu có trọng lượng < 200g'],
                            ['name'=>'Máy thử thấm bê tông',                'unit'=>'Chiếc','qty'=>'05','func'=>'Thử thấm bê tông'],
                            ['name'=>'Máy thử kéo nén WEW-1000B',           'unit'=>'Chiếc','qty'=>'02','func'=>'Thí nghiệm kéo nén'],
                            ['name'=>'Máy nén',                             'unit'=>'Chiếc','qty'=>'03','func'=>'Xác định cường độ bê tông'],
                            ['name'=>'Máy sàng, bộ sàng',                   'unit'=>'Chiếc','qty'=>'01','func'=>'Kiểm tra cốt liệu'],
                            ['name'=>'Máy nén vữa TYA-300',                 'unit'=>'Chiếc','qty'=>'—', 'func'=>'Kiểm tra cường độ'],
                            ['name'=>'Máy CBR',                             'unit'=>'Chiếc','qty'=>'01','func'=>'Kiểm tra nén mẫu CBR'],
                            ['name'=>'Bộ dụng cụ thí nghiệm Bentonite',     'unit'=>'Bộ',   'qty'=>'02','func'=>'Thí nghiệm Bentonite'],
                            ['name'=>'Thùng chưng hấp mẫu bê tông xi măng','unit'=>'Chiếc','qty'=>'01','func'=>'Bảo dưỡng bê tông mẫu'],
                            ['name'=>'Máy khoan rút lõi bê tông',           'unit'=>'Chiếc','qty'=>'02','func'=>'Khoan rút lõi bê tông'],
                            ['name'=>'Thiết bị chế tạo bê tông',            'unit'=>'Chiếc','qty'=>'01','func'=>'Chế tạo thử mẫu'],
                        ] as $row)
                        <tr>
                            <td class="px-4 py-2">{{ $row['name'] }}</td>
                            <td class="px-3 py-2 text-center" style="color:#6c757d;">{{ $row['unit'] }}</td>
                            <td class="px-3 py-2 text-center fw-bold" style="color:#0d1b2a;">{{ $row['qty'] }}</td>
                            <td class="px-4 py-2" style="color:#6c757d;">{{ $row['func'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <p class="mt-3" style="color:#adb5bd;font-size:.8rem;font-style:italic;">
                * Trên đây là những thiết bị tiêu biểu. Công ty còn có thêm thiết bị chưa liệt kê và có thể liên kết, liên danh hợp tác cho các dự án lớn khi cần thiết.
            </p>
        </div>
    </div>
</section>

{{-- ============================================================
     6. MỘT SỐ HÌNH ẢNH HOẠT ĐỘNG
     ============================================================ --}}
<section style="padding:80px 0;background:#fff;">
    <div class="container">
        <div class="mb-5">
            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;">
                Thực tế thi công
            </span>
            <h2 class="fw-bold mt-2" style="font-size:clamp(1.6rem,3vw,2.2rem);color:#0d1b2a;">
                Hình Ảnh Hoạt Động
            </h2>
        </div>

        <div class="row g-3">
            <div class="col-md-7" data-aos="fade-right">
                <div class="overflow-hidden rounded" style="height:420px;">
                    <img src="{{ asset('images/Aspose.Words.4bc199bf-9f3d-489a-a241-0b9706d15e84.033.png') }}"
                         alt="Thi công ép cọc Thành Nam" class="w-100 h-100" style="object-fit:cover;transition:transform .4s;"
                         onmouseover="this.style.transform='scale(1.04)'"
                         onmouseout="this.style.transform='scale(1)'">
                </div>
            </div>
            <div class="col-md-5 d-flex flex-column gap-3" data-aos="fade-left">
                <div class="overflow-hidden rounded flex-grow-1" style="height:200px;">
                    <img src="{{ asset('images/Aspose.Words.4bc199bf-9f3d-489a-a241-0b9706d15e84.034.png') }}"
                         alt="Công trình nền móng Thành Nam" class="w-100 h-100" style="object-fit:cover;transition:transform .4s;"
                         onmouseover="this.style.transform='scale(1.04)'"
                         onmouseout="this.style.transform='scale(1)'">
                </div>
                <div class="overflow-hidden rounded flex-grow-1" style="height:200px;">
                    <img src="{{ asset('images/Aspose.Words.4bc199bf-9f3d-489a-a241-0b9706d15e84.035.png') }}"
                         alt="Hoạt động thi công Thành Nam" class="w-100 h-100" style="object-fit:cover;transition:transform .4s;"
                         onmouseover="this.style.transform='scale(1.04)'"
                         onmouseout="this.style.transform='scale(1)'">
                </div>
            </div>
        </div>

        {{-- 4th image full width --}}
        <div class="row g-3 mt-0" data-aos="fade-up">
            <div class="col-12">
                <div class="overflow-hidden rounded">
                    <img src="{{ asset('images/Aspose.Words.4bc199bf-9f3d-489a-a241-0b9706d15e84.036.jpeg') }}"
                         alt="Ép cọc bê tông Thành Nam" class="w-100 h-100"
                         style="object-fit:cover;object-position:center 30%;transition:transform .4s;"
                         onmouseover="this.style.transform='scale(1.02)'"
                         onmouseout="this.style.transform='scale(1)'">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     8. CTA
     ============================================================ --}}
<section style="padding:80px 0;background:#f8f9fa;">
    <div class="container">
        <div class="rounded-3 text-center text-white p-5"
             style="background:#0d1b2a;padding:80px 40px !important;"
             data-aos="fade-up">
            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;display:block;margin-bottom:1rem;">
                Bắt đầu ngay
            </span>
            <h2 class="fw-bold mb-3" style="font-size:clamp(1.6rem,3vw,2.2rem);">
                Sẵn Sàng Hợp Tác Cùng Chúng Tôi?
            </h2>
            <p style="color:rgba(255,255,255,.6);max-width:480px;margin:0 auto 2.5rem;line-height:1.7;">
                Liên hệ ngay để được tư vấn giải pháp nền móng và thi công phù hợp nhất cho công trình của bạn.
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('contact.index') }}"
                   class="btn btn-lg fw-semibold px-5"
                   style="background:transparent;color:#fff;border:2px solid rgba(255,255,255,.3);border-radius:6px;">
                    Liên hệ tư vấn
                </a>
                <a href="{{ asset('pdf/ho-so-nang-luc.pdf') }}"
                   download
                   class="btn btn-lg fw-semibold px-5 d-inline-flex align-items-center gap-2"
                   style="background:#e8a020;color:#fff;border:2px solid #e8a020;border-radius:6px;">
                    <i class="bi bi-download"></i> Tải hồ sơ năng lực
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
