<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use App\Http\Requests;

use Request;

class AjaxTestController extends Controller
{
    public function ajax()
    {
        return view('ajaxTest.ajax');
    }
}
