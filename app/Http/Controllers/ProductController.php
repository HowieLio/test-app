<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductEditRequest;
use App\Models\Product;
use App\Models\User;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ProductController extends Controller
{
    protected ProductService $productService;
    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }
    public function view()
    {
        $user = auth()->user();
        $products = $this->productService->getAllProducts();
        $role = Config::get('products.role');
        $permissions = Config::get('products.roles.' . $role);
        return view('products.index', ['user' => $user, 'permissions' => $permissions, 'products' => $products]);
    }

    public function create(ProductCreateRequest $request): RedirectResponse
    {
        $this->productService->createProduct($request->all());
        return back();
    }

    public function edit(ProductEditRequest $request): RedirectResponse
    {
        $this->productService->updateProduct($request->input('product_id'), $request->all());
        return back();
    }

    public function delete($id): RedirectResponse
    {
        $this->productService->deleteProduct($id);
        return back();
    }
}
