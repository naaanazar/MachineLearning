<?php

namespace App\Http\Controllers;

use App\Product;
use Request;

class HomeController extends Controller
{
    public function display()
    {
        $products = Product::withTrashed()->paginate(5);
        return view('products.list', [
            'products' => $products
        ]);
    }

    public function ajax()
    {
        if ( Request::ajax() ) {
            $products = Product::withTrashed();
            return var_dump('$products');
        }
    }
}
