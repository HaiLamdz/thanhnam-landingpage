@extends('layouts.public')

@section('meta')
<title>404 — Trang không tìm thấy | {{ setting('company_name', 'Thành Nam TFC') }}</title>
@endsection

@section('content')
<section class="d-flex align-items-center justify-content-center text-center"
         style="min-height: 60vh; background: #f8f9fa;">
    <div>
        <h1 class="display-1 fw-bold text-accent">404</h1>
        <h2 class="fw-bold mb-3">Trang không tìm thấy</h2>
        <p class="text-muted mb-4">Trang bạn đang tìm kiếm không tồn tại hoặc đã bị di chuyển.</p>
        <a href="{{ route('home') }}" class="btn btn-accent btn-lg px-5">
            <i class="bi bi-house me-2"></i>Về trang chủ
        </a>
    </div>
</section>
@endsection
