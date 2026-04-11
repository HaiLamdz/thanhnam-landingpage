@extends('layouts.admin')

@section('title', 'Sửa dịch vụ')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-0">Sửa dịch vụ</h4>
    <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Quay lại
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-medium">Tiêu đề <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title', $service->title) }}" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Tóm tắt <span class="text-danger">*</span></label>
                <textarea name="summary" rows="3" class="form-control @error('summary') is-invalid @enderror" required>{{ old('summary', $service->summary) }}</textarea>
                @error('summary')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Nội dung chi tiết</label>
                <textarea name="body" rows="6" class="form-control @error('body') is-invalid @enderror">{{ old('body', $service->body) }}</textarea>
                @error('body')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Icon (CSS class)</label>
                    <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror"
                        value="{{ old('icon', $service->icon) }}" placeholder="bi bi-gear">
                    @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Thứ tự hiển thị</label>
                    <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror"
                        value="{{ old('sort_order', $service->sort_order) }}">
                    @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Trạng thái <span class="text-danger">*</span></label>
                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                    <option value="draft" {{ old('status', $service->status) === 'draft' ? 'selected' : '' }}>Nháp</option>
                    <option value="published" {{ old('status', $service->status) === 'published' ? 'selected' : '' }}>Đã xuất bản</option>
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-medium">Ảnh dịch vụ</label>
                <x-admin.image-preview :path="$service->image_path" />
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/webp">
                <div class="form-text">Để trống nếu không muốn thay ảnh. JPEG, PNG hoặc WebP. Tối đa 2MB.</div>
                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Cập nhật
                </button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">Hủy</a>
            </div>
        </form>
    </div>
</div>
@endsection
