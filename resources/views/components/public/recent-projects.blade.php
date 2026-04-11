@props(['projects'])

@php
$placeholders = [
    'https://images.unsplash.com/photo-1486325212027-8081e485255e?w=800&q=80',
    'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&q=80',
    'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=800&q=80',
    'https://images.unsplash.com/photo-1590674899484-d5640e854abe?w=800&q=80',
    'https://images.unsplash.com/photo-1565008447742-97f6f38c985c?w=800&q=80',
];
$displayProjects = $projects->take(5);
@endphp

<section style="padding:90px 0;background:#fff;">
    <div class="container">
        {{-- Header row --}}
        <div class="d-flex align-items-end justify-content-between mb-4" data-aos="fade-up">
            <div>
                <span style="font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#e8a020;">
                    Công trình tiêu biểu
                </span>
                <h2 class="fw-bold mt-1 mb-0" style="font-size:clamp(1.6rem,3vw,2.2rem);color:#0d1b2a;">
                    Dự Án Gần Đây
                </h2>
            </div>
            <a href="{{ route('projects.index') }}" class="fw-semibold text-decoration-none d-inline-flex align-items-center gap-1"
               style="color:#0d1b2a;font-size:.9rem;white-space:nowrap;">
                Xem tất cả <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        {{-- Grid --}}
        @if($displayProjects->isEmpty())
        <div class="row g-3">
            @foreach(array_slice($placeholders, 0, 3) as $i => $img)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                <div class="img-overlay-wrap rounded" style="height:220px;">
                    <img src="{{ $img }}" alt="Project {{ $i+1 }}" class="w-100 h-100" style="object-fit:cover;">
                </div>
            </div>
            @endforeach
            @foreach(array_slice($placeholders, 3, 2) as $i => $img)
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                <div class="img-overlay-wrap rounded" style="height:220px;">
                    <img src="{{ $img }}" alt="Project {{ $i+4 }}" class="w-100 h-100" style="object-fit:cover;">
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="row g-3">
            @foreach($displayProjects as $i => $project)
            @php
                $colClass = $i < 3 ? 'col-md-4' : 'col-md-6';
                $imgSrc = $project->image_path
                    ? Storage::url($project->image_path)
                    : $placeholders[$i % count($placeholders)];
            @endphp
            <div class="{{ $colClass }}" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                <a href="{{ route('projects.show', $project) }}" class="text-decoration-none d-block">
                <div class="img-overlay-wrap rounded position-relative" style="height:220px;cursor:pointer;"
                     onmouseover="this.querySelector('.proj-overlay').style.opacity='1'"
                     onmouseout="this.querySelector('.proj-overlay').style.opacity='0'">
                    <img src="{{ $imgSrc }}" alt="{{ $project->title }}" class="w-100 h-100" style="object-fit:cover;">
                    <div class="proj-overlay position-absolute bottom-0 start-0 end-0 p-3"
                         style="background:linear-gradient(transparent,rgba(10,20,40,.8));opacity:0;transition:opacity .3s;">
                        <span class="text-white fw-semibold small">{{ $project->title }}</span>
                        <span class="d-block" style="font-size:.75rem;color:#e8a020;margin-top:.2rem;">Xem chi tiết →</span>
                    </div>
                </div>
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
