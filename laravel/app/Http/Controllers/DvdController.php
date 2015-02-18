<?php

namespace App\Http\Controllers;

use App\Models\DvdQuery;

use Illuminate\Http\Request;

class DvdController extends Controller
{
	public function search()
	{
		$genres = (new DvdQuery())->getGenres();
		$ratings = (new DvdQuery())->getRatings();
		
		return view('search',[
			'genres' => $genres,
			'ratings' => $ratings
		]);
	}

	public function results(Request $request){

		$dvds = (new DvdQuery())->search($request->input('dvd_title'),$request->input('Selgenre'),$request->input('Selrating'));
		// dd($dvds);

		return view('results', [

			'dvd_title' => $request->input('dvd_title'),
			'dvds' => $dvds

		]);
	}
}
