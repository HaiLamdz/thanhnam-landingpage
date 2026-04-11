@props(['posts'])

@php
$placeholders = [
    'https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&q=80',
    'https://images.unsplash.com/photo-1486325212027-8081e485255e?w=600&q=80',
    'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80',
];
$displayPosts = $posts->take(3);
@endphp

<section style="padding:90px 0;background:#f8f9fa;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#e8a020;">
                Tin tức mới nhất
            </span>
            <h2 class="fw-bold mt-2" style="font-size:clamp(1.6rem,3vw,2.2rem);color:#0d1b2a;">
                Góc Nhìn Ngành
            </h2>
        </div>

        @if($displayPosts->isEmpty())
        <div class="row g-4">
            @foreach([
                ['cat'=>'Công nghệ','title'=>'Tương lai của hạ tầng thông minh','desc'=>'Khám phá cách IoT và AI đang biến đổi cách chúng ta thiết kế và quản lý các dự án hạ tầng hiện đại.'],
                ['cat'=>'Xây dựng','title'=>'Thực hành xây dựng bền vững 2025','desc'=>'Ngành xây dựng đang thích nghi như thế nào để đáp ứng các mục tiêu bền vững toàn cầu và giảm lượng carbon.'],
                ['cat'=>'Kỹ thuật','title'=>'Điện toán đám mây trong kỹ thuật dân dụng','desc'=>'Các công cụ quản lý dự án trên nền tảng đám mây đang thay đổi cách các nhóm kỹ thuật cộng tác và làm việc.'],
            ] as $i => $item)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="bg-white rounded overflow-hidden h-100 card-lift" style="border:1px solid #e9ecef;">
                    <div class="img-overlay-wrap" style="height:200px;">
                        <img src="{{ $placeholders[$i] }}" alt="{{ $item['title'] }}"
                             class="w-100 h-100" style="object-fit:cover;">
                    </div>
                    <div class="p-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;padding:.2rem .6rem;background:#e8a020;color:#fff;border-radius:3px;">
                                {{ $item['cat'] }}
                            </span>
                            <span style="font-size:.8rem;color:#adb5bd;">{{ now()->subDays($i * 7)->format('d/m/Y') }}</span>
                        </div>
                        <h6 class="fw-bold mb-2" style="color:#0d1b2a;line-height:1.4;">{{ $item['title'] }}</h6>
                        <p class="mb-0" style="color:#6c757d;font-size:.875rem;line-height:1.65;">{{ $item['desc'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="row g-4">
            @foreach($displayPosts as $i => $post)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <a href="{{ route('news.show', $post->slug) }}" class="text-decoration-none">
                    <div class="bg-white rounded overflow-hidden h-100 card-lift" style="border:1px solid #e9ecef;">
                        <div class="img-overlay-wrap" style="height:200px;">
                            @if($post->featured_image_path)
                                <img src="{{ Storage::url($post->featured_image_path) }}" alt="{{ $post->title }}"
                                     class="w-100 h-100" style="object-fit:cover;">
                            @else
                                <img src="{{ $placeholders[$i % 3] }}" alt="{{ $post->title }}"
                                     class="w-100 h-100" style="object-fit:cover;">
                            @endif
                        </div>
                        <div class="p-4">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                @if($post->category_tag)
                                <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;padding:.2rem .6rem;background:#e8a020;color:#fff;border-radius:3px;">
                                    {{ $post->category_tag }}
                                </span>
                                @endif
                                <span style="font-size:.8rem;color:#adb5bd;">
                                    {{ $post->published_at?->format('d/m/Y') }}
                                </span>
                            </div>
                            <h6 class="fw-bold mb-2" style="color:#0d1b2a;line-height:1.4;">{{ $post->title }}</h6>
                            <p class="mb-0" style="color:#6c757d;font-size:.875rem;line-height:1.65;">
                                {{ Str::limit($post->excerpt ?? strip_tags($post->body), 110) }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
