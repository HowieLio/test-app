<?php

namespace App\Http\Controllers;

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
        $products = Product::all();
        return view('products.list', ['user' => $user, 'products' => $products]);
    }
}
