<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Vitaliy\Parser;

class ParserController extends Controller
{
    public function index()
    {
        (new Parser())->viewHtml();
    }
}
