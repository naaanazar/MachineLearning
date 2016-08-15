<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;

class MainController extends Controller
{
    public function data()
    {
		if (($handle = fopen("file.csv", "r")) !== FALSE) {
    		while (($data = fgetcsv($handle, ",")) !== FALSE) {
        		$product = new Product;
        		$product->title = $data[0];
        		$product->picture = $data[1];
        		$product->description = $data[2];
        		$product->save();
    		}
    	fclose($handle);
    	}
	}	

	public function display()
	{
		$content = Product::all();
		return view('product.all', ['content' => $content]);
	}
}
