<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActivityAreaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'description' => 'nullable',
            'icon' => 'nullable|max:100',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:draft,published',
        ];
    }
}
