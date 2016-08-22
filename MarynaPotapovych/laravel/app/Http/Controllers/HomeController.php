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

        if($request->file('img')->isValid()) {
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
        return response()->json(['success'=> true]);
    }
    
}
