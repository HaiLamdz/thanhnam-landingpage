<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'      => 'required|max:255',
            'summary'    => 'required',
            'status'     => 'required|in:draft,published',
            'image'      => 'nullable|mimes:jpeg,png,webp|max:2048',
            'body'       => 'nullable',
            'icon'       => 'nullable|max:100',
            'sort_order' => 'nullable|integer',
        ];
    }
}
