@php $bgImage = setting('hero_bg_image'); @endphp

<section style="
    min-height: 88vh;
    display: flex;
    align-items: center;
    position: relative;
    background-color: #0d1b2a;
    @if($bgImage)
        background-image: url('{{ Storage::url($bgImage) }}');
        background-size: cover;
        background-position: center;
    @else
        background-image: url('https://images.unsplash.com/photo-1486325212027-8081e485255e?w=1600&q=80');
        background-size: cover;
        background-position: center;
    @endif
">
    <div style="position:absolute;inset:0;background:rgba(10,20,40,0.72);"></div>

    <div class="container position-relative py-5" style="z-index:1;">
        <div class="row">
            <div class="col-lg-7 col-xl-6">
                <div class="mb-3" data-aos="fade-down" data-aos-duration="600">
                    <span style="display:inline-block;font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:3px;color:#e8a020;border:1px solid rgba(232,160,32,.4);padding:.3rem .8rem;border-radius:2px;">
                        TIẾN BỘ KỸ THUẬT
                    </span>
                </div>

                <h1 class="fw-bold text-white mb-4" data-aos="fade-up" data-aos-delay="100" style="font-size:clamp(2rem,4.5vw,3.2rem);line-height:1.15;">
                    {{ setting('hero_headline', 'Giải Pháp Chuyên Nghiệp Cho Doanh Nghiệp Của Bạn') }}
                </h1>

                <p class="mb-5" data-aos="fade-up" data-aos-delay="200" style="color:rgba(255,255,255,.65);font-size:1.05rem;line-height:1.75;max-width:480px;">
                    {{ setting('hero_description', 'Chúng tôi mang đến kỹ thuật chính xác và tư duy sáng tạo cho mọi dự án, xây dựng những công trình bền vững cho tương lai.') }}
                </p>

                <div class="d-flex gap-3 flex-wrap" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('services.index') }}"
                       class="btn btn-lg px-4 fw-semibold btn-accent-anim"
                       style="background:#e8a020;color:#fff;border-radius:4px;">
                        Dịch vụ của chúng tôi
                    </a>
                    <a href="{{ route('contact.index') }}"
                       class="btn btn-lg px-4 fw-semibold"
                       style="background:transparent;color:#fff;border:2px solid rgba(255,255,255,.5);border-radius:4px;transition:background .25s,color .25s;">
                        Liên hệ ngay
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
