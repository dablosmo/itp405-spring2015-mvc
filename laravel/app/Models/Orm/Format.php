<?php

namespace App\Models\Orm;

use Illuminate\Database\Eloquent\Model;

class Format extends Model

{
	public function dvds()
	{
		return $this->hasMany('\App\Models\Orm\Dvd');
	}
}