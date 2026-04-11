@extends('layouts.admin')

@section('title', 'Sửa bài viết')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-0">Sửa bài viết</h4>
    <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Quay lại
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.news.update', $newsPost) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-medium">Tiêu đề <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title', $newsPost->title) }}" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Tóm tắt</label>
                <textarea name="excerpt" rows="2" class="form-control @error('excerpt') is-invalid @enderror">{{ old('excerpt', $newsPost->excerpt) }}</textarea>
                @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Nội dung <span class="text-danger">*</span></label>
                <textarea name="body" id="body" rows="10" class="form-control @error('body') is-invalid @enderror" required>{{ old('body', $newsPost->body) }}</textarea>
                @error('body')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Chuyên mục</label>
                    <input type="text" name="category_tag" class="form-control @error('category_tag') is-invalid @enderror"
                        value="{{ old('category_tag', $newsPost->category_tag) }}" placeholder="VD: Tin tức, Công nghệ...">
                    @error('category_tag')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Ngày xuất bản</label>
                    <input type="datetime-local" name="published_at" class="form-control @error('published_at') is-invalid @enderror"
                        value="{{ old('published_at', $newsPost->published_at ? $newsPost->published_at->format('Y-m-d\TH:i') : '') }}">
                    @error('published_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Trạng thái <span class="text-danger">*</span></label>
                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                    <option value="draft" {{ old('status', $newsPost->status) === 'draft' ? 'selected' : '' }}>Nháp</option>
                    <option value="published" {{ old('status', $newsPost->status) === 'published' ? 'selected' : '' }}>Đã xuất bản</option>
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-medium">Ảnh đại diện</label>
                <x-admin.image-preview :path="$newsPost->featured_image_path" />
                <input type="file" name="featured_image" class="form-control @error('featured_image') is-invalid @enderror" accept="image/jpeg,image/png,image/webp">
                <div class="form-text">Để trống nếu không muốn thay ảnh. JPEG, PNG hoặc WebP. Tối đa 2MB.</div>
                @error('featured_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Cập nhật
                </button>
                <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">Hủy</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#body',
        plugins: 'lists link image code',
        toolbar: 'undo redo | bold italic | bullist numlist | link image | code',
        height: 400,
        menubar: false,
    });
</script>
@endpush
