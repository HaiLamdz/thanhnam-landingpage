<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $imageRule = $this->isMethod('POST') ? 'required' : 'nullable';

        return [
            'title'             => 'required|max:255',
            'description'       => 'nullable',
            'body'              => 'nullable',
            'client'            => 'nullable|max:255',
            'location'          => 'nullable|max:255',
            'category'          => 'nullable|max:255',
            'services'          => 'nullable|max:500',
            'completion_status' => 'nullable|max:255',
            'status'            => 'required|in:draft,published',
            'image'             => $imageRule . '|mimes:jpeg,png,webp|max:2048',
        ];
    }
}
