<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin — {{ setting('company_name', 'Thành Nam TFC') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background: #f0f2f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }
        .login-wrap { width: 100%; max-width: 420px; padding: 1rem; }
        .form-control:focus {
            border-color: #0d1b2a;
            box-shadow: 0 0 0 .2rem rgba(13,27,42,.15);
        }
        .btn-login {
            background: #0d1b2a;
            color: #fff;
            border: none;
            padding: .75rem;
            font-weight: 600;
            transition: background .2s;
        }
        .btn-login:hover { background: #162840; color: #fff; }
    </style>
</head>
<body>
<div class="login-wrap">
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-4 p-md-5">

            {{-- Logo / Brand --}}
            <div class="text-center mb-4">
                @if(setting('company_logo'))
                    <img src="{{ Storage::url(setting('company_logo')) }}"
                         alt="{{ setting('company_name', 'Thành Nam TFC') }}"
                         height="52" style="object-fit:contain;">
                @else
                    <img src="/images/logo-thanhnam.png"
                         alt="{{ setting('company_name', 'Thành Nam TFC') }}"
                         height="52" style="object-fit:contain;"
                         onerror="this.style.display='none'">
                @endif
                <h5 class="fw-bold mt-3 mb-1" style="color:#0d1b2a;">Quản trị hệ thống</h5>
                <p class="text-muted small mb-0">Đăng nhập để tiếp tục</p>
            </div>

            {{-- Error alert --}}
            @if($errors->any())
            <div class="alert alert-danger py-2 small mb-3">
                <i class="bi bi-exclamation-circle me-1"></i>
                {{ $errors->first() }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger py-2 small mb-3">
                <i class="bi bi-exclamation-circle me-1"></i>
                {{ session('error') }}
            </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-medium" style="font-size:.875rem;">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-envelope text-muted"></i>
                        </span>
                        <input type="email" name="email"
                               class="form-control border-start-0 @error('email') is-invalid @enderror"
                               value="{{ old('email') }}"
                               placeholder="admin@example.com"
                               required autofocus>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-medium" style="font-size:.875rem;">Mật khẩu</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-lock text-muted"></i>
                        </span>
                        <input type="password" name="password" id="passwordInput"
                               class="form-control border-start-0"
                               placeholder="••••••••"
                               required>
                        <button type="button" class="input-group-text bg-light border-start-0"
                                onclick="togglePassword()"
                                style="cursor:pointer;">
                            <i class="bi bi-eye" id="eyeIcon" style="color:#6c757d;"></i>
                        </button>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check mb-0">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label small" for="remember">Ghi nhớ đăng nhập</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-login w-100 rounded-2">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập
                </button>
            </form>

        </div>
    </div>

    <p class="text-center text-muted small mt-3">
        &copy; {{ date('Y') }} {{ setting('company_name', 'Thành Nam TFC') }}
    </p>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('passwordInput');
    const icon  = document.getElementById('eyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'bi bi-eye';
    }
}
</script>
</body>
</html>
