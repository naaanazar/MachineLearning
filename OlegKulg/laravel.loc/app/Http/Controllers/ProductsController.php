<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

use Intervention\Image\ImageManagerStatic as Image;

class ProductsController extends Controller
{
    public function showProduct( Product $product)
    {
        return view('products.showOne', compact('product'));
    }

    public function addProduct()
    {
        return view('forms.addProduct');
    }

    public function saveProduct(Request $request)
    {
        $request->flash();

        $validate = $this->validate($request, [
            'title' => 'required|unique:products',
            'description' => 'required',
            'img' => 'required|image'
        ]);

        $destinationPath = public_path('img');
        $imageName = str_replace(' ','',$request->file('img')->getClientOriginalName());
        $request->file('img')->move($destinationPath, $imageName);

        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->img_url = URL::asset("img/$imageName");// domen name!
        $product->save();

        $img = Image::make("img/$imageName")->resize(300, 300);
        $img->save("img/$imageName");

        return redirect('products/add');
    }

    public function editProduct(Product $product)
    {
        return view('forms.editProduct', compact('product'));
    }

    public function saveEditProduct(Request $request)
    {
        $request->flash();
        $product = new Product;
        $product->where('title', $request->title)->delete();
        $this->DataSave($request);
        
        return redirect('products/add');
    }

    public function deleteProduct($product)
    {
        Product::destroy($product);
        return response()->json(['success'=>true]);
    }

    public function forseDeleteProduct($product)
    {
        Product::withTrashed()
        ->where('id', $product)
        ->forceDelete();

        return response()->json(['success'=>true]);
    }

    public function restoreProduct($product)
    {
        Product::withTrashed()
        ->where('id', $product)
        ->restore();
        
        return response()->json(['success'=>true]);

    }
    public function selectAllproductByAjax () {
        
    }
}
