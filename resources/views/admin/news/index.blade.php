@extends('layouts.admin')

@section('title', 'Tin tức')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-0">Tin tức</h4>
    <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Thêm bài viết
    </a>
</div>

{{-- Search bar --}}
<form method="GET" action="{{ route('admin.news.index') }}" class="mb-4">
    <div class="row g-2 align-items-end">
        <div class="col-md-5">
            <input type="text" name="q" value="{{ request('q') }}"
                   class="form-control" placeholder="Tìm kiếm theo tiêu đề...">
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">Tất cả trạng thái</option>
                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Đã xuất bản</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Nháp</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="category" class="form-select">
                <option value="">Tất cả chuyên mục</option>
                @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary flex-grow-1">
                <i class="bi bi-search me-1"></i> Tìm
            </button>
            @if(request('q') || request('status') || request('category'))
            <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">
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
                    <th>Chuyên mục</th>
                    <th>Trạng thái</th>
                    <th>Ngày xuất bản</th>
                    <th class="text-end">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($newsPosts as $post)
                <tr>
                    <td>
                        <div class="fw-medium">{{ $post->title }}</div>
                        <small class="text-muted">{{ $post->slug }}</small>
                    </td>
                    <td>
                        @if($post->category_tag)
                            <span class="badge bg-info text-dark">{{ $post->category_tag }}</span>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>
                        @if($post->status === 'published')
                            <span class="badge bg-success">Đã xuất bản</span>
                        @else
                            <span class="badge bg-secondary">Nháp</span>
                        @endif
                    </td>
                    <td>
                        {{ $post->published_at ? $post->published_at->format('d/m/Y') : '—' }}
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.news.edit', $post) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.news.destroy', $post) }}" class="d-inline"
                              onsubmit="return confirm('Bạn có chắc muốn xóa bài viết này?')">
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
                    <td colspan="5" class="text-center text-muted py-4">Chưa có bài viết nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($newsPosts->hasPages())
<div class="mt-3">{{ $newsPosts->links() }}</div>
@endif
@endsection
