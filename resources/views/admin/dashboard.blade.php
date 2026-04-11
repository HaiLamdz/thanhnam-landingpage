@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-0">Dashboard</h4>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                <i class="bi bi-check-circle-fill text-primary fs-4"></i>
            </div>
            <div>
                <h5 class="mb-1">Chào mừng, {{ Auth::user()->name }}!</h5>
                <p class="text-muted mb-0">Hệ thống CMS đang hoạt động bình thường.</p>
            </div>
        </div>
    </div>
</div>
@endsection
