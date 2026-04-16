<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActivityImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $imageRule = $this->isMethod('POST') ? 'required' : 'nullable';

        return [
            'title' => 'nullable|max:255',
            'caption' => 'nullable',
            'status' => 'required|in:draft,published',
            'sort_order' => 'nullable|integer',
            'image' => $imageRule . '|mimes:jpeg,png,webp|max:2048',
        ];
    }
}
