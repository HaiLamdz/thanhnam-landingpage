<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'          => 'required|max:255',
            'body'           => 'required',
            'excerpt'        => 'nullable',
            'category_tag'   => 'nullable|max:100',
            'status'         => 'required|in:draft,published',
            'published_at'   => 'nullable|date',
            'featured_image' => 'nullable|mimes:jpeg,png,webp|max:2048',
        ];
    }
}
