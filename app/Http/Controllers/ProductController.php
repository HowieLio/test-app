<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function view()
    {
        $user = auth()->user();
        return view('products.list', ['user' => $user]);
    }
}
