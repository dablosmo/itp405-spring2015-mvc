<?php

namespace App\Models\Orm;

use Illuminate\Database\Eloquent\Model;

class Review extends Model

{
	public function dvds()
	{
		return $this->hasMany('\App\Models\Orm\Dvd');
	}
}