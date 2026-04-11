@props(['services'])

<section style="padding:90px 0;background:#f8f9fa;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#e8a020;">
                Chúng tôi làm gì
            </span>
            <h2 class="fw-bold mt-2" style="font-size:clamp(1.6rem,3vw,2.2rem);color:#0d1b2a;">
                Năng Lực Cốt Lõi
            </h2>
        </div>

        @php
            $displayServices = $services->take(3);
            $cards = $displayServices->isEmpty()
                ? collect([
                    ['icon'=>'bi-building','title'=>'Kỹ thuật dân dụng','desc'=>'Giải pháp kỹ thuật dân dụng toàn diện từ khảo sát địa điểm đến thiết kế kết cấu và quản lý thi công.'],
                    ['icon'=>'bi-diagram-3','title'=>'Hạ tầng','desc'=>'Xây dựng xương sống của đô thị hiện đại — đường, cầu, tiện ích công cộng và công trình dân sinh bền vững.'],
                    ['icon'=>'bi-clipboard-check','title'=>'Quản lý dự án','desc'=>'Giám sát dự án toàn diện, đảm bảo tiến độ, ngân sách và chất lượng không thỏa hiệp.'],
                  ])
                : $displayServices;
        @endphp

        <div class="row g-4 justify-content-center">
            @foreach($cards as $i => $item)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="bg-white rounded p-4 h-100 card-lift" style="border:1px solid #e9ecef;">
                    <div class="mb-3 d-flex align-items-center justify-content-center rounded"
                         style="width:52px;height:52px;background:rgba(13,27,42,.06);">
                        <i class="{{ is_array($item) ? $item['icon'] : ($item->icon ?: 'bi-gear') }} fs-4 icon-hover" style="color:#0d1b2a;"></i>
                    </div>
                    <h5 class="fw-bold mb-2" style="color:#0d1b2a;">{{ is_array($item) ? $item['title'] : $item->title }}</h5>
                    <p class="mb-0" style="color:#6c757d;font-size:.9rem;line-height:1.7;">{{ is_array($item) ? $item['desc'] : $item->summary }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
