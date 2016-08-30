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

        $products = Product::withTrashed()->paginate(5);

        return view('products.list',
            ['products' => $products]);
    }


    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function addNew()
    {
        return view('forms.add_product');
    }


    public function save(Request $request, Product $product)
    {
        $this->validate($request, [
            'title' => 'required|unique:products',
            'description' => 'required'
        ]);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->img_url = $request->img_url;
        $product->save();

        return view('products.show', compact('product'));
    }


    public function edit(Product $product)
    {
        return view('forms.edit_product', compact('product'));
    }

    public function saveEdit(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:products',
            'description' => 'required'
        ]);

        $product = Product::find($request->get('product_id'));

        $product->title = $request->title;
        $product->description = $request->description;
        $product->img_url = $request->img_url;
        $product->save();

        return view('products.show', compact('product'));
    }


    public function delete($productId)
    {
        Product::destroy($productId);
        return response()->json(['success' => true]);
    }


    public function restore($productId)
    {


        Product::withTrashed()->where('id', $productId)->restore();


        return view('forms.success');

    }
}
