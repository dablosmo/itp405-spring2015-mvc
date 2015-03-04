<?php

namespace App\Http\Controllers;

use \App\Models\DvdQuery;
use \App\Models\Orm\Dvd;
use \App\Models\Orm\Label; 
use \App\Models\Orm\Format;
use \App\Models\Orm\Genre;
use \App\Models\Orm\Rating;
use \App\Models\Orm\Sound; 


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

	public function review(Request $request){
		// Must place a search term
		// dd($request);
		// Query the DB
		$dvdID = $request->segment(2);
		$path = $request->path();

		$dvdQuery = new DvdQuery();
		$dvd = $dvdQuery->getDVD($dvdID);
		// dd($dvd);
		// Return the view and results

		if($request->all()){
			$validator = $dvdQuery->validate($request->all());

			if ($validator->passes()) {
				// DB::table('songs')->insert($input);
				$dvdQuery->create([
					'rating' => $request->input('rating'),
					'title' => $request->input('title'),
					'dvd_id' => $request->input('dvd_id'),
					'description' => $request->input('description')
				]);
				$reviews = $dvdQuery->getReviews($request->input('dvd_id'));
	
				return redirect($path)->with([
					'reviews'=>$reviews,
					'success' => 'Review successfully added.'
				]);
			}

			return redirect($path)->withErrors($validator)->withInput();
		}
		else{
			return view('review', [
				'dvds' => $dvd,
				'id' => $dvdID
			]);
		}
	}

	public function createDvd()
	{
		$labels  = Label::all();
		$sounds  = Sound::all();
		$genres  = Genre::all();
		$ratings = Rating::all();
		$formats = Format::all();

		return view('createDvd', [ 'labels'  => $labels,
				  'sounds'  => $sounds,
				  'genres'  => $genres,
				  'ratings' => $ratings,
				  'formats' => $formats ]);
	}

	public function insert(Request $request)
	{
		$validation = \App\Models\Orm\Dvd::validate($request->all());
		
		if ($validation->passes())
		{
			$dvd = new Dvd();
			$label = Label::find($request->input('label'));
			$sound = Sound::find($request->input('sound'));
			$genre = Genre::find($request->input('genre'));
			$rating = Rating::find($request->input('rating'));
			$format = Format::find($request->input('format'));

			$dvd->title = $request->input('title');
			$dvd->label()->associate($label);
			$dvd->sound()->associate($sound);
			$dvd->genre()->associate($genre);
			$dvd->rating()->associate($rating);
			$dvd->format()->associate($format);
			$dvd->save();

			return redirect('/dvds/create')
				->with('success', '"' . $dvd->title . '" inserted successfully.');
		}
		else
		{
			return redirect('/dvds/create')
				->withInput()
				->withErrors($validation);
		}
	}

	public function genre($genreName)
	{
		$genre = Genre::where('genre_name', '=', $genreName)
			->first();
		$dvds = Dvd::where('genre_id', '=', $genre->id)
			->with('rating')
			->with('genre')
			->with('label')
			->get();

		return view('genre', [ 'genre' => $genre,
				  'dvds'  => $dvds ]);
	}
}
