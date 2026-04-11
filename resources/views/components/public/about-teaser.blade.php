<section style="padding:90px 0;background:#fff;">
    <div class="container">
        <div class="row align-items-center g-5">

            {{-- Left: Image --}}
            <div class="col-lg-5" data-aos="fade-right">
                <div class="position-relative img-overlay-wrap rounded" style="border-radius:12px;">
                    @if(setting('about_image'))
                        <img src="{{ Storage::url(setting('about_image')) }}"
                             alt="About us"
                             class="img-fluid rounded"
                             style="width:100%;height:420px;object-fit:cover;">
                    @else
                        <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&q=80"
                             alt="About us"
                             class="img-fluid rounded"
                             style="width:100%;height:420px;object-fit:cover;">
                    @endif

                    {{-- Floating badge --}}
                    <div class="position-absolute text-white text-center p-3 rounded"
                         style="bottom:30px;left:-20px;background:#0d1b2a;min-width:140px;box-shadow:0 8px 24px rgba(0,0,0,.25);">
                        <div class="fw-bold" style="font-size:1.8rem;line-height:1;">
                            {{ setting('about_stat_value', '25+') }}
                        </div>
                        <div style="font-size:.75rem;color:rgba(255,255,255,.7);margin-top:.25rem;">
                            {{ setting('about_stat_label', 'Năm kinh nghiệm') }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right: Text --}}
            <div class="col-lg-7" data-aos="fade-left" data-aos-delay="100">
                <span style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#e8a020;">
                    Về chúng tôi
                </span>
                <h2 class="fw-bold mt-2 mb-4" style="font-size:clamp(1.6rem,3vw,2.2rem);color:#0d1b2a;line-height:1.25;">
                    {{ setting('about_heading', 'Kiến Tạo Hạ Tầng Cho Tương Lai') }}
                </h2>
                <p style="color:#6c757d;line-height:1.8;margin-bottom:1.5rem;">
                    {{ setting('about_text', 'Từ nền móng đến hoàn thiện, chúng tôi mang đến kỹ thuật chính xác và tư duy sáng tạo cho mọi dự án.') }}
                </p>
                <p style="color:#6c757d;line-height:1.8;margin-bottom:2rem;">
                    Phương pháp của chúng tôi kết hợp sự xuất sắc kỹ thuật với thực hành bền vững, đảm bảo mỗi công trình đứng vững qua nhiều thế hệ.
                </p>
                <a href="{{ route('about') }}"
                   class="fw-semibold text-decoration-none d-inline-flex align-items-center gap-2"
                   style="color:#0d1b2a;border-bottom:2px solid #e8a020;padding-bottom:2px;">
                    Tìm hiểu thêm <i class="bi bi-arrow-right icon-hover"></i>
                </a>
            </div>

        </div>
    </div>
</section>
