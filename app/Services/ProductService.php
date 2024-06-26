<?php

namespace App\Services;

use App\Jobs\SendProductCreatedNotification;
use App\Models\Product;
use App\Notifications\ProductCreatedNotification;
use Illuminate\Support\Facades\Mail;

class ProductService
{
    public function createProduct(array $data): void
    {
        $attributes = $this->prepareAttributes($data['attributes'] ?? []);
        $product = Product::create([
            'article' => $data['article'],
            'name' => $data['name'],
            'status' => $data['status'],
            'data' => json_encode($attributes),
        ]);
        SendProductCreatedNotification::dispatch($product);
    }
    public function getAllProducts()
    {
        return Product::orderBy('id')->get();
    }
    private function prepareAttributes(array $attributes): array
    {
        $result = [];
        foreach ($attributes as $attribute) {
            $result[$attribute['name']] = $attribute['value'];
        }
        return $result;
    }

    public function updateProduct($id, array $data): void
    {
        $attributes = $this->prepareAttributes($data['attributes'] ?? []);
        $product = Product::findOrFail($id);
        $product->update([
            'article' => $data['article'],
            'name' => $data['name'],
            'status' => $data['status'],
            'data' => json_encode($attributes),
        ]);
        $product->save();
    }

    public function deleteProduct($id): void
    {
        Product::findOrFail($id)->delete();
    }
}
