@props(['services' => collect()])

<section style="padding:80px 0;background:#fff;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;">
                Dịch vụ
            </span>
            <h2 class="fw-bold mt-2" style="font-size:clamp(1.6rem,3vw,2.2rem);color:#0d1b2a;">
                Dịch Vụ Nổi Bật
            </h2>
            <p style="color:#6c757d;max-width:480px;margin:.5rem auto 0;font-size:.9rem;">
                Các dịch vụ chính mà chúng tôi cung cấp cho khách hàng.
            </p>
        </div>

        <div class="row g-4">
            @foreach($services->where('featured', true)->take(6) as $service)
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="p-4 rounded h-100" style="background:#f8f9fa;border:1px solid #e9ecef;transition:.3s;"
                         onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 8px 25px rgba(0,0,0,.1)'"
                         onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                        <div class="d-flex align-items-center justify-content-center rounded mb-3"
                             style="width:60px;height:60px;background:rgba(232,160,32,.1);">
                            <i class="bi {{ $service->icon ?? 'bi-briefcase' }} fs-4" style="color:#e8a020;"></i>
                        </div>
                        <h5 class="fw-bold mb-2" style="color:#0d1b2a;">{{ $service->title }}</h5>
                        <p class="mb-3" style="color:#6c757d;font-size:.9rem;line-height:1.6;">{{ Str::limit($service->summary, 120) }}</p>
                        <a href="{{ route('services.show', $service->slug) }}"
                           class="text-decoration-none fw-semibold"
                           style="color:#e8a020;font-size:.85rem;">
                            Xem chi tiết <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ route('services.index') }}"
               class="text-decoration-none fw-semibold d-inline-flex align-items-center gap-2"
               style="color:#e8a020;font-size:.95rem;">
                Xem tất cả dịch vụ <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
