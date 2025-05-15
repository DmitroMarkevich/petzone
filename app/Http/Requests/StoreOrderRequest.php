<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Enum\PaymentMethod;
use App\Enum\DeliveryMethod;

class StoreOrderRequest extends FormRequest
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
            'advert_id' => 'required|exists:adverts,id',
            'payment_method' => ['required', Rule::in(PaymentMethod::values())],
            'delivery_method' => ['required', Rule::in(DeliveryMethod::values())],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * This method modifies the request data before validation.
     *
     * @return void
     */
    public function prepareForValidation(): void
    {
        $this->merge([
            'payment_method' => $this->input('payment_method'),
            'delivery_method' => $this->input('delivery_method'),
        ]);
    }
}
