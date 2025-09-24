<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'city' => 'string|max:100',
            'city_ref' => 'required|uuid',
            'present' => 'sometimes|string|nullable|max:100',
            'area' => 'sometimes|string|nullable|max:100',
            'street' => 'sometimes|string|nullable|max:255',
            'parent_region_code' => 'sometimes|string|nullable|max:50',
            'parent_region_types' => 'sometimes|string|nullable|max:50',
            'settlement_type_code' => 'sometimes|string|nullable|max:10',
            'apartment' => 'sometimes|string|nullable|max:50',
        ];
    }
}
