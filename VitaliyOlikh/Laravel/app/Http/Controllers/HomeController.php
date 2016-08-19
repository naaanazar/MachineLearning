<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Product;
use Vitaliy\Parser;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller
{
    public function addData()
    {
        $file = fopen('file.csv', 'r');
        while(!feof($file)) {
            $content = fgetcsv($file);
            DB::table('products')->insert([
                'title'=> $content[0],
                'description' => $content[1],
                'img_url' => $content[2]
            ]);
        }
        fclose($file);
    }

    public function display()
    {
        $products = DB::table('products')->orderBy('created_at', 'DESC')->paginate(4); //->get()

        return view('products.list', ['products' => $products]);
    }

    public function showOneProduct(Product $products)
    {
        $oneProduct = [$products->title, $products->description, $products->img_url];

        return view('products.product', ['oneProduct' => $oneProduct]);
    }

    public function delete($productId)
    {
        Product::destroy($productId);

        return Response()->json(['success' => true]);
    }

    public function add()
    {
        return view('products.add');
    }

    public function upload(Request $request)
    {

        // $this->validate($request->all(), [
        //     'title' => 'required|max:255',
        //     'description' => 'required|max:1000',
        // ]);

        if(Input::hasFile('file')) {
            $file = Input::file('file');
            $file->move('uploads', $file->getClientOriginalName());
            $file = "uploads/" . $file->getClientOriginalName();
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
        ]);

        if ($validator->passes()){
            $product = new Product();
            $product->title = Input::get('title');
            $product->description = $file;
            $product->img_url = Input::get('description');
            $product->save();

            return redirect()->action('HomeController@display'); // back();
        } else {
            return redirect()->action('HomeController@add');
        }
    }

    public function render($request, Exception $e)
    {
        if($e instanceof NotFoundHttpException) {
            return response()->view('errors.404', [], 404);
        }

        return parent::render($request, $e);
    }
}
