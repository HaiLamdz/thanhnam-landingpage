@extends('layouts.admin')

@section('title', 'Thêm dự án')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-0">Thêm dự án</h4>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Quay lại
    </a>
</div>

<form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">

        {{-- Main content --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Tiêu đề <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-medium">Mô tả ngắn</label>
                        <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror"
                            placeholder="Tóm tắt ngắn gọn về dự án...">{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-medium">Nội dung chi tiết</label>
                        <textarea name="body" id="body" rows="10" class="form-control @error('body') is-invalid @enderror">{{ old('body') }}</textarea>
                        @error('body')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            {{-- Gallery image --}}
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-medium">Hình ảnh dự án</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Ảnh đại diện <span class="text-danger">*</span></label>
                        <input type="file" name="image" id="imageInput"
                               class="form-control @error('image') is-invalid @enderror"
                               accept="image/jpeg,image/png,image/webp" required>
                        <div class="form-text">JPEG, PNG hoặc WebP. Tối đa 2MB.</div>
                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div id="imagePreview" class="mt-2 d-none">
                            <img id="previewImg" src="" alt="Preview" class="rounded" style="max-height:200px;object-fit:cover;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-medium">Xuất bản</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Trạng thái <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Nháp</option>
                            <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Đã xuất bản</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Lưu dự án
                        </button>
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">Hủy</a>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-medium">Thông tin dự án</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Khách hàng</label>
                        <input type="text" name="client" class="form-control @error('client') is-invalid @enderror"
                            value="{{ old('client') }}" placeholder="Tên khách hàng...">
                        @error('client')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Địa điểm</label>
                        <input type="text" name="location" class="form-control @error('location') is-invalid @enderror"
                            value="{{ old('location') }}" placeholder="Hà Nội, Việt Nam...">
                        @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Danh mục</label>
                        <input type="text" name="category" class="form-control @error('category') is-invalid @enderror"
                            value="{{ old('category') }}" placeholder="Hạ tầng & Nền móng...">
                        @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Dịch vụ liên quan</label>
                        <div class="row g-2">
                            @foreach($services as $service)
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="services[]" value="{{ $service->id }}" id="service{{ $service->id }}">
                                        <label class="form-check-label" for="service{{ $service->id }}">
                                            {{ $service->title }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('services')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-medium">Trạng thái hoàn thành</label>
                        <input type="text" name="completion_status" class="form-control @error('completion_status') is-invalid @enderror"
                            value="{{ old('completion_status', 'Hoàn thành') }}" placeholder="Hoàn thành / Đang thi công...">
                        @error('completion_status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/lecbnzgrie0myka7vfwlm7htl0g2848jqttrg1cxe2kf4b4f/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
<script>
    tinymce.init({
        selector: '#body',
        plugins: 'lists link image code',
        toolbar: 'undo redo | bold italic | bullist numlist | link image | code',
        height: 400,
        menubar: false,
    });

    // Image preview
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(ev) {
            document.getElementById('previewImg').src = ev.target.result;
            document.getElementById('imagePreview').classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    });
</script>
@endpush
