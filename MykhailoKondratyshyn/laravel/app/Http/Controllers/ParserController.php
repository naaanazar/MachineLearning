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
        $html = $parser->fetchPage('http://rozetka.com.ua/krepkie-napitki/c4594292/filter/vid-napitka-69821=konyak/');
        print_r($html);
        //die();
    }
}