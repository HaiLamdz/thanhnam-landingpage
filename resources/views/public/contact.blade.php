@extends('layouts.public')

@section('meta')
<title>Liên hệ — {{ setting('company_name') }}</title>
<meta name="description" content="{{ setting('meta_description_default') }}">
@endsection

@section('content')

{{-- ============================================================
     1. HERO
     ============================================================ --}}
<section style="
    min-height:320px;
    display:flex;
    align-items:center;
    background-color:#0d1b2a;
    background-image:url('https://images.unsplash.com/photo-1486325212027-8081e485255e?w=1600&q=80');
    background-size:cover;
    background-position:center;
    position:relative;">
    <div style="position:absolute;inset:0;background:rgba(10,20,40,.78);"></div>
    <div class="container position-relative py-5" style="z-index:1;">
        <div class="col-lg-7">
            <h1 class="fw-bold text-white mb-3" style="font-size:clamp(2rem,4vw,3rem);line-height:1.15;">
                Liên Hệ Với Chúng Tôi
            </h1>
            <p style="color:rgba(255,255,255,.65);font-size:1.05rem;line-height:1.75;max-width:520px;margin:0;">
                Hợp tác cùng đội ngũ kỹ thuật của chúng tôi để mang lại sự chính xác, bền vững và xuất sắc về kết cấu cho dự án tiếp theo của bạn.
            </p>
        </div>
    </div>
</section>

{{-- ============================================================
     2. MAIN CONTACT SECTION
     ============================================================ --}}
<section style="background:#f4f5f7;padding:80px 0;">
    <div class="container">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-5">

            {{-- Left: Info --}}
            <div class="col-lg-4" data-aos="fade-right">
                <h2 class="fw-bold mb-2" style="font-size:1.5rem;color:#0d1b2a;">Liên Hệ Trụ Sở</h2>
                <p style="color:#6c757d;font-size:.875rem;line-height:1.7;margin-bottom:2rem;">
                    Đội ngũ của chúng tôi làm việc từ Thứ Hai đến Thứ Sáu, 8:00 SA đến 6:00 CH để tư vấn kỹ thuật.
                </p>

                {{-- Info cards --}}
                <div class="d-flex flex-column gap-3">

                    <div class="d-flex align-items-start gap-3 p-3 rounded-3" style="background:#fff;border:1px solid #e9ecef;"
                         data-aos="fade-up" data-aos-delay="0">
                        <div class="d-flex align-items-center justify-content-center rounded flex-shrink-0"
                             style="width:40px;height:40px;background:rgba(232,160,32,.12);">
                            <i class="bi bi-geo-alt-fill" style="color:#e8a020;"></i>
                        </div>
                        <div>
                            <div class="fw-bold mb-1" style="font-size:.875rem;color:#0d1b2a;">Trụ sở chính</div>
                            <div style="font-size:.8rem;color:#6c757d;line-height:1.6;">
                                {{ setting('contact_address', '1200 Innovation Parkway, Suite 400, London, EC1A 1BB, UK') }}
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3 p-3 rounded-3" style="background:#fff;border:1px solid #e9ecef;"
                         data-aos="fade-up" data-aos-delay="100">
                        <div class="d-flex align-items-center justify-content-center rounded flex-shrink-0"
                             style="width:40px;height:40px;background:rgba(13,27,42,.06);">
                            <i class="bi bi-telephone-fill" style="color:#0d1b2a;"></i>
                        </div>
                        <div>
                            <div class="fw-bold mb-1" style="font-size:.875rem;color:#0d1b2a;">Đường dây kỹ thuật</div>
                            <a href="tel:{{ setting('contact_phone', '+84000000000') }}"
                               class="text-decoration-none" style="font-size:.8rem;color:#6c757d;">
                                {{ setting('contact_phone', '+44 (0) 20 7946 0123') }}
                            </a>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3 p-3 rounded-3" style="background:#fff;border:1px solid #e9ecef;"
                         data-aos="fade-up" data-aos-delay="200">
                        <div class="d-flex align-items-center justify-content-center rounded flex-shrink-0"
                             style="width:40px;height:40px;background:rgba(232,160,32,.12);">
                            <i class="bi bi-envelope-fill" style="color:#e8a020;"></i>
                        </div>
                        <div>
                            <div class="fw-bold mb-1" style="font-size:.875rem;color:#0d1b2a;">Yêu cầu dự án</div>
                            <a href="mailto:{{ setting('contact_email', 'projects@structura.engineering') }}"
                               class="text-decoration-none" style="font-size:.8rem;color:#6c757d;">
                                {{ setting('contact_email', 'projects@structura.engineering') }}
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Right: Form --}}
            <div class="col-lg-8" data-aos="fade-left">
                <div class="p-4 p-md-5 rounded-3" style="background:#fff;box-shadow:0 4px 24px rgba(0,0,0,.06);">
                    <style>
                        .contact-form ::placeholder { color: #ced4da; opacity: 1; }
                        .contact-form ::-ms-input-placeholder { color: #ced4da; }
                    </style>
                    <form action="{{ route('contact.store') }}" method="POST" novalidate class="contact-form">
                        @csrf
                        <div class="row g-3">

                            {{-- Row 1: Name + Email --}}
                            <div class="col-md-6">
                                <label class="form-label" style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#0d1b2a;">
                                    Họ và tên
                                </label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Nguyễn Văn A"
                                       required minlength="2" maxlength="255"
                                       style="border-color:#e9ecef;border-radius:6px;padding:.7rem 1rem;">
                                <div class="invalid-feedback">@error('name'){{ $message }}@else Vui lòng nhập họ tên.@enderror</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#0d1b2a;">
                                    Địa chỉ email
                                </label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="ten@congty.com"
                                       required maxlength="255"
                                       style="border-color:#e9ecef;border-radius:6px;padding:.7rem 1rem;">
                                <div class="invalid-feedback">@error('email'){{ $message }}@else Vui lòng nhập email hợp lệ.@enderror</div>
                            </div>

                            {{-- Row 2: Service + Budget --}}
                            <div class="col-md-6">
                                <label class="form-label" style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#0d1b2a;">
                                    Dịch vụ quan tâm
                                </label>
                                <select name="subject" class="form-select @error('subject') is-invalid @enderror"
                                        required
                                        style="border-color:#e9ecef;border-radius:6px;padding:.7rem 1rem;">
                                    <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Chọn dịch vụ...</option>
                                    @foreach(\App\Models\Service::published()->ordered()->get() as $svc)
                                    <option value="{{ $svc->title }}" {{ old('subject') == $svc->title ? 'selected' : '' }}>
                                        {{ $svc->title }}
                                    </option>
                                    @endforeach
                                    <option value="Khác" {{ old('subject') == 'Khác' ? 'selected' : '' }}>Khác</option>
                                </select>
                                <div class="invalid-feedback">@error('subject'){{ $message }}@else Vui lòng chọn dịch vụ.@enderror</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#0d1b2a;">
                                    Ngân sách dự kiến
                                </label>
                                <input type="text" name="budget" value="{{ old('budget') }}"
                                       class="form-control"
                                       placeholder="vd: 500 triệu – 1 tỷ"
                                       style="border-color:#e9ecef;border-radius:6px;padding:.7rem 1rem;">
                            </div>

                            {{-- Row 3: Message --}}
                            <div class="col-12">
                                <label class="form-label" style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#0d1b2a;">
                                    Tổng quan dự án
                                </label>
                                <textarea name="message" rows="5"
                                          class="form-control @error('message') is-invalid @enderror"
                                          placeholder="Hãy cho chúng tôi biết về yêu cầu kết cấu của bạn..."
                                          required minlength="10" maxlength="5000"
                                          style="border-color:#e9ecef;border-radius:6px;padding:.7rem 1rem;resize:none;">{{ old('message') }}</textarea>
                                <div class="invalid-feedback">@error('message'){{ $message }}@else Vui lòng nhập nội dung (ít nhất 10 ký tự).@enderror</div>
                                <p class="mt-2 mb-0" style="font-size:.75rem;color:#adb5bd;line-height:1.5;">
                                    Bằng cách gửi biểu mẫu này, bạn đồng ý với chính sách bảo mật của chúng tôi liên quan đến việc lưu trữ và xử lý dữ liệu của bạn.
                                </p>
                            </div>

                            {{-- Submit --}}
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit"
                                        class="btn fw-semibold px-5 py-2 d-inline-flex align-items-center gap-2"
                                        style="background:#0d1b2a;color:#fff;border-radius:6px;font-size:.95rem;">
                                    Gửi tin nhắn <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     3. MAP SECTION
     ============================================================ --}}
<section style="height:420px;position:relative;overflow:hidden;">
    @if(setting('google_maps_embed'))
        {!! setting('google_maps_embed') !!}
    @else
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.4687076655546!2d105.74193741112688!3d21.05393408052083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454fae6f364f5%3A0x8e58efffe1a725f7!2zQ0hJIE5Iw4FOSCAyIEPDlE5HIFRZIFROSEggVuG6rFQgVMavIFjDglkgROG7sE5HIFZJ4buGVCBOQU0!5e0!3m2!1svi!2s!4v1776319989025!5m2!1svi!2s"
            width="100%" height="420" style="border:0;filter:grayscale(20%);" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    @endif

    {{-- Floating label --}}
    <div class="position-absolute text-center" style="bottom:24px;left:50%;transform:translateX(-50%);z-index:2;">
        <div class="px-3 py-2 rounded fw-bold d-inline-flex align-items-center gap-2"
             style="background:#0d1b2a;color:#fff;font-size:.75rem;letter-spacing:2px;text-transform:uppercase;box-shadow:0 4px 16px rgba(0,0,0,.3);">
            <i class="bi bi-geo-alt-fill" style="color:#e8a020;"></i>
            {{ setting('company_name', 'THÀNH NAM TFC') }}
        </div>
    </div>
</section>

{{-- ============================================================
     4. FAQ SECTION
     ============================================================ --}}
<section style="background:#f4f5f7;padding:80px 0;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold" style="font-size:clamp(1.6rem,3vw,2.2rem);color:#0d1b2a;">
                Câu Hỏi Thường Gặp
            </h2>
            <p style="color:#6c757d;max-width:480px;margin:.75rem auto 0;font-size:.95rem;line-height:1.7;">
                Giải đáp nhanh các câu hỏi phổ biến về quy trình kỹ thuật của chúng tôi.
            </p>
        </div>

        <div class="col-lg-8 mx-auto">
            <div class="accordion" id="faqAccordion">

                <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden" style="box-shadow:0 2px 8px rgba(0,0,0,.06);"
                     data-aos="fade-up" data-aos-delay="0">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-semibold" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq1"
                                style="color:#0d1b2a;background:#fff;font-size:.95rem;">
                            Thời gian thực hiện đánh giá kết cấu thông thường là bao lâu?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body" style="color:#6c757d;font-size:.9rem;line-height:1.75;background:#fff;">
                            Hầu hết các đánh giá tiêu chuẩn được hoàn thành trong vòng 7–10 ngày làm việc. Đối với các yêu cầu hạ tầng khẩn cấp, chúng tôi cung cấp dịch vụ nhanh với đảm bảo khảo sát thực địa trong 48 giờ.
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden" style="box-shadow:0 2px 8px rgba(0,0,0,.06);"
                     data-aos="fade-up" data-aos-delay="100">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq2"
                                style="color:#0d1b2a;background:#fff;font-size:.95rem;">
                            Bạn có cung cấp nguồn vật liệu bền vững không?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body" style="color:#6c757d;font-size:.9rem;line-height:1.75;background:#fff;">
                            Có, chúng tôi hợp tác với mạng lưới nhà cung cấp vật liệu xanh được chứng nhận. Tất cả các dự án đều được đánh giá về tác động môi trường và chúng tôi ưu tiên các vật liệu có chứng chỉ bền vững khi có thể.
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 rounded-3 overflow-hidden" style="box-shadow:0 2px 8px rgba(0,0,0,.06);"
                     data-aos="fade-up" data-aos-delay="200">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq3"
                                style="color:#0d1b2a;background:#fff;font-size:.95rem;">
                            Bạn có được cấp phép cho các dự án hạ tầng quốc tế không?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body" style="color:#6c757d;font-size:.9rem;line-height:1.75;background:#fff;">
                            Có, chúng tôi được cấp phép và có kinh nghiệm hoạt động tại nhiều quốc gia. Đội ngũ của chúng tôi bao gồm các kỹ sư được chứng nhận quốc tế, quen thuộc với các tiêu chuẩn xây dựng và quy định địa phương trên toàn thế giới.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
