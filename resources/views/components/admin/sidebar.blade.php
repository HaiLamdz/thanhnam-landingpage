@props(['unreadCount' => 0])

<div class="sidebar d-flex flex-column">
    <div class="brand">
        <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none fw-bold">
            {{ setting('company_name', 'Thành Nam TFC') }}
        </a>
    </div>
    <nav class="mt-2 flex-grow-1">
        <a href="{{ route('admin.dashboard') }}"
           class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="{{ route('admin.settings.index') }}"
           class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <i class="bi bi-gear"></i> Cài đặt
        </a>
        <a href="{{ route('admin.services.index') }}"
           class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
            <i class="bi bi-briefcase"></i> Dịch vụ
        </a>
        <a href="{{ route('admin.news.index') }}"
           class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
            <i class="bi bi-newspaper"></i> Tin tức
        </a>
        <a href="{{ route('admin.projects.index') }}"
           class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
            <i class="bi bi-images"></i> Dự án
        </a>
        <a href="{{ route('admin.activity-areas.index') }}"
           class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.activity-areas.*') ? 'active' : '' }}">
            <i class="bi bi-map"></i> Lĩnh vực hoạt động
        </a>
        <a href="{{ route('admin.equipments.index') }}"
           class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.equipments.*') ? 'active' : '' }}">
            <i class="bi bi-tools"></i> Thiết bị máy móc
        </a>
        <a href="{{ route('admin.activity-images.index') }}"
           class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.activity-images.*') ? 'active' : '' }}">
            <i class="bi bi-images"></i> Hình ảnh hoạt động
        </a>
        <a href="{{ route('admin.contact-messages.index') }}"
           class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}">
            <i class="bi bi-envelope"></i> Tin nhắn
            @if($unreadCount > 0)
                <span class="badge bg-danger ms-auto">{{ $unreadCount }}</span>
            @endif
        </a>
    </nav>
</div>
