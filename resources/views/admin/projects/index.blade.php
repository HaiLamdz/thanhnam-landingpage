@extends('layouts.admin')

@section('title', 'Dự án')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-0">Dự án</h4>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Thêm dự án
    </a>
</div>

{{-- Search bar --}}
<form method="GET" action="{{ route('admin.projects.index') }}" class="mb-4">
    <div class="row g-2 align-items-end">
        <div class="col-md-6">
            <input type="text" name="q" value="{{ request('q') }}"
                   class="form-control" placeholder="Tìm kiếm theo tiêu đề...">
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
            <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">
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
                    <th style="width:80px">Ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Trạng thái</th>
                    <th class="text-end">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr>
                    <td>
                        @if($project->image_path)
                            <img src="{{ Storage::url($project->image_path) }}" alt="{{ $project->title }}"
                                 class="img-thumbnail" style="width:60px;height:45px;object-fit:cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="width:60px;height:45px;">
                                <i class="bi bi-image text-muted"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="fw-medium">{{ $project->title }}</div>
                        @if($project->description)
                            <small class="text-muted">{{ Str::limit($project->description, 60) }}</small>
                        @endif
                    </td>
                    <td>
                        @if($project->status === 'published')
                            <span class="badge bg-success">Đã xuất bản</span>
                        @else
                            <span class="badge bg-secondary">Nháp</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" class="d-inline"
                              onsubmit="return confirm('Bạn có chắc muốn xóa dự án này?')">
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
                    <td colspan="4" class="text-center text-muted py-4">Chưa có dự án nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($projects->hasPages())
<div class="mt-3">{{ $projects->links() }}</div>
@endif
@endsection
