<?php 

namespace App\Models;
use DB;
use Validator; 

Class DvdQuery{

	public function getGenres()
	{
		return DB::table('genres')->get();
	}

	public function getRatings()
	{
		return DB::table('ratings')->get();
	}

	public function search($term,$genre,$rating)
	{
		$query =  DB::table('dvds')
			->select(DB::raw('dvds.id, title,genre_name,rating_name,sound_name,format_name,label_name,DATE_FORMAT(release_date,"%m/%d/%Y") as release_date_f'))
			->join('genres','genres.id','=','dvds.genre_id')
			->join('ratings','ratings.id','=','dvds.rating_id')
			->join('labels','labels.id','=','dvds.label_id')
			->join('sounds','sounds.id','=','dvds.sound_id')
			->join('formats','formats.id','=','dvds.format_id');

		if($genre){
			$query->where('genre_id','=',$genre);
		}

		if($rating){
			$query->where('rating_id','=',$rating);	
		}

		if($term && $term != "" && $term!= "Search Here"){
			$query->where('title','LIKE','%'. $term .'%');
		}

		$query->orderBy('title','asc');
		
		return $query->get();
	}

	public function getDVD($term)
	{
		$query =  DB::table('dvds')
			->select(DB::raw('dvds.id,title,genre_name,rating_name,sound_name,format_name,label_name,DATE_FORMAT(release_date,"%m/%d/%Y") as release_date_f'))
			->join('genres','genres.id','=','dvds.genre_id')
			->join('ratings','ratings.id','=','dvds.rating_id')
			->join('labels','labels.id','=','dvds.label_id')
			->join('sounds','sounds.id','=','dvds.sound_id')
			->join('formats','formats.id','=','dvds.format_id');

		//Make sure it's not an invalid input
		if($term && $term != "" && $term!= "Search Here"){
			$query->where('dvds.id','=', $term);
		}

		$query->orderBy('title','asc');

		return $query->get();
	}

	public function getReviews($dvd_id){
		$query =  DB::table('reviews')->where('reviews.dvd_id','=', $dvd_id);
		return $query->get();
	}

	public static function create($input)
	{
		DB::table('reviews')->insert($input);
	}

	public static function validate($input)
	{
		return Validator::make($input, [
			'rating' => 'required|integer|min:1|max:10',
			'title' => 'required|string|min:5',
			'description' => 'required|string|min:20',
			'dvd_id' => 'required|numeric'
		]);
	}
}
