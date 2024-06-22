<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductEditRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function view()
    {
        /* @var User $user */
        $user = auth()->user();
        /* @var Product $products */
        $products = Product::orderBy('id')->get();
        return view('products.index', ['user' => $user, 'products' => $products]);
    }

    public function create(ProductCreateRequest $request)
    {
        $article = $request->input('article');
        $name = $request->input('name');
        $status = $request->input('status');
        $attributes = [];
        if ($request->input('attributes') != null) {
            foreach ($request->input('attributes') as $attribute) {
                $attributes[$attribute['name']] = $attribute['value'];
            }
        }
        $product = Product::create([
            'article' => $article,
            'name' => $name,
            'status' => $status,
            'data' => json_encode($attributes),
        ]);
        return back();
    }

    public function edit(ProductEditRequest $request)
    {
        $article = $request->input('article');
        $name = $request->input('name');
        $status = $request->input('status');

        $attributes = [];
        if ($request->input('attributes') != null) {
            foreach ($request->input('attributes') as $attribute) {
                $attributes[$attribute['name']] = $attribute['value'];
            }
        }

        $product = Product::findOrFail($request->input('product_id'));
        $product->update([
            'article' => $article,
            'name' => $name,
            'status' => $status,
            'data' => json_encode($attributes),
        ]);
        $product->save();

        return back();
    }

    public function delete($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            // Optional: Add a success message to the session
            return back()->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            // Optional: Add an error message to the session
            return back()->with('error', 'Failed to delete the product.');
        }
    }
}
