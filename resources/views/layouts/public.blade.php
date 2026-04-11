<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @hasSection('meta')
        @yield('meta')
    @else
        <title>{{ setting('company_name', 'Thành Nam TFC') }}</title>
        <meta name="description" content="{{ setting('meta_description_default') }}">
    @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --primary: #0d1b2a;
            --accent: #e8a020;
            --accent-dark: #c8880a;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            color: #1a1a2e;
            background: #fff;
        }

        /* Buttons */
        .btn-accent {
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 4px;
            font-weight: 600;
        }
        .btn-accent:hover { background: var(--accent-dark); color: #fff; }

        .btn-outline-accent {
            border: 2px solid var(--accent);
            color: var(--accent);
            background: transparent;
            border-radius: 4px;
            font-weight: 600;
        }
        .btn-outline-accent:hover { background: var(--accent); color: #fff; }

        /* Section spacing */
        .section { padding: 80px 0; }
        .section-sm { padding: 60px 0; }

        /* Section label */
        .section-label {
            display: inline-block;
            font-size: .75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--accent);
            margin-bottom: .75rem;
        }

        /* Section title */
        .section-title {
            font-size: clamp(1.75rem, 3vw, 2.5rem);
            font-weight: 800;
            line-height: 1.2;
            color: #0d1b2a;
            margin-bottom: 1rem;
        }
        .section-title.light { color: #fff; }

        .section-desc {
            color: #6c757d;
            font-size: 1rem;
            line-height: 1.7;
            max-width: 560px;
        }

        /* Cards */
        .card-hover {
            transition: transform .3s ease, box-shadow .3s ease;
        }
        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(0,0,0,.12) !important;
        }

        /* Category tag */
        .category-tag {
            display: inline-block;
            font-size: .7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: .25rem .65rem;
            border-radius: 3px;
            background: var(--accent);
            color: #fff;
        }

        /* Dark bg utility */
        .bg-dark-navy { background: var(--primary); }

        /* Prose */
        .prose { line-height: 1.8; color: #374151; }
        .prose h2, .prose h3 { color: #0d1b2a; font-weight: 700; margin-top: 1.5rem; }
        .prose p { margin-bottom: 1rem; }
        .prose ul, .prose ol { padding-left: 1.5rem; margin-bottom: 1rem; }
        .prose img { max-width: 100%; border-radius: 8px; }

        /* Smooth scroll */
        html { scroll-behavior: smooth; }

        /* Pagination */
        .pagination .page-link { color: var(--primary); }
        .pagination .page-item.active .page-link {
            background: var(--accent);
            border-color: var(--accent);
        }

        /* ── Scroll reveal animation (legacy - removed, using AOS) ── */

        /* ── Navbar link hover underline ── */
        .nav-link-underline {
            position: relative;
        }
        .nav-link-underline::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 12px;
            right: 12px;
            height: 2px;
            background: var(--accent);
            border-radius: 2px;
            transform: scaleX(0);
            transition: transform .25s ease;
        }
        .nav-link-underline:hover::after,
        .nav-link-underline.active-link::after {
            transform: scaleX(1);
        }

        /* ── Image zoom on hover ── */
        .img-zoom {
            overflow: hidden;
        }
        .img-zoom img {
            transition: transform .5s ease;
        }
        .img-zoom:hover img {
            transform: scale(1.06);
        }

        /* ── Button hover lift ── */
        .btn-lift {
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .btn-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,.15);
        }

        /* ── Accordion smooth ── */
        .accordion-button:not(.collapsed) {
            color: #0d1b2a;
            background-color: #fff;
            box-shadow: none;
        }
        .accordion-button:focus {
            box-shadow: none;
        }

        /* ── Zalo pulse animation ── */
        @keyframes zalo-pulse {
            0%   { box-shadow: 0 0 0 0 rgba(0,104,255,.5); }
            70%  { box-shadow: 0 0 0 12px rgba(0,104,255,0); }
            100% { box-shadow: 0 0 0 0 rgba(0,104,255,0); }
        }

        /* ── Mobile responsive fixes ── */
        @media (max-width: 575.98px) {
            /* Tighten section padding on mobile */
            section[style*="padding:90px"] { padding-top: 50px !important; padding-bottom: 50px !important; }
            section[style*="padding:80px"] { padding-top: 48px !important; padding-bottom: 48px !important; }
            section[style*="padding:60px"] { padding-top: 40px !important; padding-bottom: 40px !important; }

            /* Prevent text overflow */
            p, h1, h2, h3, h4, h5, h6 { overflow-wrap: break-word; word-break: break-word; }

            /* Hero sections */
            section[style*="min-height:88vh"] { min-height: 70vh !important; }
            section[style*="min-height:480px"] { min-height: auto !important; padding-top: 80px !important; padding-bottom: 60px !important; }
            section[style*="min-height:520px"] { min-height: auto !important; padding-top: 80px !important; padding-bottom: 60px !important; }
            section[style*="min-height:380px"] { min-height: auto !important; padding-top: 80px !important; padding-bottom: 60px !important; }
            section[style*="min-height:320px"] { min-height: auto !important; padding-top: 70px !important; padding-bottom: 50px !important; }

            /* About teaser floating badge */
            .position-absolute[style*="left:-20px"] { left: 10px !important; bottom: 10px !important; }

            /* CTA buttons stack */
            .d-flex.gap-3.flex-wrap { gap: .75rem !important; }
            .d-flex.gap-3.flex-wrap .btn { width: 100%; justify-content: center; }

            /* Stats row on about page */
            .row.g-3 .col-4 { padding-left: .5rem; padding-right: .5rem; }

            /* Filter pills wrap */
            .d-flex.gap-2.flex-wrap { gap: .4rem !important; }

            /* Map section height */
            section[style*="height:420px"] { height: 280px !important; }

            /* Newsletter grid */
            .row.g-0 .col-md-6:last-child { min-height: 160px !important; }
        }

        @media (max-width: 767.98px) {
            /* Navbar brand */
            .navbar-brand img { height: 44px !important; }

            /* About teaser image height */
            .about-img { height: 280px !important; }

            /* Hero content padding */
            .container .col-lg-7,
            .container .col-lg-8 { padding-left: .5rem; padding-right: .5rem; }

            /* Project/news grid images */
            .img-overlay-wrap[style*="height:420px"] { min-height: 260px !important; height: auto !important; }
            .img-overlay-wrap[style*="height:380px"] { height: 240px !important; }

            /* Contact info cards gap */
            .d-flex.flex-column.gap-4 { gap: 1rem !important; }

            /* Footer columns */
            .footer-col { margin-bottom: 1.5rem; }
        }

        /* ── Card hover lift ── */
        .card-lift {
            transition: transform .3s ease, box-shadow .3s ease;
        }
        .card-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 48px rgba(0,0,0,.13) !important;
        }

        /* ── Image overlay hover ── */
        .img-overlay-wrap {
            overflow: hidden;
            position: relative;
        }
        .img-overlay-wrap img {
            transition: transform .5s ease;
        }
        .img-overlay-wrap:hover img {
            transform: scale(1.07);
        }

        /* ── Icon spin on hover ── */
        .icon-hover {
            transition: transform .35s ease, color .25s ease;
        }
        .icon-hover:hover {
            transform: rotate(15deg) scale(1.15);
            color: var(--accent) !important;
        }

        /* ── Button pulse ── */
        .btn-primary-dark {
            background: #0d1b2a;
            color: #fff;
            border: none;
            transition: background .25s, transform .2s, box-shadow .2s;
        }
        .btn-primary-dark:hover {
            background: #162840;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(13,27,42,.25);
        }

        /* ── Accent button ── */
        .btn-accent-anim {
            background: var(--accent);
            color: #fff;
            border: none;
            transition: background .25s, transform .2s, box-shadow .2s;
        }
        .btn-accent-anim:hover {
            background: var(--accent-dark);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(232,160,32,.35);
        }

        /* ── Nav link hover ── */
        .nav-link-hover {
            position: relative;
            transition: color .2s;
        }
        .nav-link-hover::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 12px;
            right: 12px;
            height: 2px;
            background: var(--accent);
            border-radius: 2px;
            transform: scaleX(0);
            transition: transform .25s ease;
            transform-origin: left;
        }
        .nav-link-hover:hover::after,
        .nav-link-hover.active-nav::after {
            transform: scaleX(1);
        }

        /* ── Social icon hover ── */
        .social-icon {
            transition: background .2s, color .2s, transform .2s;
        }
        .social-icon:hover {
            transform: translateY(-3px);
        }
    </style>
    @stack('styles')
</head>
<body>
    <x-public.navbar />

    {{-- ── Back to top button ── --}}
    <button id="backToTop" onclick="window.scrollTo({top:0,behavior:'smooth'})"
            aria-label="Lên đầu trang"
            style="
                position:fixed;bottom:90px;right:20px;z-index:999;
                width:44px;height:44px;border-radius:50%;border:none;
                background:#0d1b2a;color:#fff;
                display:flex;align-items:center;justify-content:center;
                box-shadow:0 4px 16px rgba(0,0,0,.25);
                opacity:0;transform:translateY(12px);
                transition:opacity .3s,transform .3s;
                cursor:pointer;">
        <i class="bi bi-arrow-up" style="font-size:1rem;"></i>
    </button>

    {{-- ── Zalo bubble ── --}}
    @php $zaloPhone = preg_replace('/[^0-9]/', '', setting('zalo_phone') ?: setting('contact_phone', '')); @endphp
    @if($zaloPhone)
    <a href="https://zalo.me/{{ $zaloPhone }}"
       target="_blank" rel="noopener"
       aria-label="Chat Zalo"
       style="
           position:fixed;bottom:20px;right:20px;z-index:999;
           width:52px;height:52px;border-radius:50%;
           display:flex;align-items:center;justify-content:center;
           box-shadow:0 4px 20px rgba(0,104,255,.45);
           text-decoration:none;
           animation:zalo-pulse 2s infinite;
           overflow:hidden;">
        <img src="/images/zalo.png" alt="Zalo" style="width:52px;height:52px;object-fit:cover;border-radius:50%;">
    </a>
    @endif

    {{-- Toast notification --}}
    @if(session('success'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index:9999;margin-top:70px;">
        <div id="successToast" class="toast align-items-center border-0 show"
             role="alert" aria-live="assertive" aria-atomic="true"
             style="background:#0d1b2a;color:#fff;min-width:320px;border-radius:10px;box-shadow:0 8px 32px rgba(0,0,0,.2);">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center gap-3 py-3 px-4">
                    <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                         style="width:36px;height:36px;background:rgba(232,160,32,.2);">
                        <i class="bi bi-check-lg" style="color:#e8a020;font-size:1.1rem;"></i>
                    </div>
                    <div>
                        <div class="fw-semibold" style="font-size:.9rem;">Gửi thành công!</div>
                        <div style="font-size:.8rem;color:rgba(255,255,255,.7);margin-top:.1rem;">
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif

    <main>
        @yield('content')
    </main>

    <x-public.footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        // Init AOS
        AOS.init({
            duration: 650,
            easing: 'ease-out-cubic',
            once: true,
            offset: 60,
        });

        // Navbar shrink on scroll
        (function() {
            const nav = document.querySelector('.navbar');
            if (!nav) return;
            window.addEventListener('scroll', () => {
                nav.style.boxShadow = window.scrollY > 40
                    ? '0 4px 20px rgba(0,0,0,.12)'
                    : '0 2px 12px rgba(0,0,0,.08)';
            }, { passive: true });
        })();

        // Back to top show/hide
        (function() {
            const btn = document.getElementById('backToTop');
            if (!btn) return;
            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    btn.style.opacity = '1';
                    btn.style.transform = 'translateY(0)';
                } else {
                    btn.style.opacity = '0';
                    btn.style.transform = 'translateY(12px)';
                }
            }, { passive: true });
        })();
        (function() {
            document.querySelectorAll('form[novalidate]').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    if (!form.checkValidity()) {
                        e.preventDefault();
                        e.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();

        // Auto-dismiss toast after 5s
        (function() {
            const toast = document.getElementById('successToast');
            if (!toast) return;
            setTimeout(() => {
                toast.style.transition = 'opacity .5s ease, transform .5s ease';
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(20px)';
                setTimeout(() => toast.remove(), 500);
            }, 5000);
        })();
    </script>
    @stack('scripts')
</body>
</html>
