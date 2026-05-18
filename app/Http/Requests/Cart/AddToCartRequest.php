<?php

// Author: Emily Cardona Castañeda

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $itemType = $this->input('item_type', 'product');

        if ($itemType === 'service') {
            return [
                'service_id' => ['required', 'integer', 'exists:services,id'],
                'quantity' => ['nullable', 'integer', 'min:1'],
                'item_type' => ['required', 'string', 'in:product,service'],
            ];
        }

        return [
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1'],
            'item_type' => ['nullable', 'string', 'in:product,service'],
        ];
    }
}
