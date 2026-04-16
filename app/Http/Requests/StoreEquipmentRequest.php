<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'category' => 'nullable|max:255',
            'power' => 'nullable|max:255',
            'unit' => 'nullable|max:255',
            'qty' => 'nullable|max:255',
            'quality' => 'nullable|max:255',
            'function' => 'nullable',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:draft,published',
        ];
    }
}
