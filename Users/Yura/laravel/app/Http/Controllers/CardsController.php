<?php

namespace App\Http\Controllers;
use DB;
use App\Card;
use Illuminate\Http\Request; 

class CardsController extends Controller
{
	public function learn()
	{	
		?>
		<script>
		"use strict";
				var user = 'Yura', age = 25, massage = 'how are you? ';
			alert (name);
			prompt(massage);
			confirm(age);


		</script>
		<?php
	}









	public function index()
	{
		$cards = Card::all(); 
		return view('cards.index',compact('cards'));
	}

	public function show($card)
	{
		return $card;
	}
}
