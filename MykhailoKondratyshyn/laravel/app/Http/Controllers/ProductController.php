<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function deleteProduct($productId)
    {
        Product::destroy($productId);

        return response()->json(['success' => true]);

//        $product = Product::find();
//
//        $product->delete();
    }


    public function addNew(Request $request)
    {
        return view('forms.add_product');
    }


    public function save(Request $request)
    {
        echo '<pre>';
        print_r($request->all());
        echo '<pre>';
        print_r($request->has('title'));
        echo '<pre>';
        print_r($request->get('title'));
        die();

        //$product = Product::all();
        //return $product;
        $product = new Product;
        $product->title = 'Test';
        $product->description = 'Test';
        $product->description = 'Test';
        $product->img_url = 'Test';
        $product->save();

        return view('forms.add_product', compact('product'));
    }
}
