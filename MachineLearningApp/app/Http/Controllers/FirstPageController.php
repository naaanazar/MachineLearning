<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FirstPageController extends Controller
{
   	public function firstPage()
    {
        return view("start");
    }
}
