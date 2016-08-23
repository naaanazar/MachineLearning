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


        return view('products.list',
            ['products' => $products]);
    }
}
