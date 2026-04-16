@extends('layouts.admin')

@section('title', 'Thêm thiết bị máy móc')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-0">Thêm thiết bị máy móc</h4>
    <a href="{{ route('admin.equipments.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Quay lại
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.equipments.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-medium">Tên thiết bị <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Loại / Nhóm</label>
                    <input type="text" name="category" class="form-control @error('category') is-invalid @enderror"
                        value="{{ old('category') }}" placeholder="Nền móng / Kiểm tra / Thí nghiệm">
                    @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Thứ tự hiển thị</label>
                    <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror"
                        value="{{ old('sort_order', 0) }}">
                    @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Công suất</label>
                    <input type="text" name="power" class="form-control @error('power') is-invalid @enderror"
                        value="{{ old('power') }}" placeholder="320, 420, 680 tấn">
                    @error('power')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Đơn vị</label>
                    <input type="text" name="unit" class="form-control @error('unit') is-invalid @enderror"
                        value="{{ old('unit') }}" placeholder="Chiếc / Bộ">
                    @error('unit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Số lượng</label>
                    <input type="text" name="qty" class="form-control @error('qty') is-invalid @enderror"
                        value="{{ old('qty') }}" placeholder="01 / 05">
                    @error('qty')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Chất lượng còn lại</label>
                    <input type="text" name="quality" class="form-control @error('quality') is-invalid @enderror"
                        value="{{ old('quality') }}" placeholder="95% / 99%">
                    @error('quality')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Trạng thái <span class="text-danger">*</span></label>
                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Nháp</option>
                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Đã xuất bản</option>
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Lưu thiết bị
                </button>
                <a href="{{ route('admin.equipments.index') }}" class="btn btn-outline-secondary">Hủy</a>
            </div>
        </form>
    </div>
</div>
@endsection
