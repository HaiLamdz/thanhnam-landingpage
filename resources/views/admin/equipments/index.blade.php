@extends('layouts.admin')

@section('title', 'Thiết bị máy móc')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-0">Thiết bị máy móc</h4>
    <a href="{{ route('admin.equipments.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Thêm thiết bị
    </a>
</div>

<form method="GET" action="{{ route('admin.equipments.index') }}" class="mb-4">
    <div class="row g-2 align-items-end">
        <div class="col-md-5">
            <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Tìm kiếm theo tên thiết bị...">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Tất cả trạng thái</option>
                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Đã xuất bản</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Nháp</option>
            </select>
        </div>
        <div class="col-md-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary flex-grow-1">
                <i class="bi bi-search me-1"></i> Tìm
            </button>
            @if(request('q') || request('status'))
            <a href="{{ route('admin.equipments.index') }}" class="btn btn-outline-secondary">
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
                    <th>Thiết bị</th>
                    <th>Loại</th>
                    <th>Trạng thái</th>
                    <th>Thứ tự</th>
                    <th class="text-end">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($equipments as $equipment)
                <tr>
                    <td>
                        <div class="fw-medium">{{ $equipment->name }}</div>
                        <small class="text-muted">{{ $equipment->power ?: $equipment->function }}</small>
                    </td>
                    <td>{{ $equipment->category ?: '—' }}</td>
                    <td>
                        @if($equipment->status === 'published')
                            <span class="badge bg-success">Đã xuất bản</span>
                        @else
                            <span class="badge bg-secondary">Nháp</span>
                        @endif
                    </td>
                    <td>{{ $equipment->sort_order }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.equipments.edit', $equipment) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.equipments.destroy', $equipment) }}" class="d-inline"
                              onsubmit="return confirm('Bạn có chắc muốn xóa thiết bị này?')">
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
                    <td colspan="5" class="text-center text-muted py-4">Chưa có thiết bị nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($equipments->hasPages())
<div class="mt-3">{{ $equipments->links() }}</div>
@endif
@endsection
