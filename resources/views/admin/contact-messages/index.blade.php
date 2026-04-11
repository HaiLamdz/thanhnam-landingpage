@extends('layouts.admin')

@section('title', 'Tin nhắn liên hệ')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-0">Tin nhắn liên hệ</h4>
</div>

{{-- Search bar --}}
<form method="GET" action="{{ route('admin.contact-messages.index') }}" class="mb-4">
    <div class="row g-2 align-items-end">
        <div class="col-md-6">
            <input type="text" name="q" value="{{ request('q') }}"
                   class="form-control" placeholder="Tìm theo tên, email, chủ đề...">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Tất cả</option>
                <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Chưa đọc</option>
                <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Đã đọc</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary flex-grow-1">
                <i class="bi bi-search me-1"></i> Tìm
            </button>
            @if(request('q') || request('status'))
            <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-outline-secondary">
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
                    <th>Người gửi</th>
                    <th>Email</th>
                    <th>Chủ đề</th>
                    <th>Ngày nhận</th>
                    <th>Trạng thái</th>
                    <th class="text-end">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                <tr class="{{ !$message->is_read ? 'table-light fw-semibold' : '' }}">
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ Str::limit($message->subject, 50) }}</td>
                    <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        @if(!$message->is_read)
                            <span class="badge bg-danger">Mới</span>
                        @else
                            <span class="badge bg-secondary">Đã đọc</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.contact-messages.show', $message) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="bi bi-eye"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.contact-messages.destroy', $message) }}" class="d-inline"
                              onsubmit="return confirm('Bạn có chắc muốn xóa tin nhắn này?')">
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
                    <td colspan="6" class="text-center text-muted py-4">Chưa có tin nhắn nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($messages->hasPages())
<div class="mt-3">{{ $messages->links() }}</div>
@endif
@endsection
