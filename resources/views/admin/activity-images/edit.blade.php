@extends('layouts.admin')

@section('title', 'Sửa hình ảnh hoạt động')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-0">Sửa hình ảnh hoạt động</h4>
    <a href="{{ route('admin.activity-images.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Quay lại
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.activity-images.update', $activityImage) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-medium">Tiêu đề</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title', $activityImage->title) }}">
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Mô tả / Chú thích</label>
                <textarea name="caption" rows="3" class="form-control @error('caption') is-invalid @enderror">{{ old('caption', $activityImage->caption) }}</textarea>
                @error('caption')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Thứ tự hiển thị</label>
                    <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror"
                        value="{{ old('sort_order', $activityImage->sort_order) }}">
                    @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Trạng thái <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="draft" {{ old('status', $activityImage->status) === 'draft' ? 'selected' : '' }}>Nháp</option>
                        <option value="published" {{ old('status', $activityImage->status) === 'published' ? 'selected' : '' }}>Đã xuất bản</option>
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Ảnh hiện tại</label>
                <x-admin.image-preview :path="$activityImage->image_path" />
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/webp">
                <div class="form-text">Để trống nếu không muốn thay ảnh. JPEG, PNG hoặc WebP. Tối đa 2MB.</div>
                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Cập nhật
                </button>
                <a href="{{ route('admin.activity-images.index') }}" class="btn btn-outline-secondary">Hủy</a>
            </div>
        </form>
    </div>
</div>
@endsection
