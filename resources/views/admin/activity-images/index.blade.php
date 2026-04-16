@extends('layouts.admin')

@section('title', 'Hình ảnh hoạt động')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-0">Hình ảnh hoạt động</h4>
    <a href="{{ route('admin.activity-images.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Thêm ảnh
    </a>
</div>

<form method="GET" action="{{ route('admin.activity-images.index') }}" class="mb-4">
    <div class="row g-2 align-items-end">
        <div class="col-md-6">
            <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Tìm kiếm theo tiêu đề...">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Tất cả trạng thái</option>
                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Đã xuất bản</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Nháp</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary flex-grow-1">
                <i class="bi bi-search me-1"></i> Tìm
            </button>
            @if(request('q') || request('status'))
            <a href="{{ route('admin.activity-images.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-x-lg"></i>
            </a>
            @endif
        </div>
    </div>
</form>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tiêu đề</th>
                    <th>Trạng thái</th>
                    <th>Thứ tự</th>
                    <th class="text-end">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activityImages as $image)
                <tr>
                    <td>
                        <div class="fw-medium">{{ $image->title ?: 'Không có tiêu đề' }}</div>
                        <small class="text-muted">{{ Str::limit($image->caption, 80) }}</small>
                    </td>
                    <td>
                        @if($image->status === 'published')
                            <span class="badge bg-success">Đã xuất bản</span>
                        @else
                            <span class="badge bg-secondary">Nháp</span>
                        @endif
                    </td>
                    <td>{{ $image->sort_order }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.activity-images.edit', $image) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.activity-images.destroy', $image) }}" class="d-inline"
                              onsubmit="return confirm('Bạn có chắc muốn xóa hình ảnh này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">Chưa có hình ảnh hoạt động nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($activityImages->hasPages())
<div class="mt-3">{{ $activityImages->links() }}</div>
@endif
@endsection
