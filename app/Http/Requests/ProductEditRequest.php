<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductEditRequest extends FormRequest
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
        $productId = $this->product_id;
        return [
            'article' => [
                'required',
                'string',
                'regex:/^[a-zA-Z0-9]+$/',
                Rule::unique('products', 'article')->ignore($productId)
            ],
            'name' => 'required|string|min:10',
            'status' => 'required|in:available,unavailable',
            'attributes.*.name' => 'required|string',
            'attributes.*.value' => 'required|string'
        ];
    }
}
