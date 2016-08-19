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
    public function addNew()
    {
        return view('forms.add_product');
    }


    public function save(Request $request, Product $product )
    {
//        echo '<pre>';
//        print_r($request->all());
//        echo '<pre>';
//        print_r($request->has('title'));
//        echo '<pre>';
//        print_r($request->get('title'));
//        die();

       // $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->img_url = $request->img_url;
        $product->save();

        return view('forms.add_product', compact('product'));
    }


    public function edit()
    {
        return view('forms.edit_product');
    }

    public function saveEdit(Request $request, Product $product)
    {
        $product = Product::find($product->id);

       // $product = Product::where('title', '=', $product->title)->first();


        $product->title = $request->title;
        $product->description = $request->description;
        $product->img_url = $request->img_url;
        $product->save();

        return back();
            //view('products.show', compact('product'));
    }
















    public function deleteProduct($product)
    {
        Product::destroy(34);
print_r("qwe" . $product);
        return back();
            //response()->json(['success' => true]);

//        $product = Product::find();
//
//        $product->delete();
    }
}
