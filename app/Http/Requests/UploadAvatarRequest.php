<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class UploadAvatarRequest extends FormRequest
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
            'profile-photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:max_width=1000,max_height=1000',
        ];
    }

    public function messages(): array
    {
        return [
            'profile-photo.required' => 'Будь ласка, оберіть фото.',
            'profile-photo.image' => 'Можна завантажувати лише зображення.',
            'profile-photo.mimes' => 'Фото має бути у форматі: jpeg, png, jpg або webp.',
            'profile-photo.max' => 'Фото не повинно перевищувати 2 МБ.',
            'profile-photo.dimensions' => 'Фото повинно бути не більше 1000x1000 пікселів.',
        ];
    }
}
