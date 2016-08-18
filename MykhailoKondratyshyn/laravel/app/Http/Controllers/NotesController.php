<?php

namespace App\Http\Controllers;

use App\Note;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;

class NotesController extends Controller
{
    public function store(Request $request, Product $product)
    {


        $note = new Note();

        $note->body = $request->body;

        $product->notes()->save($note);

        return back();
    }
}
