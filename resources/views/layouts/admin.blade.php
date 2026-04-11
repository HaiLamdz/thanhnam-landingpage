<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — {{ setting('company_name', 'Thành Nam TFC') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .sidebar { width: 240px; min-height: 100vh; background: #1a1a2e; position: fixed; top: 0; left: 0; z-index: 100; }
        .sidebar .brand { padding: 1.25rem 1.5rem; border-bottom: 1px solid rgba(255,255,255,.1); }
        .sidebar .nav-link { color: rgba(255,255,255,.7); padding: .6rem 1.5rem; font-size: .875rem; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background: rgba(255,255,255,.08); }
        .sidebar .nav-link i { width: 20px; }
        .main-content { margin-left: 240px; }
        .topbar { background: #fff; border-bottom: 1px solid #e9ecef; padding: .75rem 1.5rem; }
    </style>
</head>
<body>
    <x-admin.sidebar :unreadCount="$unreadCount ?? 0" />

    <div class="main-content">
        <div class="topbar d-flex justify-content-between align-items-center">
            <span class="text-muted small">@yield('title', 'Dashboard')</span>
            <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-box-arrow-right"></i> Đăng xuất
                </button>
            </form>
        </div>

        <div class="p-4">
            <x-admin.alert />
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
