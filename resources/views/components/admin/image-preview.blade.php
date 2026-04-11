@props(['path' => null, 'label' => 'Ảnh hiện tại'])

@if($path)
    <div class="mb-2">
        <p class="text-muted small mb-1">{{ $label }}</p>
        <img src="{{ Storage::url($path) }}" alt="Preview" class="img-thumbnail" style="max-height: 150px;">
    </div>
@endif
