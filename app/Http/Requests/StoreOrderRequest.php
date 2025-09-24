<?php

namespace App\Http\Requests;

use App\Enum\PaymentMethod;
use App\Enum\DeliveryMethod;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

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

            'recipient_first_name' => 'required|string|max:50',
            'recipient_last_name' => 'required|string|max:50',
            'recipient_middle_name' => 'nullable|string|max:50',
            'recipient_phone_number' => 'required|string|max:20',

            'warehouse_ref' => 'nullable|string',
            'warehouse_title' => 'nullable|string',
            'warehouse_settlement_type' => 'nullable|string',
            'warehouse_city' => 'nullable|string',
            'warehouse_region' => 'nullable|string',
        ];
    }
}
