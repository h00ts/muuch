<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScoreController extends Controller
{
    
	public function store(Request $request)
	{
		dd($request->all());
		// get user and make relations with:
		// [answer_user]
		// calculate and create [score]
		$user = Auth::user();
		$data = $request->all()->toArray;
		$data = array_values($data);

		$user->answers()->attach($data);
		$pra = $exam->questions;
	}
}
