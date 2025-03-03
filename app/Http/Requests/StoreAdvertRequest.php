<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class StoreAdvertRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:16|max:70',
            'description' => 'required|string|min:40|max:1000',
            'price' => 'required|numeric|min:0',
            'images' => 'required|array|min:1|max:8',
            'images.*' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'category_id' => 'required|uuid|exists:categories,id'
        ];
    }
}
