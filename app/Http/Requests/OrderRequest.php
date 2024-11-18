<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'customer_id' => ['required'],
             'product-items.*.name' => 'required|string|max:255',
            'product-items.*.price' => 'required|numeric|min:0',
            'product-items.*.quantity' => 'required|numeric|min:1',
            'product-items.*.total' => 'required|numeric|min:0',
        ];
    }
}
