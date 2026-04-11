@extends('layouts.admin')

@section('title', 'Chi tiết tin nhắn')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-0">Chi tiết tin nhắn</h4>
    <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Quay lại
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-3 text-muted">Người gửi</dt>
            <dd class="col-sm-9">{{ $contactMessage->name }}</dd>

            <dt class="col-sm-3 text-muted">Email</dt>
            <dd class="col-sm-9">
                <a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a>
            </dd>

            <dt class="col-sm-3 text-muted">Chủ đề</dt>
            <dd class="col-sm-9">{{ $contactMessage->subject }}</dd>

            <dt class="col-sm-3 text-muted">Ngày nhận</dt>
            <dd class="col-sm-9">{{ $contactMessage->created_at->format('d/m/Y H:i:s') }}</dd>

            <dt class="col-sm-3 text-muted">Nội dung</dt>
            <dd class="col-sm-9">
                <div class="bg-light rounded p-3" style="white-space: pre-wrap;">{{ $contactMessage->message }}</div>
            </dd>
        </dl>
    </div>
    <div class="card-footer bg-white d-flex gap-2">
        <form method="POST" action="{{ route('admin.contact-messages.destroy', $contactMessage) }}"
              onsubmit="return confirm('Bạn có chắc muốn xóa tin nhắn này?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
                <i class="bi bi-trash me-1"></i> Xóa tin nhắn
            </button>
        </form>
        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-outline-secondary btn-sm">Quay lại danh sách</a>
    </div>
</div>
@endsection
