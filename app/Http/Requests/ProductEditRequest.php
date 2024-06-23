<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Product;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ProductEditRequest extends FormRequest
{
    public function authorize(): bool
    {
        $productId = $this->product_id;

        $currentArticle = Product::findOrFail($productId)->article;

        if ($this->input('article') === $currentArticle) {
            return true;
        }
        /* @var User $user */
        $user = auth()->user();
        return $user->hasPermission('can_edit_article');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $productId = $this->product_id;

        $rules = [
            'name' => 'required|string|min:10',
            'status' => 'required|in:available,unavailable',
            'attributes.*.name' => 'required|string',
            'attributes.*.value' => 'required|string'
        ];
        if ($this->authorize()) {
            $rules['article'] = [
                'required',
                'string',
                'regex:/^[a-zA-Z0-9]+$/',
                Rule::unique('products', 'article')->ignore($productId),
            ];
        }
        return $rules;
    }
}
