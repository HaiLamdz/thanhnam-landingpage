<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ImageService
{
    public function store(UploadedFile $file, string $directory): string
    {
        $allowedMimes = ['image/jpeg', 'image/png', 'image/webp'];
        if (!in_array($file->getMimeType(), $allowedMimes)) {
            throw ValidationException::withMessages(['image' => 'Chỉ chấp nhận file JPEG, PNG hoặc WebP.']);
        }

        if ($file->getSize() > 2 * 1024 * 1024) {
            throw ValidationException::withMessages(['image' => 'File không được vượt quá 2MB.']);
        }

        return $file->store('uploads/' . $directory, 'public');
    }

    public function delete(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
