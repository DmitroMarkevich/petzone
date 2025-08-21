<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): true
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * todo unification between meest and nova posts (ref_delivery_city, ref_delivery_street)
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'sometimes|string|max:50',
            'last_name' => 'sometimes|string|max:50',
            'phone_number' => 'sometimes|nullable|string|max:20',
            'city' => 'sometimes|string|max:100',
            'street' => 'sometimes|string|max:255',
            'apartment' => 'sometimes|string|max:50',
            'ref_delivery_city' => 'sometimes|required_with:city|string',
            'ref_delivery_street' => 'sometimes|required_with:street|string',
        ];
    }
}
