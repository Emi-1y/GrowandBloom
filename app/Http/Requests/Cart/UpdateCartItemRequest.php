<?php

// Author: Emily Cardona Castañeda

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCartItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'plant_id' => (int) $this->route('id'),
        ]);
    }

    public function rules(): array
    {
        return [
            'plant_id' => ['required', 'integer', 'exists:plants,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'plant_id.required' => __('validation.plant_required'),
            'plant_id.integer' => __('validation.plant_integer'),
            'plant_id.exists' => __('validation.plant_exists'),
            'quantity.required' => __('validation.quantity_required'),
            'quantity.integer' => __('validation.quantity_integer'),
            'quantity.min' => __('validation.quantity_min'),
        ];
    }
}
