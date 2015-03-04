<?php

namespace App\Models\Orm;
use Illuminate\Database\Eloquent\Model;

class Dvd extends Model
{
	/* Creating a new DVD */
	public static function validate($input)
	{
		$required = [ 'title'  => 'required',
				   'label'  => 'required|integer',
				   'sound'  => 'required|integer',
				   'genre'  => 'required|integer',
				   'rating' => 'required|integer',
				   'format' => 'required|integer' ];

		return \Validator::make($input, $required);
	}

	public function reviews()
	{
		return $this->hasMany('\App\Models\Orm\Review');
	}
	
	public function label()
	{
		return $this->belongsTo('\App\Models\Orm\Label');
	}

	public function sound()
	{
		return $this->belongsTo('\App\Models\Orm\Sound');
	}

	public function genre()
	{
		return $this->belongsTo('\App\Models\Orm\Genre');
	}

	public function rating()
	{
		return $this->belongsTo('\App\Models\Orm\Rating');
	}
	
	public function format()
	{
		return $this->belongsTo('\App\Models\Orm\Format');
	}
}