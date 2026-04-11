<nav class="navbar navbar-expand-lg sticky-top" style="background:#fff; box-shadow:0 2px 12px rgba(0,0,0,.08);">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            @if(setting('company_logo'))
                <img src="{{ Storage::url(setting('company_logo')) }}"
                     alt="{{ setting('company_name', 'Thành Nam TFC') }}"
                     height="40" style="object-fit:contain;">
            @else
                <img src="/images/logo-thanhnam.png"
                     alt="{{ setting('company_name', 'Thành Nam TFC') }}"
                     height="56" style="object-fit:contain;"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='inline'">
                <span class="fw-bold" style="font-size:1.2rem;letter-spacing:1px;color:#0d1b2a;display:none;">
                    {{ setting('company_name', 'Thành Nam TFC') }}
                </span>
            @endif
        </a>

        <button class="navbar-toggler border-0" type="button"
                data-bs-toggle="collapse" data-bs-target="#navMain" aria-label="Toggle navigation">
            <i class="bi bi-list fs-4" style="color:#0d1b2a;"></i>
        </button>

        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav mx-auto gap-1 mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link px-3 fw-medium {{ request()->routeIs('home') ? 'text-accent' : '' }}"
                       href="{{ route('home') }}" style="color:{{ request()->routeIs('home') ? '#e8a020' : '#0d1b2a' }};">
                        Trang chủ
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 fw-medium"
                       href="{{ route('about') }}" style="color:{{ request()->routeIs('about') ? '#e8a020' : '#0d1b2a' }};">
                        Giới thiệu &amp; Dịch vụ
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 fw-medium"
                       href="{{ route('projects.index') }}" style="color:{{ request()->routeIs('projects.*') ? '#e8a020' : '#0d1b2a' }};">
                        Dự án
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 fw-medium"
                       href="{{ route('news.index') }}" style="color:{{ request()->routeIs('news.*') ? '#e8a020' : '#0d1b2a' }};">
                        Tin tức
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 fw-medium"
                       href="{{ route('contact.index') }}" style="color:{{ request()->routeIs('contact.*') ? '#e8a020' : '#0d1b2a' }};">
                        Liên hệ
                    </a>
                </li>
            </ul>

            <a href="{{ route('contact.index') }}"
               class="btn fw-semibold px-4 py-2"
               style="background:#0d1b2a;color:#fff;border-radius:4px;white-space:nowrap;font-size:.9rem;">
                Liên hệ ngay
            </a>
        </div>
    </div>
</nav>
