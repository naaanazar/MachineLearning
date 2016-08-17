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



    public function show(Product $product)
    {

        //$product = Product::find($id);
        return view('products.show', compact('product'));


    }

    public function addNew()
        {

            $product = Product::all();
            return $product;

            //return view('forms.add_product', compact('product'));
        }
}
