<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Mykhailo\Parser;

class ParserController extends Controller
{
    public function index()
    {
        $parser = new Parser();
        $html = $parser->fetchPage('google.com');
        print_r($html);
        die();
    }
}
