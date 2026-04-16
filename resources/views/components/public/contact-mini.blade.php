<section id="contact" style="padding:90px 0;background:#fff;">
    <div class="container">
        <div class="row g-5">

            {{-- Trái: Thông tin liên hệ --}}
            <div class="col-lg-5" data-aos="fade-right">
                <span style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#e8a020;">
                    Liên hệ
                </span>
                <h2 class="fw-bold mt-2 mb-4" style="font-size:clamp(1.5rem,2.5vw,2rem);color:#0d1b2a;line-height:1.3;">
                    Hãy Cùng Thảo Luận<br>Dự Án Của Bạn
                </h2>

                <div class="d-flex flex-column gap-4 mt-4">
                    @if(setting('contact_email'))
                    <div class="d-flex align-items-start gap-3">
                        <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                             style="width:44px;height:44px;background:rgba(13,27,42,.06);">
                            <i class="bi bi-envelope" style="color:#0d1b2a;"></i>
                        </div>
                        <div>
                            <div style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#0d1b2a;margin-bottom:.2rem;">Email</div>
                            <a href="mailto:{{ setting('contact_email') }}" class="text-decoration-none fw-medium" style="color:#0d1b2a;">
                                {{ setting('contact_email') }}
                            </a>
                        </div>
                    </div>
                    @endif

                    @if(setting('contact_phone'))
                    <div class="d-flex align-items-start gap-3">
                        <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                             style="width:44px;height:44px;background:rgba(13,27,42,.06);">
                            <i class="bi bi-telephone" style="color:#0d1b2a;"></i>
                        </div>
                        <div>
                            <div style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#0d1b2a;margin-bottom:.2rem;">Điện thoại</div>
                            <a href="tel:{{ setting('contact_phone') }}" class="text-decoration-none fw-medium" style="color:#0d1b2a;">
                                {{ setting('contact_phone') }}
                            </a>
                        </div>
                    </div>
                    @endif

                    @if(setting('contact_address'))
                    <div class="d-flex align-items-start gap-3">
                        <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                             style="width:44px;height:44px;background:rgba(13,27,42,.06);">
                            <i class="bi bi-geo-alt" style="color:#0d1b2a;"></i>
                        </div>
                        <div>
                            <div style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#0d1b2a;margin-bottom:.2rem;">Địa chỉ</div>
                            <span class="fw-medium" style="color:#0d1b2a;">{{ setting('contact_address') }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Phải: Form liên hệ (đồng bộ với trang liên hệ) --}}
            <div class="col-lg-7" data-aos="fade-left" data-aos-delay="100">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="p-4 rounded-3" style="background:#f8f9fa;border:1px solid #e9ecef;">
                    <style>
                        #homeContactForm ::placeholder { color: #ced4da; opacity: 1; }
                        #homeContactForm ::-ms-input-placeholder { color: #ced4da; }
                    </style>
                    <form action="{{ route('contact.store') }}" method="POST" novalidate id="homeContactForm">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#0d1b2a;">
                                    Họ và tên <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Nguyễn Văn A"
                                       required minlength="2" maxlength="255"
                                       style="border-color:#e9ecef;border-radius:6px;padding:.65rem 1rem;background:#fff;">
                                <div class="invalid-feedback">@error('name'){{ $message }}@else Vui lòng nhập họ tên (ít nhất 2 ký tự).@enderror</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#0d1b2a;">
                                    Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="email@example.com"
                                       required maxlength="255"
                                       style="border-color:#e9ecef;border-radius:6px;padding:.65rem 1rem;background:#fff;">
                                <div class="invalid-feedback">@error('email'){{ $message }}@else Vui lòng nhập email hợp lệ.@enderror</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#0d1b2a;">
                                    Dịch vụ quan tâm <span class="text-danger">*</span>
                                </label>
                                <select name="subject" class="form-select @error('subject') is-invalid @enderror"
                                        required
                                        style="border-color:#e9ecef;border-radius:6px;padding:.65rem 1rem;background:#fff;">
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
                                       style="border-color:#e9ecef;border-radius:6px;padding:.65rem 1rem;background:#fff;">
                            </div>
                            <div class="col-12">
                                <label class="form-label" style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#0d1b2a;">
                                    Nội dung <span class="text-danger">*</span>
                                </label>
                                <textarea name="message" rows="4"
                                          class="form-control @error('message') is-invalid @enderror"
                                          placeholder="Mô tả yêu cầu hoặc dự án của bạn..."
                                          required minlength="10" maxlength="5000"
                                          style="border-color:#e9ecef;border-radius:6px;padding:.65rem 1rem;resize:none;background:#fff;">{{ old('message') }}</textarea>
                                <div class="invalid-feedback">@error('message'){{ $message }}@else Vui lòng nhập nội dung (ít nhất 10 ký tự).@enderror</div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit"
                                        class="btn fw-semibold px-5 py-2 d-inline-flex align-items-center gap-2"
                                        style="background:#0d1b2a;color:#fff;border-radius:6px;font-size:.95rem;">
                                    Gửi yêu cầu <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
