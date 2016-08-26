<?php
namespace App\Http\Controllers;

use Yu\Parser;
class ParserController extends Controller
{
    public function index()
    {
        (new Parser())->viewHtml();
    }
}