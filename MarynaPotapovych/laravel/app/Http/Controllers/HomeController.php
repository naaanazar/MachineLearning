<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Product;

class HomeController extends Controller
{

    public function display()
    {
        $products = Product::withTrashed()->get();
        return view('Products.list', array('products' => $products));
    }

    public function showProduct(Product $product)
    {
        return view('products.single', array('item' => $product));
    }

    public function addProduct()
    {
        return view('forms.addProduct');
    }

    public function saveProduct(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:products,title|min:7',
            'description' => 'required|max: 500',
            'img' => 'required|mimes:jpeg,bmp,png,jpg',
        ]);

        if ($request->file('img')->isValid()) {
            $request->file('img')->move('images', $request->img->getClientOriginalName());
        }

        Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'img' => $request->img->getClientOriginalName(),
        ]);

        return back();
    }

    public function deleteProduct($productId)
    {
        Product::destroy($productId);
        return response()->json(['success' => true]);
    }

    public function forceDeleteProduct($productId)
    {
        Product::withTrashed()->find($productId)->forceDelete();
        return response()->json(['success' => true]);
    }

    public function restoreProduct($productId)
    {
        Product::withTrashed()->find($productId)->restore();
        return response()->json(['success' => true]);
    }
    
     public function editProduct(Product $product)
    {
        return view('forms.editProduct', array('item' => $product));
    }

    public function updateProduct(Request $request, $product_id)
    {
        $product = Product::find($product_id);

        $this->validate($request, [
            'title' => 'min:5',
            'description' => 'max: 500',
            'img' => 'mimes:jpeg,bmp,png,jpg',
        ]);
        $product->title = $request->title;
        $product->description = $request->description;

        if ($request->hasFile('img')) {
            $request->file('img')->move('images', $request->img->getClientOriginalName());
            $product->img = $request->img->getClientOriginalName();
        }
        $product->save();
        return back();
    }

}
