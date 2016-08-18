<?php

namespace App\Http\Controllers;

use App\Product;

class HomeController extends Controller
{
    public function display () {
        $products = Product::withTrashed()->get();
        
        return view('products.list', [
            'products' => $products
        ]);
    }
    
}
