<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class S3Controller extends Controller
{
    public function predictionForm()
    {
        return view('prediction');
    }

    public function displayList()
    {
        return view('list');
    }
}
