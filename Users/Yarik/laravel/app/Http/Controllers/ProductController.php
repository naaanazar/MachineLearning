<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function index() {
        $products = Product::All();
        return view ('products.list', compact('products'));
    }

    public function show(Product $product) {
        return view('products.show', compact('product'));
    }
    
    
    public function edit(Request $request, Product $product) {
        $product->title = $request->title;
        return view('products.edit', compact('product'));
    }

    public function addProduct() {
        $products = Product::All();
        return view ('products.list',['products'=>$products]);
    }

    public function saveProduct() {
        $products = Product::All();
        return view ('products.list',['products'=>$products]);
    }
}
