<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductEditRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ProductController extends Controller
{
    public function view()
    {
        $user = auth()->user();
        $products = Product::orderBy('id')->get();
        $role = Config::get('products.role');
        $permissions = Config::get('products.roles.' . $role);
        return view('products.index', ['user' => $user, 'permissions' => $permissions, 'products' => $products]);
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
        $product = Product::findOrFail($id)->delete();

        return back();
    }
}
