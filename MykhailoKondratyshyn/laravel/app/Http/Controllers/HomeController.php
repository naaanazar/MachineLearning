<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;

class HomeController extends Controller
{
    public function display()
    {
      $products = Product::All();


//        foreach ($products as $product){
//            echo $product->title;
//        }

        return view('products.list',
            ['products' => $products]);
    }
}
