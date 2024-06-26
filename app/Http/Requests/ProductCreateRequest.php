<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
            'article' => 'required|string|regex:/^[a-zA-Z0-9]+$/|unique:products,article',
            'name' => 'required|string|min:10',
            'status' => 'required|in:available,unavailable',
            'attributes.*.name' => 'required|string',
            'attributes.*.value' => 'required|string'
        ];
    }
}
