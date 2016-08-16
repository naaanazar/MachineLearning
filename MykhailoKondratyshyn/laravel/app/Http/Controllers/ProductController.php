<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::All();



        return view('products.list',
            ['products' => $products]);

       // return view('forms.add_product');

    }



    public function show(Product $products)
    {

        //$product = Product::find($id);
        return $products;

    }
}
