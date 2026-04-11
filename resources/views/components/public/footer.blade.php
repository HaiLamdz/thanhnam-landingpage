<footer style="background:#fff;color:#374151;border-top:1px solid #e9ecef;">
    <div class="container py-5">
        <div class="row g-5">

            {{-- Cột 1: Thương hiệu + mô tả + mạng xã hội --}}
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center gap-3 mb-3">
                    @if(setting('company_logo'))
                        <img src="{{ Storage::url(setting('company_logo')) }}"
                             alt="{{ setting('company_name', 'Thành Nam TFC') }}"
                             height="56" style="object-fit:contain;">
                    @else
                        <img src="/images/logo-thanhnam.png"
                             alt="{{ setting('company_name', 'Thành Nam TFC') }}"
                             height="56" style="object-fit:contain;"
                             onerror="this.style.display='none'">
                    @endif
                    <div>
                        <div class="fw-bold" style="font-size:1rem;color:#0d1b2a;line-height:1.2;">
                            {{ setting('company_name', 'Thành Nam TFC.,JSC') }}
                        </div>
                        <div style="font-size:.75rem;color:#adb5bd;margin-top:.2rem;">MST: {{ setting('tax_code', '0201574928') }}</div>
                    </div>
                </div>
                <p style="color:#6c757d;font-size:.875rem;line-height:1.75;margin-bottom:1.5rem;">
                    {{ setting('footer_description', 'Xây dựng hạ tầng tương lai với kỹ thuật chính xác, thiết kế sáng tạo và thi công bền vững.') }}
                </p>
                <div class="d-flex gap-2">
                    @foreach([
                        ['key'=>'social_facebook','icon'=>'bi-facebook'],
                        ['key'=>'social_youtube','icon'=>'bi-youtube'],
                        ['key'=>'social_linkedin','icon'=>'bi-linkedin'],
                    ] as $s)
                    @if(setting($s['key']))
                    <a href="{{ setting($s['key']) }}" target="_blank" rel="noopener"
                       class="d-flex align-items-center justify-content-center rounded-circle text-decoration-none"
                       style="width:36px;height:36px;background:#f1f3f5;color:#6c757d;transition:.2s;"
                       onmouseover="this.style.background='#0d1b2a';this.style.color='#fff'"
                       onmouseout="this.style.background='#f1f3f5';this.style.color='#6c757d'">
                        <i class="bi {{ $s['icon'] }} small"></i>
                    </a>
                    @endif
                    @endforeach
                </div>
            </div>

            {{-- Cột 2: Dịch vụ --}}
            <div class="col-lg-2 col-md-6 col-6">
                <h6 style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;color:#0d1b2a;margin-bottom:1.25rem;">
                    Dịch vụ
                </h6>
                <ul class="list-unstyled mb-0">
                    @foreach(\App\Models\Service::published()->ordered()->limit(5)->get() as $svc)
                    <li class="mb-2">
                        <a href="{{ route('services.show', $svc->slug) }}" class="text-decoration-none" style="color:#6c757d;font-size:.875rem;">
                            {{ $svc->title }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Cột 3: Liên kết nhanh --}}
            <div class="col-lg-2 col-md-6 col-6">
                <h6 style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;color:#0d1b2a;margin-bottom:1.25rem;">
                    Liên kết nhanh
                </h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-decoration-none" style="color:#6c757d;font-size:.875rem;">Trang chủ</a></li>
                    <li class="mb-2"><a href="{{ route('about') }}" class="text-decoration-none" style="color:#6c757d;font-size:.875rem;">Giới thiệu</a></li>
                    <li class="mb-2"><a href="{{ route('services.index') }}" class="text-decoration-none" style="color:#6c757d;font-size:.875rem;">Dịch vụ</a></li>
                    <li class="mb-2"><a href="{{ route('news.index') }}" class="text-decoration-none" style="color:#6c757d;font-size:.875rem;">Tin tức</a></li>
                    <li class="mb-2"><a href="{{ route('contact.index') }}" class="text-decoration-none" style="color:#6c757d;font-size:.875rem;">Liên hệ</a></li>
                </ul>
            </div>

            {{-- Cột 4: Pháp lý + thông tin liên hệ --}}
            <div class="col-lg-4 col-md-6">
                <h6 style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;color:#0d1b2a;margin-bottom:1.25rem;">
                    Pháp lý
                </h6>
                <ul class="list-unstyled mb-4">
                    <li class="mb-2"><a href="#" class="text-decoration-none" style="color:#6c757d;font-size:.875rem;">Chính sách bảo mật</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none" style="color:#6c757d;font-size:.875rem;">Điều khoản sử dụng</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none" style="color:#6c757d;font-size:.875rem;">Chính sách cookie</a></li>
                </ul>

                @if(setting('contact_address'))
                <div class="d-flex gap-2 mb-2">
                    <i class="bi bi-geo-alt-fill flex-shrink-0 mt-1" style="color:#e8a020;font-size:.8rem;"></i>
                    <span style="color:#6c757d;font-size:.8rem;">{{ setting('contact_address') }}</span>
                </div>
                @endif
                @if(setting('contact_email'))
                <div class="d-flex gap-2 mb-2">
                    <i class="bi bi-envelope-fill flex-shrink-0 mt-1" style="color:#e8a020;font-size:.8rem;"></i>
                    <a href="mailto:{{ setting('contact_email') }}" class="text-decoration-none" style="color:#6c757d;font-size:.8rem;">{{ setting('contact_email') }}</a>
                </div>
                @endif
                @if(setting('contact_phone'))
                <div class="d-flex gap-2">
                    <i class="bi bi-telephone-fill flex-shrink-0 mt-1" style="color:#e8a020;font-size:.8rem;"></i>
                    <a href="tel:{{ setting('contact_phone') }}" class="text-decoration-none" style="color:#6c757d;font-size:.8rem;">{{ setting('contact_phone') }}</a>
                </div>
                @endif
            </div>

        </div>
    </div>

    {{-- Copyright --}}
    <div style="border-top:1px solid #e9ecef;">
        <div class="container py-3 d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <p class="mb-0" style="color:#adb5bd;font-size:.8rem;">
                &copy; {{ date('Y') }} {{ setting('company_name', 'STRUCTURA') }}. Bảo lưu mọi quyền.
            </p>
            <p class="mb-0" style="color:#adb5bd;font-size:.8rem;">
                MST: {{ setting('tax_code', '0201574928') }}
            </p>
        </div>
    </div>
</footer>
